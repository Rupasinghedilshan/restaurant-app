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

			if(isset($_POST['editTable']))
			{
				$tbid = $_POST['edit_tbid'];
				$query = "SELECT * FROM tables WHERE tbid = '$tbid' "; 
				$query_run = mysqli_query($connection, $query);

				foreach ($query_run as $row)
				{
					?>
					
		<div class="container-fluid">

		<
		<div class="card shadow mb-4">
		  	<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Edit Tables
				</h6>
		  	</div>
		  	
		  <!--	form-->
		  	<form action="admin.php" method="POST">
		  	<div class="card-body">
		  	
		  		<div class="form-group">
					<label> Table id </label>
					<input type="text" value="<?php echo $row['tbid'] ?>" name="etbid" class="form-control" placeholder="" readonly> 
				</div>
				<div class="form-group">
					<label> Table Number </label>
					<input type="text" value="<?php echo $row['tnumber'] ?>" name="etnumber" class="form-control" placeholder="Enter Table Number" required>
				</div>
			</div>
			
			</div>
			<div class="modal-footer" align="center">
				<a href="manageTables.php" class="btn btn-danger"> Cancel </a>
				<button type="submit" name="updateTable" class="btn btn-primary">Update</button>
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