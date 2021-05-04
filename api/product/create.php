<?php
//HTTP-headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
//How much the pre-request can be cached
header("Access-Control-Max-Age: 3600");
//Enabled headers with query
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers, 
        Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/product.php';

// Database creation and connection
$database =new Database();

// Blog post object
$product = new Product($database);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

if (
    !empty($data->name) &&
    !empty($data->price) &&
    !empty($data->description) &&
    !empty($data->category_id)
) {
    $product->name = $data->name;
    $product->price = $data->price;
    $product->description = $data->description;
    $product->category_id = $data->category_id;
    $product->created = $data('Y-m-d H:i:s');

    if ($product->create()){
        //Response code 201 - created
        http_response_code(201);

        //Message to user
        echo json_encode(array(
            "message" => "Product was created")
        );
    }
    else {
        //Response code 503 - service unavailable
        http_response_code(503);

        echo json_encode(array(
            "message" => "Unable to create item"
        ));
    }
}

else {
    //Response code 400 - invalid query
    http_response_code(400);

    echo json_encode(array(
        "message" => "Unable to create item. Data incomplete"
    ));
}