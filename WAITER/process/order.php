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

        //function to create new order id
        function newOrdId(){
            //sql statement for select last inserted order id
            $sql = "SELECT oid FROM orders ORDER BY oid desc LIMIT 1;";
            $result = $this->db->query($sql);//execute sql query
            if($this->db->errno){
                echo($this->db->error);//if database error occurs..echo it to the frontend
                exit;//exit from the function
            }
            $nor = $result->num_rows;//check returned number of rows
            if($nor==0){//if no records found
                $ord_id="OR00001";//set reservation id as OR00001
            }
            else{
                $rec=$result->fetch_assoc();
                $lid=$rec["oid"];
                $num=substr($lid,2);//select part of the string start from the number
                $num++;//increase id by 1
                $ord_id=str_pad($num,5,'0',STR_PAD_LEFT);//pad incremented number
                $ord_id="OR".$ord_id;//concat both number and the letter
            }
            //return reservation id
            return $ord_id;
        }

        //get table names for the order interface
        function getTableName(){
            $sql = "SELECT *
                    FROM tables;";
            $result=$this->db->query($sql);//execute the sql query

            if($this->db->errno){
                echo($this->db->error);//if database error occurs..echo it to the frontend
                exit;//exit from the function
            }
            while($record = $result->fetch_assoc() ){//while loop has been used to fetch records from db table
                echo ("<option value=".$record['tbid'].">".$record['tnumber']."</option>");
            }
        }

        function addOrderDetails(){
            $sql="INSERT INTO orders(oid, week, totalitems, totalprice, tbid_fk, uid_fk, date)
                  VALUES('$this->ord_id','$this->week', '$this->tot_items', '$this->total_payable', '$this->tbl_id', 
                  '$this->usr_id', now())";

            $res=$this->db->query($sql);//execute sql query
            if($this->db->errno){
                echo($this->db->error);//if database error occurs..echo it to the frontend
                exit;//exit from the function
            }

            if($res>0){
                echo ("Done"); //pass success to frontend
            }
            else {
                echo ("Error"); //pass error to frontend
            }
        }

        function addOrderItems(){
            $cv=0;//create variable and assign initial value as zero
            //capture data array sent from payment form as key value pairs and insert data into table using foreach
            foreach ($this->food_id as $key=>$value){
                $sql1 = "INSERT INTO order_items(oid_fk, fid, qty)
                         VALUES ('$this->ord_id', '".$this->food_id[$cv]."', '".$this->qty[$cv]."')";

                $res = $this->db->query($sql1);//execute sql query
                if($this->db->errno){
                    echo($this->db->error);//if database error occurs..echo it to the frontend
                    exit;//exit from the function
                }
                $cv++;// increase the variable value by 1
            }

            if($res>0){
                echo ("Done"); //pass success to frontend
            }
            else {
                echo ("Error"); //pass error to frontend
            }
        }

        //function to get the list of all orders
        function getOrdersList($uid){
            $sql = "SELECT orders.*, user.uname, tables.tnumber
                    FROM orders
                    JOIN user ON orders.uid_fk = user.uid
                    JOIN tables ON orders.tbid_fk = tables.tbid
                    WHERE orders.date = curdate() AND orders.uid_fk = '$uid'
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