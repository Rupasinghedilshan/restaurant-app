<?php
    include_once("../process/food.php");//include food class
    $dish = new food();//create menu item class object
    if ($_GET['type']=='getFoodPrices'){
        $dish->getFoodPrices();//call to get food price function
    }
