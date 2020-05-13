<?php 
//session_destroy();
//ob_start();
session_start();

//include('db_con.php');
//$connection = mysqli_connect("localhost","root","","final_project");

if(!$_SESSION['uname']){
	
	header('Location: loginPage.php');
}
?>