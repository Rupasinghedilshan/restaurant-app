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
    if(!empty($_POST['start_date']) && !empty($_POST['end_date'])){
        $sdate = $_POST['start_date'];
        $edate = $_POST['end_date'];
    }
    else{
        $sdate = date('Y-m-01' );
        $edate = date('Y-m-t' );
    }
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
                {extend: 'pdf', title: 'Monthly Orders Report - '+date,
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
                    messageTop: '<h1>Eats Restaurant</h1><br><div class="pull-right"><br><?="Date-Time : ". date("Y-m-d / h:i a")?></div><div class="text-center"><br><h1>Monthly Orders Report</h1><br></div>',
                    messageBottom: '<br><hr><div class="text-center"> <p>Eats &copy; </p> </div>'
                }
            ]
        });
    });
</script>

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <form id="searchDate" class="form-horizontal" method="post" action="monthlyOrdersReport.php">
                <div class="row">
                    <div class="form-group col-md-3 col-sm-4" style="margin-left: 5px;">
                        Start Date:
                        <input type="text" name="start_date" class="form-control" id="start_date" style="height: 35px;" readonly placeholder="YYYY-MM-DD">
                    </div>
                    <div class="form-group col-md-3 col-sm-4" style="margin-left: 5px;">
                        End Date:
                        <input type="text" name="end_date" class="form-control" id="end_date" style="height: 35px;" readonly placeholder="YYYY-MM-DD">
                    </div>
                    <div class="form-action" class="form-group col-sm-1" style="padding-top: 30px;">
                        <input type="submit" class="btn btn-primary" value="Search" id="btnformsearch" style="height: 35px;">
                    </div>
                </div>
                <div class="row">
                    <div align="left" style="margin-left: 25px;"><h3><b><?="Date Range : "."$sdate"." - "."$edate"; ?></b></h3></div><br>
                </div>
            </form>
            <h4 class="m-0 font-weight-bold text-primary">Monthly Orders Report</h4>
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
                    $sl=$ord->getMonthlyOrdersReport($sdate, $edate);
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
<script>
    var date_input=$('input[name="start_date"]'); // date input has the name "date"
    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    date_input.datepicker({
        format: 'yyyy-mm-dd',
        container: container,
        todayHighlight: true,
        autoclose: true
    });
    var date_input=$('input[name="end_date"]'); // date input has the name "date"
    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    date_input.datepicker({
        format: 'yyyy-mm-dd',
        container: container,
        todayHighlight: true,
        autoclose: true
    });
</script>

</body>
</html>