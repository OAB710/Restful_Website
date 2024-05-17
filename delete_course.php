<?php
require_once ('database/feature_db.php');

if ($_SERVER['REQUEST_METHOD'] != 'DELETE') {
    $data = array();
    $data['code'] = 2;
    $data['message'] = 'This method is not supported: ' . $_SERVER['REQUEST_METHOD'];

    http_response_code(405);
    die(json_encode($data));
}

$id = get_id();

//GET DATA FROM DATABASE
delete_course($id);
?>