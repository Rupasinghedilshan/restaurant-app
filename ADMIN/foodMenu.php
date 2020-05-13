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
$connection = mysqli_connect("localhost","root","","final_project");
?>

<div class="modal fade" id="foodmenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
  <div class="modal-dialog" role="document"> 
    <div class="modal-content"> 
      <div class="modal-header"> 
        <h5 class="modal-title" style="color: chocolate" id="exampleModalLabel"> Adding New Food Items</h5> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
          <span aria-hidden="true">&times;</span> 
        </button> 
      </div> 
      <form action="admin.php" method="POST"> 

        	<div class="modal-body"> 
            	<div class="form-group">
					<label> Food ID </label>
					<input type="text" name="fid" class="form-control" placeholder="Enter food ID" required > 
				</div>
				<div class="form-group">
					<label> Item Name </label>
					<input type="text" name="fname" class="form-control" placeholder="Enter Item name" required> 
				</div>
				<div class="form-group">
					<label> Food category </label>
					<input type="text" name="fcat" class="form-control" placeholder="Food Category" required>
				</div>
				<div class="form-group">
					<label> Price </label>
					<input type="text" name="fprice" class="form-control" placeholder="Enter price" required>
				</div>
				<div class="form-group">
					<label> Availabilty </label>
					<input type="text" name="favail" class="form-control" placeholder="Item Availability" required>
				</div>
       	  	</div>                   
       	  
        	<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" name="addFoodbtn" class="btn btn-primary">Add</button>
        	</div>
      	</form>

    </div>
  </div>
</div>

<div class="container-fluid">

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Food Item Managing
    	<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#foodmenu">
              Add food items
        </button>
    </h6>
  </div>

  <div class="card-body">
    
<!--    session for showing the message--> 			     
  
   <?php 
	  if(isset($_SESSION['success']) && $_SESSION['success'] != '') 
		 {
		  echo '<h2 style="color: crimson">'.$_SESSION['success'].'</h2>';
		  unset($_SESSION['success']);
	  	 }
	  
	  if(isset($_SESSION['status']) && $_SESSION['status'] != '') 
		 {
		  echo '<h2 style="color: crimson">'.$_SESSION['status'].'</h2>';
		  unset($_SESSION['status']);
	  	 }
	 ?>

    <div class="table-responsive">

    
     <?php
		$connection = mysqli_connect("localhost", "root", "", "final_project");
		$query = "SELECT * FROM food_menu";
		$query_run = mysqli_query($connection,$query);
	 ?>
     
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> Food ID </th>
            <th> Food Name </th>
            <th> Food Category</th>
            <th> Price </th>
            <th> Availability </th>
            <th> Edit</th>
            <th> Delete</th>
          </tr>
        </thead>
        <tbody>
     
         <?php
			if(mysqli_num_rows($query_run) > 0)
			{
				while($row = mysqli_fetch_assoc($query_run))
				{
					?>
					
          <tr>
           <td><?php echo $row['fid']; ?></td>
           <td><?php echo $row['fname']; ?></td>
           <td><?php echo $row['fcategory_idfk']; ?></td>
           <td><?php echo $row['price']; ?></td>
           <td><?php echo $row['availability_fk']; ?></td>
           
            <td>
                <form action="foodItemManage.php" method="post">
                    <input type="hidden" name="edit_id" value="<?php echo $row['fid'];?>">
                    <button type="submit" data-toggle="" name="foodEdit_btn" class="btn btn-success" data-target="">EDIT</button>
                </form>
            </td>
            <td>
                <form action="admin.php" method="post">
                  <input type="hidden" name="delete_fid" value="<?php echo $row['fid'];?>">
                  <button type="submit" name="deletefoodbtn" class="btn btn-danger"> DELETE</button>
                </form>
            </td>
          </tr>
        
        <?php
				}
			}
			
			else
			{
				echo "No record found!";
			}
			
			?>
        
        </tbody>
      </table>

    </div>
  </div>
</div>
</div>


<?php
include('includes/scripts.php');
include('includes/footer.php');
?>

</body>
</html>