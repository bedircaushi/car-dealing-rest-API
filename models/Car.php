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
    }


