<?php 

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require '../db-connection.php';

$data = json_decode(file_get_contents("php://input"));

if (
    isset($data->key) && isset($data->key_time) && isset($data->name) && isset($data->red) && isset($data->green) && isset($data->blue)
    && !empty($data->key) && !empty($data->key_time) && !empty($data->name)
) {
    $key = $data->key;
    $key_time = $data->key_time;
    $name = $data->name;
    $red = $data->red;
    $green = $data->green;
    $blue = $data->blue;

    $query_result = mysqli_query($db_connection, "INSERT INTO `authkeys` (`key`, `key_time`, `name`, `red`, `green`, `blue`) VALUES ('{$key}', '{$key_time}', '{$name}', '{$red}', '{$green}', '{$blue}')");

    if ($query_result) {
        $result_query_key = mysqli_query($db_connection, "SELECT * FROM `authkeys` WHERE `key`='{$key}' LIMIT 1");
        $key_obj = mysqli_fetch_object($result_query_key);

        echo json_encode(["success" => true, "message" => "Inserted new key", "id" => $key_obj->id]);
    }
    else {
        echo json_encode(["success" => false, "message" => "Insert failed"]);
    }
}
else {
    echo json_encode(["success" => false, "message" => "The required fields do not contain any data"]);
}

?>