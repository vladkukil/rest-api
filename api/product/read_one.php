<?php
//HTTP-headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

include_once '../config/database.php';
include_once '../objects/product.php';

$database = new Database();

$product = new Product($database);

//set ID of record for read
$product->id = $_GET['id'] ?? die();

$product->readOne();

if ($product->name !=null){

    //Create array
    $product_arr = array(
        "id" => $product->id,
        "name" => $product->name,
        "description" => $product->description,
        "price" => $product->price,
        "category_id" => $product->category_id,
        "category_name" => $product->category_name
    );

    //Response code 200
    http_response_code(200);

    //Output in json
    echo json_encode($product_arr);
}
else {
    //Response cod 404 - not found
    http_response_code(404);

    //Message for user
    echo json_encode(array(
        "message" => "Item does not exit"
    ));
}