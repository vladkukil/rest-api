<?php
//HTTP-headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/product.php';

$database = new Database();

$product = new Product($database);

//querying products
$stmt = $product->read();
$num = $stmt->rowCount();

if ($num > 0){

    //Array of products
    $products_arr = array();
    $products_arr["records"] = array();

    //get the contents of our table
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $product_item = array(
            "id" => $id,
            "name" => $name,
            "description" => html_entity_decode($description),
            "price" => $price,
            "category_id" => $category_id,
            "category_name" => $category_name
        );

        array_push($products_arr["records"], $product_item);
    }

    http_response_code(200);

    echo json_encode($products_arr);
}

else {
    //Response code - 404 Not found
    http_response_code(404);

    //Message to user
    echo  json_encode(array(
        "message" => "No products found")
    );
}