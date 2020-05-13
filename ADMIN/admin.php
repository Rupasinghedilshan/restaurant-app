<?php 
session_start();
ob_start();
//include('security.php');

$connection = mysqli_connect("localhost","root","","final_project");
?>

<?php
//update admin details
	if(isset($_POST['updateadminbtn']))
	{
		$uid = $_POST['euid'];
		$uname = $_POST['euname'];
		$upass = $_POST['eupass'];
		$contact = $_POST['econtact'];
		
		$query = "UPDATE user SET uname='$uname', upass='$upass', contact='$contact' WHERE uid='$uid' ";
		$query_run = mysqli_query($connection, $query);
		
		
		if($query_run)
		{
			//echo "saved";
			//$message = "Succefully updated";
			//echo "<script type='text/javascript'>alert('$message');</script>";
			$_SESSION['success'] = "Profile edited successfully";
			header('Location:adminProfile.php');
			
			
		}
		else
		{
			//$message = "Not updated! Please try again!";
			//echo "<script type='text/javascript'>alert('$message');</script>";
			$_SESSION['status'] = "Not Updated";
			header('Location:adminProfile.php');	
		}
		
	}
?>
													
<?php

//update waiter details
	if(isset($_POST['updateWaiterbtn']))
	{
		$uid = $_POST['euid'];
		$uname = $_POST['euname'];
		$upass = $_POST['eupass'];
		$contact = $_POST['econtact'];
		
		$query = "UPDATE user SET uname='$uname', upass='$upass', contact='$contact' WHERE uid='$uid' ";
		$query_run = mysqli_query($connection, $query);
		
		
		if($query_run)
		{
			//echo "saved";
			//$message = "Succefully updated";
			//echo "<script type='text/javascript'>alert('$message');</script>";
			$_SESSION['success'] = "Profile edited successfully";
			header('Location:managewaiter.php');
			
			
		}
		else
		{
			//$message = "Not updated! Please try again!";
			//echo "<script type='text/javascript'>alert('$message');</script>";
			$_SESSION['status'] = "Not Updated";
			header('Location:managewaiter.php');	
		}
		
	}
?>

<!--deleteWaiter-->
<?php
	if(isset($_POST['deleteWaiterbtn']))
	{
		$uid = $_POST['delete_id'];
		
		$query = "DELETE FROM user WHERE uid = '$uid' ";
		$query_run = mysqli_query($connection, $query);
	
		if($query_run)
		{
			//echo "saved";
			//$message = "Succefully updated";
			//echo "<script type='text/javascript'>alert('$message');</script>";
			$_SESSION['success'] = "User Deleted!";
			header('Location:managewaiter.php');
			
			
		}
		else
		{
			//$message = "Not updated! Please try again!";
			//echo "<script type='text/javascript'>alert('$message');</script>";
			$_SESSION['status'] = "Not Deleted! Try again";
			header('Location:managewaiter.php');	
		}
	}
?><br>

<?php

//Add waiter account

$connection = mysqli_connect("localhost","root","","final_project");

if(isset($_POST['addWaiterbtn']))
	{
		$uid = $_POST['uid'];    
		$utid = $_POST['utid'];
		$uname = $_POST['uname'];
		$upass = $_POST['upass'];
		$ucpass = $_POST['ucpass'];
		$contact = $_POST['contact'];
		
		if($upass === $ucpass)
		{
			$query = "INSERT INTO user(uid,utype_fk,uname,upass,contact) VALUES ('$uid',$utid,'$uname','$upass','$contact')";
			$query_run = mysqli_query($connection, $query);
		
 			if(query_run)
			{
			echo "error";
			$_SESSION['success'] = "Profile added successfully!";
			header('Location: manageWaiter.php');
			}
			else
			{
				$_SESSION['status'] = "Not added";
				header('Location: manageWaiter.php');
			}
		}
		
		
		
		/*if (mysqli_query($connection, $query)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($connection);
}*/
		
		
		else
		{
			$_SESSION['status'] = "Passwords not matched";
			header('Location: manageWaiter.php');
		}
	
	}


?>




<?php


//Add waiter account

$connection = mysqli_connect("localhost","root","","final_project");

