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
                {extend: 'pdf', title: 'Food Category Report - '+date,
                    exportOptions: {
                        columns: [ 0, 1]
                    }
                },
                {extend: 'print',
                    exportOptions: {
                        columns: [ 0, 1]
                    },
                    text: 'Print',
                    title: ' ',
                    orientation: 'Landscape',
                    messageTop: '<h1>Eats Restaurant</h1><br><div class="pull-right"><br><?="Date-Time : ". date("Y-m-d / h:i a")?></div><div class="text-center"><br><h1>Food Category Report</h1><br></div>',
                    messageBottom: '<br><hr><div class="text-center"> <p>Eats &copy; </p> </div>'
                }
            ]
        });
    });
</script>

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Food Category Report</h4>
            <a href="reportList.php" style="color: #fff"><button class="btn btn-danger" type="button">Go Back</button></a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="foodTable" class="table table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    $sl=$food->foodCategoryReport();
                    if(!empty($sl)){
                        foreach($sl as $item){
                            echo ("<tr id='tr_$item->catid' data-toggle=\"tooltip\">
                                <td>$item->catid</td>
                                <td>$item->catname</td>
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