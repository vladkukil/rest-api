<?php

class Product {

    // Connect to DB
    private $conn;
    private $table_name;

    //Prop of obj
    public $id;
    public $name;
    public $description;
    public $price;
    public $category_id;
    public $category_name;
    public $created;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read(){
        //TODO
    }
}