if(isset($_POST['addKitchenbtn']))
	{
		$uid = $_POST['uid'];    
		$utid = $_POST['utid'];
		$uname = $_POST['uname'];
		$upass = $_POST['upass'];
		$ucpass = $_POST['ucpass'];
		$contact = $_POST['contact'];
		
		if($upass === $ucpass)
		{
			$query = "INSERT INTO user(uid,utype_fk,uname,upass,contact) VALUES ('$uid',$utid,'$uname','$upass','$contact')";
			$query_run = mysqli_query($connection, $query);
		
 			if(query_run)
			{
			//echo "error";
			$_SESSION['success'] = "Profile added successfully!";
			header('Location: manageKitchen.php');
			}
			else
			{
				$_SESSION['status'] = "Not added";
				header('Location: manageKitchen.php');
			}
		}
		
		
		
		/*if (mysqli_query($connection, $query)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($connection);
}*/
		
		
		else
		{
			$_SESSION['status'] = "Passwords not matched";
			header('Location: manageKitchen.php');
		}
	
	}



//update waiter details
	if(isset($_POST['updateKitbtn']))
	{
		$uid = $_POST['euid'];
		$uname = $_POST['euname'];
		$upass = $_POST['eupass'];
		$contact = $_POST['econtact'];
		
		$query = "UPDATE user SET uname='$uname', upass='$upass', contact='$contact' WHERE uid='$uid' ";
		$query_run = mysqli_query($connection, $query);
		
		
		if($query_run)
		{
			//echo "saved";
			//$message = "Succefully updated";
			//echo "<script type='text/javascript'>alert('$message');</script>";
			$_SESSION['success'] = "Profile edited successfully";
			header('Location:manageKitchen.php');
			
			
		}
		else
		{
			//$message = "Not updated! Please try again!";
			//echo "<script type='text/javascript'>alert('$message');</script>";
			$_SESSION['status'] = "Not Updated";
			header('Location:manageKitchen.php');	
		}
		
	}
?>

<!--deleteWaiter-->
<?php

	if(isset($_POST['deleteKitbtn']))
	{
		$uid = $_POST['delete_id'];
		
		$query = "DELETE FROM user WHERE uid = '$uid' ";
		$query_run = mysqli_query($connection, $query);
	
		if($query_run)
		{
			//echo "saved";
			//$message = "Succefully updated";
			//echo "<script type='text/javascript'>alert('$message');</script>";
			$_SESSION['success'] = "User Deleted!";
			header('Location:manageKitchen.php');
			
			
		}
		else
		{
			//$message = "Not updated! Please try again!";
			//echo "<script type='text/javascript'>alert('$message');</script>";
			$_SESSION['status'] = "Not Deleted! Try again";
			header('Location:manageKitchen.php');	
		}
	}
?>


<!--TablesManaging-->
<?php

	//Add New tables
$connection = mysqli_connect("localhost","root","","final_project");

if(isset($_POST['addTable']))
	{    
		$tnumber = $_POST['tnumber'];
		
			$query = "INSERT INTO tables(tnumber) VALUES ('$tnumber')";
			$query_run = mysqli_query($connection, $query);
		
 			if(query_run)
			{
			//echo "error";
			$_SESSION['success'] = "Table successfully added!";
			header('Location: manageTables.php');
			}
			else
			{
				$_SESSION['status'] = "Not added";
				header('Location: manageTables.php');
			
		}

		
		/*if (mysqli_query($connection, $query)) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $query . "<br>" . mysqli_error($connection);
		}*/
			
	
	}


//updateTables
if(isset($_POST['updateTable']))
	{
		$tbid = $_POST['etbid'];
		$tnumber = $_POST['etnumber'];
		
		$query = "UPDATE tables SET tnumber='$tnumber' WHERE tbid='$tbid' ";
		$query_run = mysqli_query($connection, $query);
		
		
		if($query_run)
		{
			//echo "saved";
			//$message = "Succefully updated";
			//echo "<script type='text/javascript'>alert('$message');</script>";
			$_SESSION['success'] = "Table added successfully";
			header('Location:manageTables.php');
			
			
		}
		else
		{
			//$message = "Not updated! Please try again!";
			//echo "<script type='text/javascript'>alert('$message');</script>";
			$_SESSION['status'] = "Not Updated";
			header('Location:manageTables.php');	
		}
		
	}

