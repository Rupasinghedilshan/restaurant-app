<?php
include("header.php");
include_once("process/order.php");
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
                            <th>Status</th>
                            <th>Action</th>
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
                                        <td>$item->totalprice</td>
                                        <td>$item->date</td>
                                        <td>$item->state</td>
                                        <td class='text-center'>
                                             <a class='btn btn-sm btn-success Order_Complete' data-ordid = '$item->oid'
                                             id = \"btnComplete$item->oid\" data-toggle = \"tooltip\" title = 'Order Complete' > 
                                             <i class='fas fa-check-square' ></i ></a >
                                        </td >
                                        <script>
                                            var stat = '$item->state';
                                            var idm = '$item->oid';
                                            if(stat === 'Complete'){
                                                $('#btnComplete'+idm).attr(\"disabled\", true);
                                                $('#btnComplete'+idm).attr('onclick','').unbind('click');
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

<script>
    jQuery(document).on("click", ".Order_Complete", function(){
        var ordid = $(this).data("ordid");
        $.confirm({
            title: 'Confirm!',
            content: 'Are you sure you want to complete the order?',
            type: 'orange',
            buttons: {
                confirm: function () {
                    var url = "controller/order_controller.php?type=order_complete"; //location of the loading page
                    $.post(url, {ordid:ordid}, function (data, status) {
                        if(data === "Done"){//if success
                            //pop-up success message
                            $.confirm({
                                title: 'Done!',
                                content: 'Order is Completed!',
                                type: 'green',
                                typeAnimated: true,
                                animationBounce: 'RotateYR',
                                closeAnimation: 'scale',
                                buttons: {
                                    tryAgain: {
                                        text: 'Ok',
                                        btnClass: 'btn-green',
                                        action: function(){
                                            window.location.href ="kitchenMain.php";//redirect to the manage order page
                                        }
                                    },
                                    close: function () {
                                        window.location.href ="kitchenMain.php";//redirect to the manage order page
                                    }
                                }
                            });
                        }
                        else {
                            //pop-up error message
                            $.confirm({
                                title: 'Oops..!',
                                content: 'Something went wrong!',
                                type: 'red',
                                typeAnimated: true,
                                animationBounce: 'RotateYR',
                                closeAnimation: 'scale',
                                buttons: {
                                    tryAgain: {
                                        text: 'Try again',
                                        btnClass: 'btn-red',
                                        action: function(){
                                            window.location.href ="kitchenMain.php";//redirect to the manage order page
                                        }
                                    },
                                    close: function () {
                                        window.location.href ="kitchenMain.php";//redirect to the manage order page
                                    }
                                }
                            });
                        }
                    });
                },
                close: function () {
                    window.location.href ="kitchenMain.php";//redirect to the manage order page
                }
            }
        });
    });
</script>
