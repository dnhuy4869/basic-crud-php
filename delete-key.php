<?php 

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require '../db-connection.php';

$data = json_decode(file_get_contents("php://input"));

if (
    isset($data->id) && !empty($data->id)
) {
    $id = $data->id;

    $query_result = mysqli_query($db_connection, "DELETE FROM `authkeys` WHERE `id`='{$id}'");

    if ($query_result) {
        echo json_encode(["success" => true, "message" => "Deleted key"]);
    }
    else {
        echo json_encode(["success" => false, "message" => "Delete failed"]);
    }
}
else {
    echo json_encode(["success" => false, "message" => "The required fields do not contain any data"]);
}

?>