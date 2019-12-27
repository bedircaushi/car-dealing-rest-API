<?php
    class Car{
        private $conn;
        private $table='car';
        public $vehicleID;
        public $make;
        public $model;
        public $description_;
        public $fuel;
        public $image;
        public $price;
        public $power_;
        public $mileage;
        public $date_;
        public $username;

        public function __construct($db)
        {
            $this->conn=$db;
        }

        //get number of cars
        public function rowCount(){
            return $query='SELECT COUNT(*) AS total FROM ' . $this->table;
            $stmt=$db->prepare($query);
        }
        //get all cars
        public function getAll()
        {
            return $query = 'SELECT * FROM ' . $this->table;
            $stmt=$this->conn->prepare($query);
        }
        //get all cars of specific make
        public function getMake($make){
            return $query = 'SELECT * FROM ' . $this->table. " c WHERE c.make="."'".$make."'";
            $stmt=$db->prepare($query);
        }
        //get all cars of specific model and make
        public function getMakeAndModel($make,$model){
            return $query = 'SELECT * FROM ' . $this->table. " c WHERE c.make="."'".$make."' and c.model="."'".$model."'";
            $stmt=$db->prepare($query);
        }
        //get all cars of specific model, make, mileage, price and registration
        public function getWithDetails($make,$model,$mileage,$price,$registration){
            return $query = 'SELECT * FROM ' . $this->table. " c WHERE c.make="."'".$make."' and c.model="."'".$model."' and c.mileage<="."'".$mileage."' and c.price<="."'".$price."' and c.date_<="."'".$registration."'";
            $stmt=$db->prepare($query);
        }
        //get only car makes
        public function getOnlyMake(){
            return $query = 'SELECT DISTINCT make FROM  '. $this->table;
            $stmt=$db->prepare($query);
        }

        //get only specific makes' models
        public function getOnlyModel($make){
            return $query = 'SELECT DISTINCT model FROM '. $this->table.' c WHERE c.make='."'".$make."'";
        }

        //addCar
        public function insert_or_update($action)
        {
            if ($action == "INSERT") {
                $query = 'INSERT INTO ' . $this->table . ' 
                SET 
                    vehicleid = :vehicleid, make = :make, 
                    model = :model, description_ = :description, fuel = :fuel, image = :image,
                    price = :price, power_ = :power, mileage = :mileage, date_ = :date, username = :username';
                $stmt = $this->conn->prepare($query);
            }
            if ($action == "UPDATE") {
                $query = 'UPDATE ' . $this->table . ' 
                SET 
                    vehicleid = :vehicleid, make = :make, 
                    model = :model, description_ = :description, fuel = :fuel, image = :image,
                    price = :price, power_ = :power, mileage = :mileage, date_ = :date, username = :username
                WHERE 
                    vehicleid = :vehicleid  
                ';
                $stmt = $this->conn->prepare($query);
            }
            $this->vehicleID = htmlspecialchars(strip_tags($this->vehicleID));
            $this->make = htmlspecialchars(strip_tags($this->make));
            $this->model = htmlspecialchars(strip_tags($this->model));
            $this->description_ = htmlspecialchars(strip_tags($this->description_));
            $this->fuel = htmlspecialchars(strip_tags($this->fuel));
            $this->image = htmlspecialchars(strip_tags($this->image));
            $this->price = htmlspecialchars(strip_tags($this->price));
            $this->power_ = htmlspecialchars(strip_tags($this->power_));
            $this->mileage = htmlspecialchars(strip_tags($this->mileage));
            $this->date_ = htmlspecialchars(strip_tags($this->date_));
            $this->username = htmlspecialchars(strip_tags($this->username));

            $stmt->bindParam(':vehicleid', $this->vehicleID);
            $stmt->bindParam(':make', $this->make);
            $stmt->bindParam(':model', $this->model);
            $stmt->bindParam(':description', $this->description_);
            $stmt->bindParam(':fuel', $this->fuel);
            $stmt->bindParam(':image', $this->image);
            $stmt->bindParam(':price', $this->price);
            $stmt->bindParam(':power', $this->power_);
            $stmt->bindParam(':image', $this->image);
            $stmt->bindParam(':mileage', $this->mileage);
            $stmt->bindParam(':date', $this->date_);
            $stmt->bindParam(':username', $this->username);

            if ($stmt->execute()) {
                return true;
            }
            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);
            return false;
        }
        public function deleteCar(){
            $query = 'DELETE FROM '.$this->table.' 
                WHERE 
                    vehicleid = :vehicleid ';
            $stmt = $this->conn->prepare($query);
            $this->vehicleID = htmlspecialchars(strip_tags($this->vehicleID));
            $stmt->bindParam(':vehicleid', $this->vehicleID);

            if ($stmt->execute()) {
                return true;
            }
            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);
            return false;
        }
    }


