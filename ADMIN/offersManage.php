<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Offers Manage</title>
</head>

<body>

<?php
session_start();
include('includes/header.php');
include('includes/navbar.php');
$connection = mysqli_connect("localhost","root","","final_project");
?>

<div class="modal fade" id="foodoffer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color: chocolate" id="exampleModalLabel"> Adding New Offers</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="admin.php" method="POST">

                <div class="modal-body">
                    <div class="form-group">
                        <label> Offer ID </label>
                        <input type="text" name="oid" class="form-control" placeholder="Enter Offer ID" required>
                    </div>
                    <div class="form-group">
                        <label> Food Name </label>
                        <select class="form-control required" id="food_id" name="food_id" required>
                            <option value="" style="color: black">--Select Food--</option>
                            <?php
                                include_once("process/food.php");
                                $fd = new food();
                                $des = $fd->getFoodName();
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label> Discount (%)</label>
                        <input type="number" name="discount" class="form-control" placeholder="Enter discount" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="addOfferbtn" class="btn btn-primary">Add</button>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Food Offers Managing
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#foodoffer">
                    Add food offers
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
                $query = "SELECT food_offer.*, food_menu.fname
                          FROM food_offer
                          JOIN food_menu ON food_offer.fid = food_menu.fid";
                $query_run = mysqli_query($connection,$query);
                ?>

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th> Offer ID </th>
                        <th> Food Name </th>
                        <th> Discount (%)</th>
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
                                <td><?php echo $row['oid']; ?></td>
                                <td><?php echo $row['fname']; ?></td>
                                <td><?php echo $row['discount']; ?>%</td>

                                <td>
                                    <form action="admin.php" method="post">
                                        <input type="hidden" name="delete_oid" value="<?php echo $row['oid'];?>">
                                        <button type="submit" name="deleteofferbtn" class="btn btn-danger"> DELETE</button>
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