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
$duration = $_POST['Duration'] ?? null;
$type = $_POST['Type'] ?? null;
$location = $_POST['Location'] ?? null;
$category = $_POST['Category'] ?? null;
$date = date('Y-m-d');

if (is_null($title) || is_null($content) || is_null($duration) || is_null($type) || is_null($location) || is_null($category)) {
    http_response_code(400);
    die(json_encode(array('code' => 4, 'message' => 'Please provide full information of the course')));
}

if (empty($title) || empty($content) || empty($duration) || empty($type) || empty($location) || empty($category)) {
    http_response_code(400);
    die(json_encode(array('code' => 5, 'message' => 'Your information is empty')));
}


function get_CIDs() {
    $data = get_connection();
  $course_data = $data['Course'];
  foreach ($course_data as $course):
    $course_ids[] = $course['CID'];
  endforeach;
  $maxCID = $course_ids[0];
    foreach ($course_ids as $cid) {
        if ($cid > $maxCID) {
            $maxCID = $cid;
        }
    }
    return $maxCID+1;
}

// Create new course object
$course = array(
    'CID' => get_CIDs(),
    'Title' => $title,
    'Content' => $content,
    'Duration' => $duration,
    'Type' => $type,
    'Location' => $location,
    'Category' => $category,
    'Date' => $date
);

// Add new course to the database
add_course($course);

header('Location: ManageCourse.php');

?>