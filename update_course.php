<?php
require_once ('database/feature_db.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    $data = array();
    $data['code'] = 2;
    $data['message'] = 'This method is not supported: ' . $_SERVER['REQUEST_METHOD'];

    http_response_code(405);
    die(json_encode($data));
}

// Lấy dữ liệu từ biểu mẫu gửi đi
$cid = $_POST['CID'];
$uid = $_POST['UID']; // Giữ nguyên UID
$title = $_POST['Title'];
$duration = $_POST['Duration'];
$type = $_POST['Type'];
$location = $_POST['Location'];
$category = $_POST['Category'];
$content = $_POST['Content'];

// Kiểm tra dữ liệu trống
if (empty($cid) || empty($uid) || empty($title) || empty($content)) {
    http_response_code(400);
    die(json_encode(array('code' => 5, 'message' => 'Some information is empty')));
}

// Tạo một đối tượng course từ dữ liệu đã nhận
$course = (object) [
    'CID' => $cid,
    'UID' => $uid, // Giữ nguyên UID
    'Title' => $title,
    'Duration' => $duration,
    'Type' => $type,
    'Location' => $location,
    'Category' => $category,
    'Content' => $content,
    'Date' => date('Y-m-d') // Tự động cập nhật ngày sửa
];

// Cập nhật vào cơ sở dữ liệu
update_course($course);

header('Location: ManageCourse.php');
echo json_encode(array('code' => 0, 'message' => 'Update success'));
?>
