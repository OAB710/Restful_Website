<?php
require_once ('database/feature_db.php');
// Check if the request method is not GET
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    // If the request method is not GET, return an error message
    http_response_code(405);
    echo json_encode(['error' => 'This method is not supported: ' . $_SERVER['REQUEST_METHOD']]);
    // Exit the script
    exit();
}
$title=get_title();
search_course_by_title($title);
?>
