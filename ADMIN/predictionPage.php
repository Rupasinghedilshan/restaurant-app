<?php
    session_start();
    include('includes/header.php');
    include('includes/navbar.php');
    include('process/prediction.php');
    $pre = new prediction();

?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Orders Prediction List</h4>
        </div>

        <div class="card-body">
        <form action="predictionPage.php" method="get">
            <div class="form-group w-50" style="align-content: center">
                <a style="color: darkblue;"><b>Type the Week Number</b> : </a>
                <input type="number" class="form-control input-normal" name="week"><br>
                <input type="submit" value="Predict the Orders" class="btn btn-info">
            </div>
        </form>
        <br>
            <div class="table-responsive">
                <table id="foodTable" class="table table-bordered" cellspacing="0" width="100%">
                    <thead style="color: darkblue; background-color: darkseagreen">
                    <tr >
                        <th>Food Name</th>
                        <th>Price</th>
                        <th>Number of orders</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    $week = 0;
                    if (isset($_GET['week'])) {
                        $week = $_GET["week"];
                    }
                    $sl = $pre->getOrdersForPrediction($week);

                    if(!empty($sl)){
                        foreach($sl as $item){
                            echo ("<tr>
                                <td>".$item['fname']."</td>
                                <td>".$item['price']."</td>
                                <td>".$item['predicted_orders']."</td>
                            </tr>");
                        }
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
