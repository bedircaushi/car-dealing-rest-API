<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once "../../config/Database.php";
include_once "../../models/User.php";

$database=new Database();
$db=$database->connect();
$user= new User($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// set product property values
$user->username = $data->username;
$user->nameAndSurname = $data->nameAndSurname;
$user->address = $data->address;
$user->email = $data->email;
$user->password_ = $data->password_;
$user->phone = $data->phone;

$userExists = $user->userExists();


if(!$user->userExists()) {
    // create the user
    if(
        !empty($user->username) &&
        !empty($user->nameAndSurname) &&
        !empty($user->address) &&
        !empty($user->email) &&
        !empty($user->password_) &&
        !empty($user->phone) &&
        $user->insertUser()
    ){

        // set response code
        http_response_code(200);

        // display message: user was created
        echo json_encode(array("message" => "User was created."));
    }

    // message if unable to create user
    else{

        // set response code
        http_response_code(400);

        // display message: unable to create user
        echo json_encode(array("message" => "Unable to create user."));
    }

}   else {

        // set response code
        http_response_code(400);

        // display message: unable to create user
        echo json_encode(array("message" => "User is already registered"));
        }



?>