//delete table
if(isset($_POST['deleteTable']))
	{
		$tbid = $_POST['delete_tbid'];
		
		$query = "DELETE FROM tables WHERE tbid = '$tbid' ";
		$query_run = mysqli_query($connection, $query);
	
		if($query_run)
		{
			//echo "saved";
			//$message = "Succefully updated";
			//echo "<script type='text/javascript'>alert('$message');</script>";
			$_SESSION['success'] = "Table Deleted!";
			header('Location:manageTables.php');
			
			
		}
		else
		{
			//$message = "Not updated! Please try again!";
			//echo "<script type='text/javascript'>alert('$message');</script>";
			$_SESSION['status'] = "Not Deleted! Try again";
			header('Location:manageTables.php');	
		}
	}

?>



<?php 
	
	include('security.php');
//Login ----------------------------
	if(isset($_POST['btnLogin'])){
		
		$uname_log = $_POST['uname'];
		$upass_log = $_POST['upass'];
		
		$query = "SELECT * FROM user WHERE uname = '$uname_log' AND upass = '$upass_log' ";
		$query_run = mysqli_query($connection, $query);
		$userType = mysqli_fetch_array($query_run);
		
		if($userType['utype_fk'] == '1'){
			$_SESSION['uname'] = $uname_log;
			header('Location: adminMainMenu.php');
		}
		
		else if($userType['utype_fk'] == '2'){
			$_SESSION['uname'] = $uname_log;
			header('Location: ../KITCHEN/kitchenMain.php');
		}
		
		else if($userType['utype_fk'] == '3'){
			$_SESSION['uname'] = $uname_log;
			$_SESSION['uid'] = $userType['uid'];
			header('Location: ../WAITER/waiterMain.php');
		}
		
		else{
			$_SESSION['status'] = "<span style='color:#FF0000'> Please enter valid Username and Password! </span>";
			header('Location: index.php');
		}
	}
?>


<?php
//category
	if(isset($_POST['logoutbtn'])){
		session_destroy();
		unset($_SESSION['uname']);
		header('Location: index.php');
	}
?>



<?php
//update category details
	if(isset($_POST['updateCatbtn']))
	{
		$catid = $_POST['ecatid'];
		$catname = $_POST['ecatname'];
		//$cuisine = $_POST['ecuisine'];
		
		$query = "UPDATE food_category SET catname='$catname', WHERE catid='$catid' ";
		$query_run = mysqli_query($connection, $query);
		
		
		if($query_run)
		{
			//echo "saved";
			//$message = "Succefully updated";
			//echo "<script type='text/javascript'>alert('$message');</script>";
			$_SESSION['success'] = "Edited successfully";
			header('Location:foodCategory.php');
			
			
		}
		else
		{
			//$message = "Not updated! Please try again!";
			//echo "<script type='text/javascript'>alert('$message');</script>";
			$_SESSION['status'] = "Not Updated";
			header('Location:foodCategory.php');	
		}
		
	}

//delete category
if(isset($_POST['deletecatbtn']))
	{
		$catid = $_POST['delete_catid'];
		
		$query = "DELETE FROM food_category WHERE catid = '$catid' ";
		$query_run = mysqli_query($connection, $query);
	
		if($query_run)
		{
			//echo "saved";
			//$message = "Succefully updated";
			//echo "<script type='text/javascript'>alert('$message');</script>";
			$_SESSION['success'] = "Category Deleted!";
			header('Location:foodCategory.php');
			
			
		}
		else
		{
			//$message = "Not updated! Please try again!";
			//echo "<script type='text/javascript'>alert('$message');</script>";
			$_SESSION['status'] = "Not Deleted! Try again";
			header('Location:foodCategory.php');	
		}
	}


$connection = mysqli_connect("localhost","root","","final_project");
//add new Category
if(isset($_POST['addCategorybtn']))
	{    
		$catname = $_POST['catname'];
		//$cuisine = $_POST['cuisine'];
				
			$query = "INSERT INTO food_category(catname) VALUES ('$catname',)";
			$query_run = mysqli_query($connection, $query);
		
 			if(query_run)
			{
			//echo "error";
			$_SESSION['success'] = "Category successfully added!";
			header('Location: foodCategory.php');
			}
			else
			{
				$_SESSION['status'] = "Not added";
				header('Location: foodCategory.php');
			}
		

		
		/*if (mysqli_query($connection, $query)) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $query . "<br>" . mysqli_error($connection);
		}*/
	}
