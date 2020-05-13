<?php
    include("header.php");
    include_once("process/food.php");
    $food = new food();

    $sql = "SELECT catname FROM food_category;";
    $res = $food->db->query($sql);

    $sql = "SELECT fid, fname, price FROM food_menu WHERE availability_fk = 1 GROUP BY fid;";
    $res1 = $food->db->query($sql);
?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default" style="background-color: white;">
            <div><br>
                <h1 style="color: black; font-family: Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana,' sans-serif'";>Menu Items</h1>
            </div>
            <div class="panel-body" style="background-color: white">
                <form role="form" id="f1" class="form-horizontal" method="post" action="#" enctype="multipart/form-data" data-toggle="validator" >
                    <script type="text/javascript">
                        $(document).on('ready', function () {
                            $("#searchProd").keyup(function () {
                                // Retrieve the input field text
                                var filter = $(this).val();
                                $("#pilltabAll #proname").each(function () {
                                    if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                                        $(this).parent().hide();
                                    } else {
                                        $(this).parent().show();
                                    }
                                });
                            });
                        });
                    </script>
                    <div class="col-md-12">
                        <div class="panel panel-default" style="">
                            <div class="panel-body tabs">
                                <div class="row" style="margin-left: 0px; margin-right: 0px;">
                                    <div class="col-md-12" style="padding-left: 15px; padding-right: 15px; padding-top: 10px;">
                                        <input type="text" class="form-control" placeholder="Search Food By Name or Code" id="searchProd" style="font-family: Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana,' sans-serif';"/>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12 slider" style=" padding-top: 10px; margin-left: auto; margin-right: auto;">
                                        <div class="col-md-3 col-sm-3 col-xs-6" style="margin-left: -10px; margin-right: -10px;">
                                            <div class="well" style="background-color:coral; color: #fff; width: auto; height: auto; text-align: center;">
                                                <div data-toggle="tab" href="#pilltabAll" style="width: auto; height: 70px; padding-top: 10px; font-size: 16pt;">All</div>
                                            </div>
                                        </div>

                                        <?php while($foodcat = mysqli_fetch_assoc($res)) : ?>
                                            <div class="col-md-3 col-sm-3 col-xs-6" style="margin-left: -10px; margin-right: -10px;">
                                                <div class="well" style="background-color: coral; color: #fff; width: auto; height: auto; text-align: center;">
                                                    <div data-toggle="tab" href="#pilltab<?php echo $foodcat['catname']; ?>" style="width: auto; height: 70px; padding-top: 10px; font-size: 16pt;"><?php echo $foodcat['catname']; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endwhile; ?>
                                    </div>
                                </div>

                                <div class="tab-content" style="overflow-y: scroll; height: 400px; width: auto;" id="allProd">
                                    <?php
                                    $pp = 0;
                                    ?>
                                    <div class="tab-pane fade in active" id="pilltabAll" style="margin-left: 70px;">
                                        <?php while($dish = mysqli_fetch_assoc($res1)) :
                                            if(is_file("C:/xa/htdocs/finalproject/WAITER/uploads/foods/".$dish['fid'].".jpg")){
                                                $food_img = "http://localhost/finalproject/WAITER/uploads/foods/".$dish['fid'].".jpg";
                                            }
                                            else{
                                                $food_img = "http://localhost/finalproject/WAITER/uploads/foods/food_def.jpg";
                                            }
                                            ?>

                                            <button type="button" id="item" value="<?php echo $dish['fid']; ?>"
                                                    style="line-height: 20px; margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 10px 10px 10px 10px; background-color: ivory; border: 1px solid #FFFFFF; color: #000; font-family: Arial, Helvetica, sans-serif; font-size: 16px; width: 150px; height: 180px;" onclick="additemstoOrder(this.value,'<?php echo $dish['fid']; ?>','<?php echo $dish['fname']; ?>')"><span><img src="<?php echo "$food_img";?>" style="padding-bottom: 12px; width:100%; height: 110px;"/></span><br>
                                                <span id="proname"><?php echo $dish['fname']; ?><br/>Rs: <?php echo $dish['price']; ?></span>
                                            </button>
                                        <?php endwhile; ?>
                                    </div>

                                    <?php
                                    $catData = $food->getOrdFoodCat();
                                    for ($ca = 0; $ca < count($catData); ++$ca) {
                                        $category = $catData[$ca]->food_cat;
                                        ?>

                                        <div class="tab-pane fade in <?php if ($ca == 0) {
                                            ?><?php
                                        } ?>" id="pilltab<?php echo $category; ?>" style="margin-left: 70px;">
                                            <?php
                                                $food = new food();
                                                $sql = "SELECT fid, fname, price FROM food_menu WHERE category='$category' AND availability_fk = 1 GROUP BY fid;";
                                                $res2 = $food->db->query($sql);
                                            ?>
                                            <?php while($dish = mysqli_fetch_assoc($res2)) :
                                                if(is_file("C:/xa/htdocs/finalproject/WAITER/uploads/foods/".$dish['fid'].".jpg")){
                                                    $food_img = "http://localhost/finalproject/WAITER/uploads/foods/".$dish['fid'].".jpg";
                                                }
                                                else{
                                                    $food_img = "http://localhost/finalproject/WAITER/uploads/foods/food_def.jpg";
                                                }
                                                ?>
                                                <button type="button" id="item" value="<?php echo $dish['fid']; ?>"
                                                          style="line-height: 20px; margin-top: 10px; margin-left: 19px; border-radius: 5px; padding: 10px 10px 10px 10px; background-color: ivory; border: 1px solid #FFFFFF; color: #000; font-family: Arial, Helvetica, sans-serif; font-size: 16px; width: 150px; height: 180px;"
                                                          onclick="additemstoOrder(this.value,'<?php echo $dish['fid']; ?>','<?php echo $dish['fname']; ?>')"><span><img src="<?php echo "$food_img";?>" style="padding-bottom: 5px; width:100%; height: 120px;"/></span><br><span id="proname"><?php echo $dish['fname']; ?><br/>Rs: <?php echo $dish['price']; ?></span>
                                                </button>
                                            <?php endwhile; ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div><!--/.panel-->
                    </div><!-- Product List // END -->
                    
                    <!--cart-->
                    <div class="col-sm-12">
                        <div style="overflow-y: scroll; height: 330px; width: 100%;">
                            <!--<div id="log"></div>-->
                            <input type="text" class="form-control required" id="itcount" value="0" name="itcount" style="display: none;"/>
                            <div class="box-body table-responsive no-padding"  style="border-radius: 10px;">
                                <table id="itemtbl" class="table itemtbl">
                                    <thead>
                                        <tr style="background-color: #515151; color: #FFF; font-weight: bold; padding-top: 10px; padding-bottom: 10px; margin: 0px; margin-top: 7px; position: static;">
                                            <th>Dish Name</th>
                                            <th>Quantity</th>
                                            <th>Per Dish</th>
                                            <th>Sub Total</th>
                                            <th id="action">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="background-color: #515151; border-radius: 10px; margin-left: 10px; width: 95%;">
                                <div class="row" style="margin: 0px; font-weight: bold; font-size: 11pt; color: #FFF; padding-top: 5px;">
                                    <div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">
                                        <table border="0" style="border-collapse: collapse;" width="100%" height="auto">
                                            <tbody>
                                            <tr style="color: #fff;">
                                                <td width="25%" height="25px" style="font-size: 11pt;">Total Items :</td>
                                                <td width="25%" height="25px" align="left">
                                                    <span id="total_item_qty">0</span>
                                                </td>
                                                <td width="25%" height="25px" align="" style="padding-left: 60px;">
                                                    Total :
                                                </td>
                                                <td width="25%" height="25px" align="right">
                                                    <div id="total_price">0</div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row" style="margin: 0px; font-weight: bold; color: #FFF; padding-top: 7px; padding-bottom: 7px; font-size: 11pt;">
                                    <div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">
                                        <table border="0" style="border-collapse: collapse;" width="100%" height="auto">
                                            <tbody>
                                            <tr style="color: #fff;">
                                                <td width="50%" height="25px" align="center"></td>
                                                <td width="30%" height="30px" style="padding-left: 60px;">Discount (%) :</td>
                                                <td width="25%" height="30px" align="right">
                                                    <input type="number" name="dis_amt" id="dis_amt" min="1" style="width: 115px; height: 30px; color: #000; font-size: 11pt; font-weight: normal; border: none; padding-left: 0px; font-family: Arial, Helvetica, sans-serif; padding-top: 5px; padding-bottom: 5px; border-radius: 10px;" placeholder="Enter Discount">
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row" style="margin: 0px; font-weight: bold; color: #FFF; padding-top: 7px; padding-bottom: 7px; font-size: 11pt;">
                                    <div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">
                                        <table border="0" style="border-collapse: collapse;" width="100%" height="auto">
                                            <tbody>
                                            <tr style="color: #fff;">
                                                <td width="50%" height="25px" align="center"></td>
                                                <td width="40%" height="30px" style="padding-left: 60px;">Grand Total :</td>
                                                <td width="25%" height="30px" align="right">
                                                    <span id="total_payable">0</span>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="" style="margin-top: 15px; ">
                                        <span class="btn btn-primary"  data-toggle="modal" data-target="#orderModal" style="background-color: #4396c1; color: #FFF; text-align: center; font-weight: bold; border-radius: 4px; padding-top: 10px; padding-bottom: 10px; align-items: center; width: 100%;" id="orderbtn">Place Order</span>
                                    </div>
                                    
                                </div>
                            </div>
                        
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo "$base_url";?>assets/js/system/order.js"></script>
<?php
    include("footer.php");
