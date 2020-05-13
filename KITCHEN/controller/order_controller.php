<?php
    include_once("../process/order.php");//include reservation class
    $ord = new order();//create order class object

    if ($_GET['type']=='order_complete'){
        $ord->completeOrder();//call to complete order function
    }