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

        //function to get the list of all available food item
        function getFoodList(){
            $sql = "SELECT food_menu.*
                    FROM food_menu
                    GROUP BY food_menu.fid;";
            $ref=$this->db->query($sql);//execute sql query
            //fetch data into an array
            while($row=$ref->fetch_array()){
                $fd =new food();
                $fd->fid = $row['fid'];
                $fd->category =$row['category'];
                $fd->cuisine =$row['cuisine'];
                $fd->fname =$row['fname'];
                $fd->price =$row['price'];
                $fd->state =$row['availability_fk'];
                if ($fd->state == 1) {
                    $fd->state = 'Available';
                }
                else{
                    $fd->state = 'Unavailable';
                }
                $ar[]=$fd;
            }
            if(!empty($ar)){
                return $ar;//return array to the frontend
            }
        }

        //function for deactivate available food from the system
        function removeFood(){
            $fid = $_POST["uid"];//capture food id from frontend
            $sql ="update food_menu set availability_fk ='0' where fid='$fid'";
            $ref=$this->db->query($sql);//execute sql query

            if ($ref>0){
                echo("Done");//Pass message to frontend if successful
            }
            else{
                echo("Error");//Pass message to frontend if error occur
            }
        }

        //function for reactivate, deactivated food from the system
        function reactiveFood(){
            $fid = $_POST["uid"];//capture food id from frontend
            $sql ="update food_menu set availability_fk='1' where fid='$fid'";
            $ref=$this->db->query($sql);//execute sql query

            if ($ref>0){
                echo("Done");//Pass message to frontend if successful
            }
            else{
                echo("Error");//Pass message to frontend if error occur
            }
        }
    }
