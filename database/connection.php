<?php
function get_connection()
{
    $jsonData = file_get_contents('database/db.json');
    // Chuyển đổi dữ liệu JSON thành mảng PHP
    $data = json_decode($jsonData, true);

    return $data;
}
?>