<?php

header("Access-Control-Allow-Origin: http://budru.com.ru/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "./config/database.php";
include_once "./objects/User.php";

$database = new DataBase();
$db = $database->getConnection();

$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

$user->email = $data->email;
$user->password = $data->password;

if (
    !empty($user->email) &&
    // $user->emailExists() == 0 &&
    !empty($user->password) &&
    $user->create()
) {
    http_response_code(200);
    $res = [
        "status" => true,
        "user_id" => $db->lastInsertId(),
        "message" => "Пользователь был создан"
    ];
    echo json_encode($res);
} else {
    http_response_code(400);
    $res = [
        "status" => false,
        "message" => "Невозможно создать пользователя"
    ];
    echo json_encode($res);
}