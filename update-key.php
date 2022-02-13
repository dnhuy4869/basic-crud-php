<?php 

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require '../db-connection.php';

$data = json_decode(file_get_contents("php://input"));

if (
    isset($data->key) && isset($data->key_time) && isset($data->name) && isset($data->red) && isset($data->green) && isset($data->blue) && isset($data->id) 
    && !empty($data->key) && !empty($data->key_time) && !empty($data->name) && !empty($data->id)
) {
    $id = $data->id;
    $key = $data->key;
    $key_time = $data->key_time;
    $name = $data->name;
    $red = $data->red;
    $green = $data->green;
    $blue = $data->blue;

    $query_result = mysqli_query($db_connection, "UPDATE `authkeys` SET `key`='{$key}', `key_time`='{$key_time}', `name`='{$name}', `red`='{$red}', `green`='{$green}', `blue`='{$blue}'  WHERE `id`='{$id}'");

    if ($query_result) {
        echo json_encode(["success" => true, "message" => "Updated key"]);
    }
    else {
        echo json_encode(["success" => false, "message" => "Update failed"]);
    }
}
else {
    echo json_encode(["success" => false, "message" => "The required fields do not contain any data"]);
}

?>