<?php
require_once ('database/feature_db.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    $data = array(
        'code' => 2,
        'message' => 'This method is not supported: ' . $_SERVER['REQUEST_METHOD']
    );
    http_response_code(405);
    die(json_encode($data));
}

$UName = $_POST['UName'] ?? null;
$Email = $_POST['Email'] ?? null;

if (is_null($UName) || is_null($Email)) {
    http_response_code(400);
    die(json_encode(array('code' => 4, 'message' => 'Please provide full information for user')));
}

if (empty($UName) || empty($Email)) {
    http_response_code(400);
    die(json_encode(array('code' => 5, 'message' => 'Your information is empty')));
}

function get_UIDs()
{
    $data = get_connection();
    $user_data = $data['User'];
    foreach ($user_data as $user):
    $user_ids[] = $user['UID'];
    endforeach;
    $maxUID = $user_ids[0];
    foreach ($user_ids as $uid) {
        if ($uid > $maxUID) {
            $maxUID = $uid;
        }
    }
    return $maxUID + 1;
}

// Create new course object
$user = array(
    'UID' => get_UIDs(), // Assuming a placeholder UID
    'UName' => $UName,
    'Email' => $Email
);

add_user($user);

header('Location: admin.php');
?>