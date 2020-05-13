<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Management</title>
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
                {extend: 'pdf', title: 'Order Report - '+date,
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
                    messageTop: '<h1>Eats Restaurant</h1><br><div class="pull-right"><br><?="Date-Time : ". date("Y-m-d / h:i a")?></div><div class="text-center"><br><h1>Order Report</h1><br></div>',
                    messageBottom: '<br><hr><div class="text-center"> <p>Eats &copy; </p> </div>'
                }
            ]
        });
    });
</script>

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Order Managing</h6>
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
                    $sl=$ord->getOrdersList();
                    if(!empty($sl)){
                        foreach($sl as $item){
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