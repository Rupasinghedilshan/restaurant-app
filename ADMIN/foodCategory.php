<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>

	<?php
	//include('security.php');
	session_start();
	include('includes/header.php'); 
	include('includes/navbar.php'); 
	$connection = mysqli_connect("localhost","root","","final_project");
	?>

<div class="modal fade" id="CategoryNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
  <div class="modal-dialog" role="document"> 
    <div class="modal-content"> 
      <div class="modal-header"> 
        <h5 class="modal-title" style="color: chocolate" id="exampleModalLabel">Waiter profile creating</h5> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
          <span aria-hidden="true">&times;</span> 
        </button> 
      </div> 
      <form action="admin.php" method="POST"> 

        	<div class="modal-body"> 
				
            	<div class="form-group">
						<label> Category id </label>
						<input type="text" name="catid" class="form-control" placeholder="This will automatically generate" readonly> 
				</div>
				<div class="form-group">
						<label> Category Name </label>
						<input type="text" name="catname" class="form-control" placeholder="Enter Food Category" required> 
				</div>
       	  	</div>                   
       	  
        	<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" name="addCategorybtn" class="btn btn-primary">Add New</button>
        	</div>
      	</form>

    </div>
  </div>
</div>

<div class="container-fluid">

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Food Category Managing
    	<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#CategoryNew">
              Add Food Category
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
		$query = "SELECT * FROM food_category WHERE catid ";
		$query_run = mysqli_query($connection,$query);
	 ?>
     
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> Category ID </th>
            <th> Category Name </th>
            <th> EDIT </th>
            <th> DELETE </th>
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
           <td><?php echo $row['catid']; ?></td>
           <td><?php echo $row['catname']; ?></td>
                      
            <td>
                <form action="foodCatUpdate.php" method="post">
                    <input type="hidden" name="edit_id" value="<?php echo $row['catid']?>">
                    <button type="submit" data-toggle="" name="catEdit_btn" class="btn btn-success" data-target="">EDIT</button>
                </form>
            </td>
            <td>
                <form action="admin.php" method="post">
                  <input type="hidden" name="delete_catid" value="<?php echo $row['catid']; ?>">
                  <button type="submit" name="deletecatbtn" class="btn btn-danger"> DELETE</button>
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