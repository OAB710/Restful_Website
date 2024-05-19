<?php
require_once ('database/feature_db.php');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    // If the request method is not GET, return an error message
    http_response_code(405);
    echo json_encode(['error' => 'This method is not supported: ' . $_SERVER['REQUEST_METHOD']]);
    // Exit the script
    exit();
}

// Gọi hàm get_location
$category=get_category();
filter_course_by_category($category);
?>
