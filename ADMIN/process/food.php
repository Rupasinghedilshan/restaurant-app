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

        //get food names for the order interface
        function getFoodName(){
            $sql = "SELECT *
                    FROM food_menu;";
            $result=$this->db->query($sql);//execute the sql query

            if($this->db->errno){
                echo($this->db->error);//if database error occurs..echo it to the frontend
                exit;//exit from the function
            }
            while($record = $result->fetch_assoc() ){//while loop has been used to fetch records from db table
                echo ("<option value=".$record['fid'].">".$record['fname']."</option>");
            }
        }

        //function to get the list of all food categories
        function foodCategoryReport(){
            $sql = "SELECT *
                    FROM food_category
                    ORDER BY catid ASC;";
            $ref=$this->db->query($sql);//execute sql query
            //fetch data into an array
            while($row=$ref->fetch_array()){
                $food=new food();
                $food->catid = $row['catid'];
                $food->catname =$row['catname'];
                $ar[]=$food;
            }
            if(!empty($ar)){
                return $ar;//return array to the frontend
            }
        }

        //function to get the list of all food menu
        function foodMenuReport(){
            $sql = "SELECT *
                    FROM food_menu
                    ORDER BY fid ASC;";
            $ref=$this->db->query($sql);//execute sql query
            //fetch data into an array
            while($row=$ref->fetch_array()){
                $food=new food();
                $food->fid = $row['fid'];
                $food->catname =$row['category'];
                $food->cuisine =$row['cuisine'];
                $food->fname =$row['fname'];
                $food->price =$row['price'];
                $ar[]=$food;
            }
            if(!empty($ar)){
                return $ar;//return array to the frontend
            }
        }

        //function to get the list of all food offers
        function foodOffersReport(){
            $sql = "SELECT food_offer.*, food_menu.fname
                    FROM food_offer
                    JOIN food_menu ON food_offer.fid = food_menu.fid";
            $ref=$this->db->query($sql);//execute sql query
            //fetch data into an array
            while($row=$ref->fetch_array()){
                $food=new food();
                $food->fid = $row['fid'];
                $food->fname = $row['fname'];
                $food->discount = $row['discount'];
                $ar[]=$food;
            }
            if(!empty($ar)){
                return $ar;//return array to the frontend
            }
        }
    }
