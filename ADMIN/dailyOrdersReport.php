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
    include('process/order.php');
    $ord = new order();

    date_default_timezone_set("Asia/Colombo");
    $dtm = date('Y-m-d / h:i:sa');
?>

<script>
    $(document).ready(function(){
        var date = "<?= $dtm;?>";
        $("#orderTable").DataTable({//dataTables plugin
            "paging": true,
            "info": false,
            "sort": true,
            "responsive": true,
            "dom": 'Bfrtip',
            "buttons": [
                {extend: 'pdf', title: 'Daily Orders Report - '+date,
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6]
                    }
                },
                {extend: 'print',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6]
                    },
                    text: 'Print',
                    title: ' ',
                    orientation: 'Landscape',
                    messageTop: '<h1>Eats Restaurant</h1><br><div class="pull-right"><br><?="Date-Time : ". date("Y-m-d / h:i a")?></div><div class="text-center"><br><h1>Daily Orders Report</h1><br></div>',
                    messageBottom: '<br><hr><div class="text-center"> <p>Eats &copy; </p> </div>'
                }
            ]
        });
    });
</script>

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Daily Orders Report</h4>
            <a href="reportList.php" style="color: #fff"><button class="btn btn-danger" type="button">Go Back</button></a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="orderTable" class="table table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Table</th>
                        <th>Waiter</th>
                        <th>Total Items</th>
                        <th>Total Amount</th>
                        <th>Date</th>
                        <th>State</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    $tot = 0;
                    $sl=$ord->getDailyOrdersReport();
                    if(!empty($sl)){
                        foreach($sl as $item){
                            $tot = $tot + $item->totalprice;
                            echo ("<tr id='tr_$item->oid' data-toggle=\"tooltip\">
                                <td>$item->oid</td>
                                <td>$item->tnumber</td>
                                <td>$item->uname</td>
                                <td>$item->totalitems</td>
                                <td>$item->totalprice.00</td>
                                <td>$item->date</td>
                                <td>$item->state</td>
                            </tr>");
                        }
                    }
                    ?>
                    </tbody>
                    <tfoot>
                        <tr  style="background-color: #3fe6b3">
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Total:</th>
                            <th><?= $tot; ?>.00</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
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