<?php
require_once('database/connection.php'); // Corrected the typo in the directory name

function get_unique_Categorys() {
    $data = get_connection();
    $course_data = $data['Course'];
    $Categorys = [];

    foreach ($course_data as $course) {
        if (isset($course['Category']) && !in_array($course['Category'], $Categorys)) {
            $Categorys[] = $course['Category'];
        }
    }

    echo json_encode($Categorys, JSON_PRETTY_PRINT);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    get_unique_Categorys();
}
?>
