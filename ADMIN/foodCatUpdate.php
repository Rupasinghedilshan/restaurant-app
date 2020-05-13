<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>

<?php 
session_start();
include('includes/header.php'); 
include('includes/navbar.php'); 
?>

 
		<?php
			$connection = mysqli_connect("localhost","root","","final_project");

			if(isset($_POST['catEdit_btn']))
			{
				$catid = $_POST['edit_id'];
				$query = "SELECT * FROM food_category WHERE catid = '$catid' "; 
				$query_run = mysqli_query($connection, $query);

				foreach ($query_run as $row)
				{
					?>
					
		<div class="container-fluid">

		
		<div class="card shadow mb-4">
		  	<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Edit Category Details
				</h6>
		  	</div>
		  	
		  <!--	form-->
		  	<form action="admin.php" method="POST">
		  	<div class="card-body">
		  	
		  		<div class="form-group">
					<label> Category id </label>
					<input type="text" value="<?php echo $row['catid'] ?>" name="ecatid" class="form-control" placeholder="Enter User ID" readonly> 
				</div>
				<div class="form-group">
					<label> category </label>
					<input type="text" value="<?php echo $row['catname'] ?>" name="ecatname" class="form-control" placeholder="Enter category" required>
				</div>
				
			</div>
			
			</div>
			<div class="modal-footer" align="center">
				<a href="foodCategory.php" class="btn btn-danger"> Cancel </a>
				<button type="submit" name="updateCatbtn" class="btn btn-primary">Update</button>
			</div>
			
			</form>
		</div>		

				<?php
				}
			}

?>
            
        

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>



</body>
</html>