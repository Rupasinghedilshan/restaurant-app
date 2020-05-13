<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reports</title>
</head>

<body>

<?php
    session_start();
    include('includes/header.php');
    include('includes/navbar.php');
    $connection = mysqli_connect("localhost","root","","final_project");
?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary"> Reports Management</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <h2> Orders</h2>
                    <ul><a href="dailyOrdersReport.php" class="btn btn-info" role="button"> Daily Orders Report</a></ul>
                    <ul><a href="monthlyOrdersReport.php" class="btn btn-info" role="button"> Monthly Orders Report</a></ul>
                <h2> Foods</h2>
                    <ul><a href="foodCategoryReport.php" class="btn btn-danger" role="button"> Food Category Report</a></ul>
                    <ul><a href="foodMenuReport.php" class="btn btn-danger" role="button"> Food Menu Report</a></ul>
                <h2>Offers</h2>
                    <ul><a href="foodOffersReport.php" class="btn btn-warning" role="button"> Food offers Report</a></ul>
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