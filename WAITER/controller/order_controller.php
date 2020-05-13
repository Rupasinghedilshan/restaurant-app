<?php
    include_once("../process/order.php");//include reservation class
    $ord = new order();//create order class object
    $res = $ord->newOrdId();//create new order id

    if($_GET['type'] == 'make_order'){
        $ord->ord_id = $res;
        $ord->week = $_POST['week'];
        $ord->usr_id = $_POST['user_id'];
        $ord->tbl_id = $_POST['table_id'];
        $ord->tot_items = $_POST['tot_items'];
        $ord->total_payable = $_POST['payamount'];
        $ord->addOrderDetails();//call to add order details function

        $ord->ord_id = $res;
        $ord->food_id = $_POST['foodid'];
        $ord->qty = $_POST['qty'];
        $ord->addOrderItems();//call to add order items function
    }