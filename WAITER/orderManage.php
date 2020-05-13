<?php
    include("header.php");
    include_once("process/order.php");
    $ord = new order();

    date_default_timezone_set("Asia/Colombo");
    $dtm = date('Y-m-d / h:i:sa');

    $uid = ($_SESSION['uid']);
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
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default" style="background-color: #fff;">
            <div>
                <br><h1>Orders List</h1>
            </div>
            <div class="panel-body">
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
                                $sl=$ord->getOrdersList($uid);
                                if(!empty($sl)){
                                    foreach($sl as $item){
                                        echo ("<tr id='tr_$item->oid' data-toggle=\"tooltip\">
                                            <td>$item->oid</td>
                                            <td>$item->tnumber</td>
                                            <td>$item->uname</td>
                                            <td>$item->totalitems</td>
                                            <td>$item->totalprice</td>
                                            <td>$item->date</td>
                                            <td>$item->state</td>
                                            <script>
                                                var stat = '$item->state';
                                                var idm = '$item->oid';
                                                if(stat === 'Complete'){
                                                    $(\"#tr_\"+idm).css(\"background-color\", \"#ea504d\");
                                                    $(\"#tr_\" + idm).attr('title', 'Order has been completed');
                                                }
                                                else{
                                                    $(\"#tr_\" + idm).attr('title', 'Order is processing');
                                                }
                                            </script>
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
</div>


<?php
    include("footer.php");
?>
