<?php
    include("header.php");
    include_once("process/food.php");
    $fd = new food();

    date_default_timezone_set("Asia/Colombo");
    $dtm = date('Y-m-d / h:i:sa');
?>
<script>
    //include data tables for the customer list
    $(document).ready(function(){
        var date = "<?= $dtm;?>";
        $("#foodTable").DataTable({//dataTables plugin
            "paging": true,
            "info": false,
            "sort": true,
            "responsive": true,
            "dom": 'Bfrtip',
            "order": [[0,"desc"]],
            "buttons": [
                {extend: 'pdf', title: 'Menu List Report - '+date,
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5]
                    }
                },
                {extend: 'print',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5]
                    },
                    text: 'Print',
                    title: ' ',
                    orientation: 'Landscape',
                    messageTop: '<h1>Eats Restaurant</h1><br><div class="pull-right"><br><?="Date-Time : ". date("Y-m-d / h:i a")?></div><div class="text-center"><br><h1>Menu List Report</h1><br></div>',
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
                <br><h1>Food Items</h1>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="foodTable" class="table table-bordered nowrap" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Cuisine</th>
                            <th>Food Name</th>
                            <th>Price</th>
                            <th>State</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php
                        $sl=$fd->getFoodList();
                        if(!empty($sl)){
                            foreach($sl as $item){
                                echo ("<tr id='tr_$item->fid'>
                                        <td>$item->fid</td>
                                        <td>$item->category</td>
                                        <td>$item->cuisine</td>
                                        <td>$item->fname</td>
                                        <td>$item->price</td>
                                        <td>$item->state</td>
                                        <td class='text-center'>
                                            <a class='btn btn-sm btn-danger' data-toggle=\"tooltip\" title='Delete'  id=\"btnDelete$item->fid\" onclick='dd(\"$item->fid\")'  style='display: none'><i class='fa fa-trash'></i></a>
                                            <a class='btn btn-sm btn-success' data-toggle=\"tooltip\" title='Reactive'  id=\"btnActive$item->fid\" onclick='aa(\"$item->fid\")'  style='display: none'><i class='fa fa-check'></i></a>
                                        </td>
                                        <script>
                                            var stat = '$item->state';
                                            var idm = '$item->fid';
                                            if(stat === 'Available'){
                                                $('#btnDelete'+idm).show();
                                            }
                                            else if(stat === 'Unavailable'){
                                                $('#btnActive'+idm).show();
                                                $('#btnEdit'+idm).attr('onclick','').unbind('click');
                                                $(\"#tr_\"+idm).css(\"background-color\", \"#f7c9c8\");
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
    //call to service deactivation function
    function dd(uid){
        //confirmation message
        $.confirm({
            title: 'Confirm!',
            content: 'Are you sure you want to Deactivate? Food='+uid,
            type: 'red',
            buttons: {
                confirm: function () {
                    var url = "controller/food_controller.php?type=deactive_food"; //location of the loading page
                    $.post(url, {uid: uid}, function (data, status) {
                        if (data == "Done") {//if function success
                            //success message
                            $.confirm({
                                title: 'Done!',
                                content: 'Food Successfully Deactivated!',
                                type: 'green',
                                typeAnimated: true,
                                animationBounce: 'RotateYR',
                                closeAnimation: 'scale',
                                buttons: {
                                    tryAgain: {
                                        text: 'OK',
                                        btnClass: 'btn-green',
                                        action: function () {
                                            window.location.href = "foodManage.php";//redirect to the services list
                                        }
                                    },
                                    close: function () {
                                        window.location.href = "foodManage.php";//redirect to the services list
                                    }
                                }
                            });
                        }
                        else {
                            //error message
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
                                            window.location.href = "foodManage.php";//redirect to the services list
                                        }
                                    },
                                    close: function () {
                                        window.location.href = "foodManage.php";//redirect to the services list
                                    }
                                }
                            });
                        }
                    });
                },
                close: function () {
                }
            }
        });
    }

    //call to service reactivation function
    function aa(uid){
        //confirmation message
        $.confirm({
            title: 'Confirm!',
            content: 'Are you sure you want to Reactive? Food='+uid,
            type: 'red',
            buttons: {
                confirm: function () {
                    var url = "controller/food_controller.php?type=reactive_food"; //location of the loading page
                    $.post(url, {uid: uid}, function (data, status) {
                        if (data == "Done") {//if function success
                            //success message
                            $.confirm({
                                title: 'Done!',
                                content: 'Food Successfully Reactivated!',
                                type: 'green',
                                typeAnimated: true,
                                animationBounce: 'RotateYR',
                                closeAnimation: 'scale',
                                buttons: {
                                    tryAgain: {
                                        text: 'OK',
                                        btnClass: 'btn-green',
                                        action: function () {
                                            window.location.href = "foodManage.php";//redirect to the services list
                                        }
                                    },
                                    close: function () {
                                        window.location.href = "foodManage.php";//redirect to the services list
                                    }
                                }
                            });
                        }
                        else {
                            //error message
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
                                            window.location.href = "foodManage.php";//redirect to the services list
                                        }
                                    },
                                    close: function () {
                                        window.location.href = "foodManage.php";//redirect to the services list
                                    }
                                }
                            });
                        }
                    });
                },
                close: function () {
                }
            }
        });
    }
</script>
