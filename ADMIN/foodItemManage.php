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

			if(isset($_POST['foodEdit_btn']))
			{
				$fid = $_POST['edit_id'];
				$query = "SELECT * FROM food_menu WHERE fid = '$fid' "; 
				$query_run = mysqli_query($connection, $query);

				foreach ($query_run as $row)
				{
	?>
	
	<div class="container-fluid">

		
		<div class="card shadow mb-4">
		  	<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Edit Menu Item Details
				</h6>
		  	</div>
		  	
		  <!--	form-->
		  	<form action="admin.php" method="POST">
		  	<div class="card-body">
		  	
		  		<div class="form-group">
					<label> Food id </label>
					<input type="text" value="<?php echo $row['fid'] ?>" name="efid" class="form-control" placeholder="" readonly> 
				</div>
				<div class="form-group">
					<label> Food Name </label>
					<input type="text" value="<?php echo $row['fname'] ?>" name="efname" class="form-control" placeholder="Enter Food item" required>
				</div>
				<div class="form-group">
					<label> Food Category </label>
					<input type="text" value="<?php echo $row['fcategory_idfk'] ?>" name="efcategory_idfk" class="form-control" placeholder="Enter Category" required>
				</div>
				<div class="form-group">
					<label> price </label>
					<input type="text" value="<?php echo $row['price'] ?>" name="eprice" class="form-control" placeholder="Price" required>
				</div>
				<div class="form-group">
					<label> Avialability </label>
					<input type="text" value="<?php echo $row['availability_fk'] ?>" name="eavailability_fk" class="form-control" placeholder="Update Availability" required>
				</div>
				
			</div>
			
			</div>
			<div class="modal-footer" align="center">
				<a href="foodMenu.php" class="btn btn-danger"> Cancel </a>
				<button type="submit" name="updatefbtn" class="btn btn-primary">Update</button>
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