<?php
require_once('database/connection.php'); // Corrected the typo in the directory name

function get_unique_locations() {
    $data = get_connection();
    $course_data = $data['Course'];
    $locations = [];

    foreach ($course_data as $course) {
        if (isset($course['Location']) && !in_array($course['Location'], $locations)) {
            $locations[] = $course['Location'];
        }
    }

    echo json_encode($locations, JSON_PRETTY_PRINT);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    get_unique_locations();
}
?>
