<?php
require_once('database/feature_db.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    $data = array(
        'code' => 2,
        'message' => 'This method is not supported: ' . $_SERVER['REQUEST_METHOD']
    );
    http_response_code(405);
    die(json_encode($data));
}

$title = $_POST['Title'] ?? null;
$content = $_POST['Content'] ?? null;
$date = date('Y-m-d'); // Lấy ngày hiện tại

if (is_null($title) || is_null($content)) {
    http_response_code(400);
    die(json_encode(array('code' => 4, 'message' => 'Please provide full information of the course')));
}

if (empty($title) || empty($content)) {
    http_response_code(400);
    die(json_encode(array('code' => 5, 'message' => 'Your information is empty')));
}

$course = (object) array(
    'CID' => 100,
    'UID' => 100,
    'Title' => $title,
    'Content' => $content,
    'Date' => $date
);

// Thêm course vào database
add_course($course);

?>
