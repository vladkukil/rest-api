<?php
//HTTP-headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
//How much the pre-request can be cached
header("Access-Control-Max-Age: 3600");
//Enabled headers with query
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once '../config/database.php';
include_once '../objects/product.php';

// Database creation and connection
$database = new Database();

// Blog post object
$db = $database->getConnection();

$product = new Product($db);

// Get raw posted data
//$data = json_decode(file_get_contents("php://input"));
$product->name = $_GET['name'] ?? die();
$product->price = $_GET['price'] ?? die();
$product->description = $_GET['description'] ?? die();
$product->category_id = $_GET['category_id'] ?? die();

$product->created = date('Y-m-d H:i:s');

if($product->create()){

    // установим код ответа - 201 создано
    http_response_code(201);

    // сообщим пользователю
    echo json_encode(array("message" => "Product created."));
}
else {
    //Response code 503 - service unavailable
    http_response_code(503);

    echo json_encode(array(
        "message" => "Unable to create item"
    ));

}

