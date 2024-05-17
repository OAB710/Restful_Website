<?php
require_once ('database/feature_db.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    $data = array();
    $data['code'] = 2;
    $data['message'] = 'This method is not supported: ' . $_SERVER['REQUEST_METHOD'];

    http_response_code(405);
    die(json_encode($data));
}

$data = json_decode(file_get_contents(filename: 'php://input'));

if (is_null($data)) {
    http_response_code(400);
    die(json_encode(array('code' => 3, 'message' => 'JSON is null')));
}
if (
    !property_exists($data, 'CID') ||
    !property_exists($data, 'UID') ||
    !property_exists($data, 'Title') ||
    !property_exists($data, 'Content') ||
    !property_exists($data, 'Date')
) {
    http_response_code(400);
    die(json_encode(array('code' => 4, 'message' => 'Please provide full information of the course')));
}

if (
    empty($data->CID) ||
    empty($data->UID) ||
    empty($data->Title) ||
    empty($data->Content) ||
    empty($data->Date)
) {
    http_response_code(400);
    die(json_encode(array('code' => 5, 'message' => 'Your information is empty')));
}

// $id = $_GET['id'];
// $id = intval($id);

// if (!is_int($id)) {
//     http_response_code(400);
//     die(json_encode(array('code' => 5, 'message' => 'Please provide a valid product')));
// }

// if ($id < 1 || $id > 1000) {
//     http_response_code(400);
//     die(json_encode(array('code' => 5, 'message' => 'ID is out of range')));
// }

//db query
update_course($data);
die(json_encode(array('code' => 0, 'message' => 'Add product success')));
?>