<?php
//HTTP-headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once '../config/database.php';
include_once '../objects/product.php';
// Database creation and connection
$database = new Database();
$db = $database->getConnection();

// Product object
$product = new Product($db);

// get ID

// Set ID for delete
$product->id = $_GET['id'] ?? die();

if ($product->delete()){
    //Response code 200
    http_response_code(200);
    echo json_encode(array(
        "message" => "Item deleted"
    ));
}
else {
    //Response cod 503 - service not available
    http_response_code(503);
    echo json_encode(array(
        "message" => "Can't delete item"
    ));
}