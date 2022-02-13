<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require '../db-connection.php';

$allKeys = mysqli_query($db_connection, "SELECT * FROM `authkeys`");
if (mysqli_num_rows($allKeys) > 0) {
    $all_keys = mysqli_fetch_all($allKeys, MYSQLI_ASSOC);
    echo json_encode(["success" => true, "keys" => $all_keys]);
} 
else {
    echo json_encode(["success" => false]);
}

?>