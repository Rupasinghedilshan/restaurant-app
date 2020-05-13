<?php
    include_once("db_conf.php");//include database information
    class prediction
    {
        public $db;

        //create database connection
        function __construct(){
            $this->db = new mysqli(server,user,pass,db);
        }

        //function to get item list for prediction
        function getOrdersForPrediction($week = 0){
            
            $fooditems = $this->handleFoodMenuItems();

            for ($i=0; $i < count($fooditems); $i++) { 

                $postObj = array(
                    "oid"=>0,
                    "week"=> $week,
                    "totalprice"=> $fooditems[$i]["price"],
                    "category_Beverages"=>0,
                    "category_Biriyani"=>0,
                    "category_Desert"=>0,
                    "category_Extras"=>0,
                    "category_Fish"=>0,
                    "category_OtherSnacks"=>0,
                    "category_Pasta"=>0,
                    "category_Pizza"=>0,
                    "category_RiceBowl"=>0,
                    "category_Salad"=>0,
                    "category_Sandwich"=>0,
                    "category_Seafood"=>0,
                    "category_Starters"=>0,
                    "cuisine_Continential"=>0,
                    "cuisine_Indian"=>0,
                    "cuisine_Italian"=>0,
                    "cuisine_Thai"=>0
                );

                if(array_key_exists($fooditems[$i]["category"], $postObj)){
                    $matched_category  =  $fooditems[$i]["category"];
                    $postObj[$matched_category] = 1;
                }

                if(array_key_exists($fooditems[$i]["cuisine"], $postObj)){
                    $matched_cuisine  =  $fooditems[$i]["cuisine"];
                    $postObj[$matched_cuisine] = 1;
                }

                $predict_data = $this->handlePostPredictionAPI($postObj);
                $predicted_num_orders = json_decode($predict_data);

                $fooditems[$i]["predicted_orders"] = ceil( $predicted_num_orders->num_orders );
                
            }
            
            usort($fooditems, function ($item1, $item2) {
                return $item2['predicted_orders']  <=> $item1['predicted_orders'];
            });
            
            return $fooditems;

        }

        function handleFoodMenuItems(){
            $sql = "SELECT food_menu.fname, food_menu.price, CONCAT('cuisine_', food_menu.cuisine) AS 'cuisine', CONCAT('category_', replace(food_category.catname, ' ', '')) AS 'category' FROM food_menu
            JOIN food_category ON food_category.catid = food_menu.fcategory_idfk";
            $ref=$this->db->query($sql);//execute sql query
            // $arr = array();
             //fetch data into an array
            while($row=$ref->fetch_array()){
                $ar[]= array(
                    "fname" => $row['fname'],
                    "price" => $row['price'],
                    "category" => $row['category'],
                    "cuisine" => $row['cuisine'],
                );
            }

            if(!empty($ar)){
                return $ar;//return array to the frontend
            } else {
                return [];
            }
        }

        function handlePostPredictionAPI($postObj){

            $data = $postObj;                                                                    
            $data_string = json_encode($data);                                                                                   
                                                                                                                                
            $ch = curl_init('http://localhost:8888/predict');                                                                      
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                'Content-Type: application/json',                                                                                
                'Content-Length: ' . strlen($data_string))                                                                       
            );                                                                                                                   
                                                                                                                                
            $result = curl_exec($ch);
            return $result;
        }
    }