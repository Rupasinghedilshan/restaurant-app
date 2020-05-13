<?php 
include('security.php');

include('includes/header.php');
include('includes/navbar.php');
?>
    
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="reportList.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Number of Users</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                      
                      	<?php 
						  
						  require('db_con.php');
						  
							$query = "SELECT uid FROM user ORDER BY uid";
						  	$query_run = mysqli_query($connection, $query);
						  
						  	$row= mysqli_num_rows($query_run);
						  
						  echo '<h5> Total users: '.$row.' </h5>'
						?>
                      
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user-circle fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Orders</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                          <?php
                              require('db_con.php');

                              $query = "SELECT oid FROM orders ORDER BY oid";
                              $query_run = mysqli_query($connection, $query);

                              $row= mysqli_num_rows($query_run);

                              echo '<h5> Total orders: '.$row.' </h5>'
                          ?>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Categories</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                              <?php
                              require('db_con.php');

                              $query = "SELECT catid FROM food_category ORDER BY catid";
                              $query_run = mysqli_query($connection, $query);

                              $row= mysqli_num_rows($query_run);

                              echo '<h5> Total categories: '.$row.' </h5>'
                              ?>
                          </div>
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total food items</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                          <?php
                          require('db_con.php');

                          $query = "SELECT fid FROM food_menu ORDER BY fid";
                          $query_run = mysqli_query($connection, $query);

                          $row= mysqli_num_rows($query_run);

                          echo '<h5> Total items: '.$row.' </h5>'
                          ?>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-utensil-spoon fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          

          

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
</div>

<?php 
include('includes/scripts.php');
include('includes/footer.php');
?>