?>

<?php
//Menu management
$connection = mysqli_connect("localhost","root","","final_project");

if(isset($_POST['addFoodbtn']))
	{    
			$fid = $_POST['fid'];
			$fname = $_POST['fname'];
			$fcat = $_POST['fcat'];
			$fprice = $_POST['fprice'];
			$favail = $_POST['favail'];
				
			$query = "INSERT INTO food_menu(fid,fname,fcategory_idfk,price,availability_fk) VALUES ('$fid','$fname','$fcat','$fprice','$favail')";
			$query_run = mysqli_query($connection, $query);

 			if(query_run)
			{
			//echo "error";
				$_SESSION['success'] = "Food Item added!";
				header('Location: foodmenu.php');
			}
			else
			{
				$_SESSION['status'] = "Not added";
				header('Location: foodmenu.php');
			}
		

		
		/*if (mysqli_query($connection, $query)) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $query . "<br>" . mysqli_error($connection);
		}*/
	}


//update Food menu details
	if(isset($_POST['updatefbtn']))
	{
		$fid = $_POST['efid'];
		$fname = $_POST['efname'];
		$fcat = $_POST['efcategory_idfk'];
		$fprice = $_POST['eprice'];
		$favail = $_POST['eavailability_fk'];
		
		$query = "UPDATE food_menu SET fname = '$fname', fcategory_idfk = '$fcat', price = '$fprice', availability_fk = '$favail' WHERE fid= '$fid' ";
		$query_run = mysqli_query($connection, $query);
		
		if($query_run)
		{
			//echo "saved";
			//$message = "Succefully updated";
			//echo "<script type='text/javascript'>alert('$message');</script>";
			$_SESSION['success'] = "Edited successfully";
			header('Location:foodMenu.php');

		}
		else
		{
			//$message = "Not updated! Please try again!";
			//echo "<script type='text/javascript'>alert('$message');</script>";
			$_SESSION['status'] = "Not Updated";
			header('Location:foodMenu.php');	
		}
		
	}

//food delete
if(isset($_POST['deletefoodbtn']))
	{
		$fid = $_POST['delete_fid'];
		
		$query = "DELETE FROM food_menu WHERE fid = '$fid' ";
		$query_run = mysqli_query($connection, $query);
	
		if($query_run)
		{
			//echo "saved";
			//$message = "Succefully updated";
			//echo "<script type='text/javascript'>alert('$message');</script>";
			$_SESSION['success'] = "Category Deleted!";
			header('Location:foodMenu.php');
			
			
		}
		else
		{
			//$message = "Not updated! Please try again!";
			//echo "<script type='text/javascript'>alert('$message');</script>";
			$_SESSION['status'] = "Not Deleted! Try again";
			header('Location:foodMenu.php');	
		}
	}
?>

<?php
    //offer management
    $connection = mysqli_connect("localhost","root","","final_project");

    if(isset($_POST['addOfferbtn']))
    {
        $oid = $_POST['oid'];
        $fid = $_POST['food_id'];
        $dis = $_POST['discount'];

        $query = "INSERT INTO food_offer(oid, fid, discount) VALUES ('$oid', '$fid','$dis')";
        $query_run = mysqli_query($connection, $query);

        if(query_run)
        {
            //echo "error";
            $_SESSION['success'] = "Food Offer added!";
            header('Location: offersManage.php');
        }
        else
        {
            $_SESSION['status'] = "Not added";
            header('Location: offersManage.php');
        }
    }

    //food delete
    if(isset($_POST['deleteofferbtn']))
    {
        $oid = $_POST['delete_oid'];

        $query = "DELETE FROM food_offer WHERE oid = '$oid' ";
        $query_run = mysqli_query($connection, $query);

        if($query_run)
        {
            $_SESSION['success'] = "Offer Deleted!";
            header('Location:offersManage.php');


        }
        else
        {
            //$message = "Not updated! Please try again!";
            //echo "<script type='text/javascript'>alert('$message');</script>";
            $_SESSION['status'] = "Not Deleted! Try again";
            header('Location:offersManage.php');
        }
    }
?>

