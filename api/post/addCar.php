<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
include_once '../../config/Database.php';
include_once '../../models/Car.php';

$database=new Database();
$db=$database->connect();
$car= new Car($db);

$data = json_decode(file_get_contents("php://input"));

$car->vehicleID = $data->vehicleid;
$car->make = $data->make;
$car->model = $data->model;
$car->description_ = $data->description;
$car->fuel = $data->fuel;
$car->image = $data->image;
$car->price = $data->price;
$car->power_ = $data->power;
$car->mileage = $data->mileage;
$car->date_ = $data->date;
$car->username = $data->username;

if ($car->insert_or_update("INSERT")) {
    echo json_encode(
        array('message' => 'Car is added successfully')
    );
}
else{
    echo json_encode(
        array('message' => 'Car is not added!')
    );
}
