<?php
    include_once("db_conf.php");//include database information
    class order//create order class
    {
        public $oid;
        public $cus_id;
        public $cus_mobile;
        public $order_date;
        public $order_time;
        public $canceled_by;
        public $state;
        public $db;

        //create database connection
        function __construct(){
                $this->db = new mysqli(server,user,pass,db);
        }

        //function to get the list of all orders
        function getOrdersList(){
            $sql = "SELECT orders.*, user.uname, tables.tnumber
                    FROM orders
                    JOIN user ON orders.uid_fk = user.uid
                    JOIN tables ON orders.tbid_fk = tables.tbid
                    Group By orders.oid
                    ORDER BY orders.oid ASC;";
            $ref=$this->db->query($sql);//execute sql query
            //fetch data into an array
            while($row=$ref->fetch_array()){
                $ord=new order();
                $ord->oid = $row['oid'];
                $ord->tnumber =$row['tnumber'];
                $ord->uname =$row['uname'];
                $ord->totalitems =$row['totalitems'];
                $ord->totalprice =$row['totalprice'];
                $ord->date =$row['date'];
                $ord->state =$row['state'];
                $ar[]=$ord;
            }
            if(!empty($ar)){
                return $ar;//return array to the frontend
            }
        }

        //function to get the list of all daily orders
        function getDailyOrdersReport(){
            $sql = "SELECT orders.*, user.uname, tables.tnumber
                    FROM orders
                    JOIN user ON orders.uid_fk = user.uid
                    JOIN tables ON orders.tbid_fk = tables.tbid
                    WHERE orders.date = curdate()
                    Group By orders.oid
                    ORDER BY orders.oid ASC;";
            $ref=$this->db->query($sql);//execute sql query
            //fetch data into an array
            while($row=$ref->fetch_array()){
                $ord=new order();
                $ord->oid = $row['oid'];
                $ord->tnumber =$row['tnumber'];
                $ord->uname =$row['uname'];
                $ord->totalitems =$row['totalitems'];
                $ord->totalprice =$row['totalprice'];
                $ord->date =$row['date'];
                $ord->state =$row['state'];
                $ar[]=$ord;
            }
            if(!empty($ar)){
                return $ar;//return array to the frontend
            }
        }

        //function to get the list of all monthly orders
        function getMonthlyOrdersReport($sdate, $edate){
            $sql = "SELECT orders.*, user.uname, tables.tnumber
                    FROM orders
                    JOIN user ON orders.uid_fk = user.uid
                    JOIN tables ON orders.tbid_fk = tables.tbid
                    WHERE orders.date >= '$sdate' AND orders.date <= '$edate'
                    Group By orders.oid
                    ORDER BY orders.oid ASC;";
            $ref=$this->db->query($sql);//execute sql query
            //fetch data into an array
            while($row=$ref->fetch_array()){
                $ord=new order();
                $ord->oid = $row['oid'];
                $ord->tnumber =$row['tnumber'];
                $ord->uname =$row['uname'];
                $ord->totalitems =$row['totalitems'];
                $ord->totalprice =$row['totalprice'];
                $ord->date =$row['date'];
                $ord->state =$row['state'];
                $ar[]=$ord;
            }
            if(!empty($ar)){
                return $ar;//return array to the frontend
            }
        }
    }