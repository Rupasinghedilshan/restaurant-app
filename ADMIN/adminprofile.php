<?php
session_start(); 
include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<div class="modal fade" id="" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
  <div class="modal-dialog" role="document"> 
    <div class="modal-content"> 
      <div class="modal-header"> 
        <h5 class="modal-title" id="exampleModalLabel">Admin Data</h5> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
          <span aria-hidden="true">&times;</span> 
        </button> 
      </div> 
      <form action="" method="POST"> 

        <div class="modal-body"> 
				
            <div class="form-group">
                <label> User id </label>
                <input type="text" name="uid" class="form-control" placeholder="Enter User ID" required> 
            </div> 
            <div class="form-group"> 
                <label>User name</label> 
                <input type="text" name="uname" class="form-control" placeholder="Enter Name" required> 
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="upass" class="form-control" placeholder="Enter Password" required>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="ucpass" class="form-control" placeholder="Confirm Password" required>
            </div>
            <div class="form-group">
                <label>Contact</label>
                <input type="number" name="contact" class="form-control" placeholder="Enter mobile number" required>
			</div>                              
        	</div>
           
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="editadminbtn" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>



<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Admin Profile 
    	
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
		$query = "SELECT * FROM user_type INNER JOIN user ON user.utype_fk = user_type.utid WHERE utid =1";
		$query_run = mysqli_query($connection,$query);
	 ?>
     
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> Admin ID </th>
            <th> Username </th>
            <th> Password</th>
            <th> Contact </th>
            <th> EDIT </th>
            <!--<th> DELETE </th>-->
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
           <td><?php echo $row['uid']; ?></td>
           <td><?php echo $row['uname']; ?></td>
           <td><?php echo $row['upass']; ?></td>
           <td><?php echo $row['contact']; ?></td>
           
            <td>
                <form action="manageAdmin.php" method="post">
                    <input type="hidden" name="edit_id" value="<?php echo $row['uid']?>">
                    <button type="submit" data-toggle="" name="edit_btn" class="btn btn-success" data-target="">EDIT</button>
                </form>
            </td>
            <!--<td>
                <form action="" method="post">
                  <input type="hidden" name="delete_id" value="">
                  <button type="submit" name="delete_btn" class="btn btn-danger"> DELETE</button>
                </form>
            </td>-->
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

<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>