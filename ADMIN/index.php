
 <?php
	session_start();
	include('includes/header.php'); 
 ?>

<!--Login Page-->
  <div class="container" >
<br>
<br>
<br>
    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5" >
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row" style="width: 100%;">
              <div class="col-lg-6 d-none d-lg-block" style="background-image: url(img/petr-sevcovic-qE1jxYXiwOA-unsplash.jpg); background-size: cover; width: 100%;"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome! Login Here</h1>
                    
                    <?php 
					  if(isset($_SESSION['status']) && $_SESSION['status'] !='')
					  {
						  echo '<h4>'.$_SESSION['status'].'</h4>';
						  unset($_SESSION['status']);
					  }
					  
					?>

                  </div>
                  
                  <form class="user" action="admin.php" method="POST">
                    <div class="form-group">
                      <input type="text" name="uname" class="form-control form-control-user" placeholder="Username">
                    </div>
                    <div class="form-group">
                      <input type="password" name="upass" class="form-control form-control-user"  placeholder="Password">
                    </div>
                   
                    <button type="submit" name="btnLogin" class="btn btn-primary btn-user btn-block">
                      Login
					</button>
                    <hr>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="">Forgot Password?</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
  


<?php
	include('includes/scripts.php');
?>



