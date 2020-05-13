<?php
    include_once("db_conf.php");//include database information
    class food//create food class
    {
        public $catid;
        public $catname;
        public $fid;
        public $fname;
        public $cuisine;
        public $price;
        public $availability_fk;
        public $db;

        //create database connection
        function __construct(){
            $this->db = new mysqli(server,user,pass,db);
        }

        // function to get food food_cat id for filter items by food_cat in order interface
        function getOrdFoodCat(){
            $sql = "SELECT catname FROM food_category GROUP BY catname;";
            $result = $this->db->query($sql);//execute sql query

            while($row = $result->fetch_array()){//fetch data into an array
                $food=new food();//create food class object
                $food->food_cat = $row['catname'];
                $ar[]=$food;
            }
            if(!empty($ar)){
                return $ar;// return array to the frontend
            }
            else{
                echo "No Food Available";
            }
        }

        //function to get food unit prices in order interface
        function getFoodPrices(){
            $foodid = $_POST["foodid"];//capture food id from frontend
            $sql = "SELECT fid, fname, price
                    FROM food_menu
                    WHERE fid = '$foodid';";

            $result=$this->db->query($sql);//execute the sql query

            if($this->db->errno){
                echo($this->db->error);//if database error occurs..echo it to the frontend
                exit;//exit from the function
            }
            $FoodPricearr = array(); //define an array to make an associative array

            while($record = $result->fetch_assoc() ){
                $FoodPrice['foodid'] = $record["fid"];
                $FoodPrice['name'] = $record["fname"];
                $FoodPrice['fprice'] = $record["price"];
                array_push($FoodPricearr, $FoodPrice); //INSERT the retrieved records INTO the defined array
            }
            echo (json_encode($FoodPricearr)); //echo the array to front end
        }
    }
