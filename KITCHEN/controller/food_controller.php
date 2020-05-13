<?php
    include_once("../process/food.php");//include food class
    $dish = new food();//create menu item class object

    if ($_GET['type']=='deactive_food'){
        $dish->removeFood();//call to deactivate Food function
    }

    elseif ($_GET['type']=='reactive_food'){
        $dish->reactiveFood();//call to deactivate Food function
    }
