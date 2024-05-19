<?php
require_once ('database/feature_db.php');
$method = $_SERVER['REQUEST_METHOD'];

// Check if the actual request method is POST but _method is set to DELETE
if ($method == 'POST' && isset($_POST['_method']) && $_POST['_method'] == 'DELETE') {
    $method = 'DELETE';
}

if ($method != 'DELETE') {
    $data = array();    
    $data['code'] = 2;
    $data['message'] = 'This method is not supported: ' . $_SERVER['REQUEST_METHOD'];
    http_response_code(405);
    die(json_encode($data));
}

$id = $_POST['UID']; // Since the form is actually sent as POST, get the ID from $_POST
//GET DATA FROM DATABASE
delete_user($id);

?>
<script>
    window.location.href = 'admin.php';
</script>