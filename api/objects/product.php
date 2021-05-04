<?php

class Product {
    // Connect to DB
    private $conn;
    private $table_name = 'products';

    //Properties of obj
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
        //Select all records
        $query = "SELECT * FROM " . $this->table_name;

        //Prepared query
        $stmt = $this->conn->prepare($query);

        //Execute query
        $stmt->execute();

        return $stmt;
    }

    //Create method
    function create() {
        //Insert query
        $query = "INSERT INTO " . $this->table_name . "SET name=:name, price=:price, description=:description, 
        category_id=:category_id, created=:created";

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean data
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->category_id=htmlspecialchars(strip_tags($this->category_id));
        $this->created=htmlspecialchars(strip_tags($this->created));

        //Bind data
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":category_id", $this->category_id);
        $stmt->bindParam(":created", $this->created);

        // выполняем запрос
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function readOne() {
        $query = "SELECT * FROM " . $this->table . " WHERE id = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $row['name'];
        $this->price = $row['price'];
        $this->description = $row['description'];
        $this->category_id = $row['category_id'];
        $this->category_name = $row['category_name'];
    }
}