?>

<!-- payment Modal-->
<div id="orderModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title" align="center">Order Confirmation</h2>
            </div>
            <form id="ordersaveForm" class="form-horizontal" role="form" action="#" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group" style="display: none;">
                        <label class="col-sm-6" for="payrowcount" >Count</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="payrowcount" name="payrowcount" placeholder=""/>
                        </div>
                    </div>
                    <div class="form-group" style="display: none;">
                        <label class="col-sm-6" for="user_id" >User</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="user_id" name="user_id" placeholder=""
                            value="<?php echo($_SESSION['uid']); ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-6" for="week" >Week No</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="week" name="week" placeholder="Enter Current Week" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-6" for="table_id">Table No</label>
                        <div class="col-sm-6">
                            <select class="form-control required" id="table_id" name="table_id" required>
                                <option value="" style="color: black">--Select Table--</option>
                                <?php
                                    include_once("process/order.php");
                                    $ord = new order();
                                    $des = $ord->getTableName();
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-6" for="totamount" >Total Amount</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="totamount" name="totamount" placeholder="" readonly/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-6" for="payamount" >Payable Amount</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="payamount" name="payamount" placeholder="" readonly/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-6" for="tot_items" >Total Purchase Items</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control"
                                   id="tot_items" name="tot_items" placeholder="" readonly/>
                        </div>
                    </div>
                    <div class="form-group" style="display: none;">
                        <table class="table table-hover" id="paymentTbl">
                            <tr>
                                <th>Food_id</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>SubTot</th>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default paymentBtn" id="btnSaveOrder"">Confirm</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_close">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // carousel for category section
    $(document).ready(function(){
        $('.slider').slick({
            infinite: true,
            speed: 300,
            slidesToShow: 6,
            slidesToScroll: 5,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 5,
                        slidesToScroll: 5,
                        infinite: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    });
</script>
