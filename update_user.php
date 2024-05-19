<?php
require_once('database/feature_db.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    $data = array();
    $data['code'] = 2;
    $data['message'] = 'This method is not supported: ' . $_SERVER['REQUEST_METHOD'];

    http_response_code(405);
    die(json_encode($data));
}

// Lấy dữ liệu từ biểu mẫu gửi đi
$uid = $_POST['UID'];
$uname = $_POST['UName'];
$email = $_POST['Email'];

// Kiểm tra dữ liệu trống
if (empty($uid) || empty($uname) || empty($email)) {
    http_response_code(400);
    die(json_encode(array('code' => 5, 'message' => 'Some information is empty')));
}

// Tạo một đối tượng user từ dữ liệu đã nhận
$user = (object) [
    'UID' => $uid,
    'UName' => $uname,
    'Email' => $email,
];

// Cập nhật vào cơ sở dữ liệu
update_user($user);

header('Location: ManageUser.php');
?>
