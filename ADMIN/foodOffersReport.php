<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Management Reports</title>
</head>

<body>

<?php
session_start();
include('includes/header.php');
include('includes/navbar.php');
include('process/food.php');
$food = new food();

date_default_timezone_set("Asia/Colombo");
$dtm = date('Y-m-d / h:i:sa');
?>

<script>
    $(document).ready(function(){
        var date = "<?= $dtm;?>";
        $("#foodTable").DataTable({//dataTables plugin
            "paging": true,
            "info": false,
            "sort": true,
            "responsive": true,
            "dom": 'Bfrtip',
            "buttons": [
                {extend: 'pdf', title: 'Food offers Report - '+date,
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4]
                    }
                },
                {extend: 'print',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4]
                    },
                    text: 'Print',
                    title: ' ',
                    orientation: 'Landscape',
                    messageTop: '<h1>Eats Restaurant</h1><br><div class="pull-right"><br><?="Date-Time : ". date("Y-m-d / h:i a")?></div><div class="text-center"><br><h1>Food offers Report</h1><br></div>',
                    messageBottom: '<br><hr><div class="text-center"> <p>Eats &copy; </p> </div>'
                }
            ]
        });
    });
</script>

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Food Offers Report</h4>
            <a href="reportList.php" style="color: #fff"><button class="btn btn-danger" type="button">Go Back</button></a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="foodTable" class="table table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th> Offer ID </th>
                        <th> Food Name </th>
                        <th> Discount (%)</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    $sl=$food->foodOffersReport();
                    if(!empty($sl)){
                        foreach($sl as $item){
                            echo ("<tr id='tr_$item->fid' data-toggle=\"tooltip\">
                                <td>$item->fid</td>
                                <td>$item->fname</td>
                                <td>$item->discount%</td>
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

</body>
</html>