$(document).ready(function(){
    $("#orderbtn").prop('disabled', true);
});

var rowcount = 0;
var itcou =0;//create variable and set initial value as zero

// add food to the temporary table for payment
function additemstoOrder(foodid)
{
    var itCount = $('#itcount').val();//capture item count
    if(itCount==0){//if count equals to zero
        var url = "controller/food_controller.php?type=getFoodPrices"; //location of the loading page
        $.post(url, {foodid: foodid}, function (data, status) {
            if(data == "error"){
                //pop-up error message
                $.confirm({
                    title: 'Warning!',
                    content: 'Ooops..Something went wrong..!',
                    type: 'red',
                    typeAnimated: true,
                    animationBounce: 'RotateYR',
                    closeAnimation: 'scale',
                    buttons: {
                        tryAgain: {
                            text: 'Try again',
                            btnClass: 'btn-red',
                            action: function(){
                            }
                        },
                        close: function () {
                        }
                    }
                });
            }
            else{
                var jsonobj = JSON.parse(data); //capture data to json object
                $.each(jsonobj, function(key,value) {
                    var foodid = (value.foodid);
                    var name = (value.name);
                    var qty = (1);
                    var per_price = parseFloat((value.fprice), 10);
                    var tot = qty*per_price;

                    var markup = "<tr id='row"+itcou+"' style='background-color: #fff;'><td style='display: none;'><input name='foodid"+itcou+"' id='foodid"+itcou+"' value='"+ foodid +"' type='text' readonly /></td><td>"+ name +"</td><td><input name='qty"+itcou+"' id='"+itcou+"' value='"+ qty +"' type='text' class='cls_items_qtys'  onblur='itemsdet(this.id);' style='max-width: 60px; text-align: center;' min='1'/></td><td><input name='perprice"+itcou+"' id='perprice"+itcou+"' value='"+ per_price.toFixed(2) +"' type='text'   style='max-width: 60px;text-align: center;border: none;' readonly='readonly'/></td><td class='cls_total'><input name ='tot"+itcou+"' id ='tot"+itcou+"' value='"+ tot.toFixed(2) +"' type='text' class='cls_total' style='max-width: 70px;text-align: center; border: none;' readonly='readonly'/></td><td id='action'><span class='btn btn-sm btn-danger' id=" + itcou + " onclick='removePaymentItemRow(this.id);' title='Delete Information'><i class='fa fa-trash'></i></span></td></td></tr>";
                    $("#itemtbl tbody").append(markup);//append data into item table body

                    itcou++;
                    var itmCount = ($('#itemtbl tr').length-1);//capture table row count
                    $('#itcount').attr('value',itmCount);//assign new count
                    Calculate_totals_for_final();//call to function total calculation
                    $('#orderbtn').prop('disabled',false);
                });
            }
        });
    }
    else{//if count equals to more than 1
        var i=0;
        for(i; i<itcou; i++){
            var selectfood= $("#foodid"+i).val();//check already added item ids
            if(foodid === selectfood){//if new item already exists
                //pop-up error message
                $.confirm({
                    title: 'Error!',
                    content: 'This Food already added. Please Add Another!',
                    type: 'red',
                    typeAnimated: true,
                    animationBounce: 'RotateYR',
                    closeAnimation: 'scale',
                    buttons: {
                        tryAgain: {
                            text: 'Try again',
                            btnClass: 'btn-red',
                            action: function(){
                            }
                        },
                        close: function () {
                        }
                    }
                });
                return;
            }
        }
        var url = "controller/food_controller.php?type=getFoodPrices"; //location of the loading page
        $.post(url, {foodid: foodid}, function (data, status) {
            if(data == "error"){
                //pop-up error message
                $.confirm({
                    title: 'Warning!',
                    content: 'Ooops..Something went wrong..!',
                    type: 'red',
                    typeAnimated: true,
                    animationBounce: 'RotateYR',
                    closeAnimation: 'scale',
                    buttons: {
                        tryAgain: {
                            text: 'Try again',
                            btnClass: 'btn-red',
                            action: function(){
                            }
                        },
                        close: function () {
                        }
                    }
                });
            }
            else{
                var jsonobj = JSON.parse(data); //capture data to json object
                $.each(jsonobj, function(key,value) {
                    var foodid = (value.foodid);
                    var name = (value.name);
                    var qty = (1);
                    var per_price = parseFloat((value.fprice), 10);
                    var tot = qty*per_price;

                    var markup = "<tr id='row"+itcou+"' style='background-color: #fff;'><td style='display: none;'><input name='foodid"+itcou+"' id='foodid"+itcou+"' value='"+ foodid +"' type='text' readonly /></td><td>"+ name +"</td><td><input name='qty"+itcou+"' id='"+itcou+"' value='"+ qty +"' type='text' class='cls_items_qtys'  onblur='itemsdet(this.id);' style='max-width: 60px;text-align: center;' min='1'/></td><td><input name='perprice"+itcou+"' id='perprice"+itcou+"' value='"+ per_price.toFixed(2) +"' type='text'   style='max-width: 60px;text-align: center;border: none;' readonly='readonly'/></td><td class='cls_total'><input name ='tot"+itcou+"' id ='tot"+itcou+"' value='"+ tot.toFixed(2) +"' type='text' class='cls_total' style='max-width: 70px;text-align: center; border: none;' readonly='readonly'/></td><td id='action'><span class='btn btn-sm btn-danger' id=" + itcou + " onclick='removePaymentItemRow(this.id);' title='Delete Information'><i class='fa fa-trash'></i></span></td></td></tr>";
                    $("#itemtbl tbody").append(markup);//append data into item table body

                    itcou++;
                    var itmCount = ($('#itemtbl tr').length-1);//capture table row count
                    $('#itcount').attr('value',itmCount);//assign new count
                    Calculate_totals_for_final();//call to function total calculation
                    $('#orderbtn').prop('disabled',false);
                });
            }
        });
    }
}

// calculate the total prices for complete job
function Calculate_totals_for_final()
{
    //calculate total item qty
    var calculated_item_qty = 0;
    $("#itemtbl .cls_items_qtys").each(function () {
        var get_textbox_value = $(this).val();
        if ($.isNumeric(get_textbox_value)) {
            calculated_item_qty += parseFloat(get_textbox_value);
        }
    });
    $("#total_item_qty").html('<b>'+calculated_item_qty);//assign calculated total qty
    //calculate total amount
    var calculated_total = 0;
    var final_calculated_total = 0;
    $("#itemtbl .cls_total").each(function () {
        var get_textbox_value = $(this).val();
        if ($.isNumeric(get_textbox_value)) {
            calculated_total += parseFloat(get_textbox_value);
        }
        final_calculated_total = calculated_total;
    });
    $("#total_price").html('<b>'+calculated_total.toFixed(2));
    $("#total_price").html('<b>'+calculated_total.toFixed(2));//assign calculated total amount
    $("#total_payable").html('<b>'+final_calculated_total.toFixed(2));//assign calculated total amount
}

//change item qty function
function itemsdet(id) {
    //capture selected item details
    var new_item_qty = parseInt($('#' + id).val());
    var col_per_price = parseFloat($('#perprice' + id).val(), 10);
    var col_item_tot = (new_item_qty * col_per_price);
    $('#tot' + id).val(col_item_tot.toFixed(2));
    Calculate_totals_for_final();//call to function total calculation
}

//remove added items from the temporary table
function removePaymentItemRow(rownumber)
{
    //capture details into js variables
    var dec_qty =$('#'+rownumber).val();
    var dec_amount = $('#tot'+rownumber).val();
    var dec_tot_qty = $('#total_item_qty').text();
    dec_tot_qty = dec_tot_qty-dec_qty;//calculate new total item qty
    $('#total_item_qty').text(dec_tot_qty);
    var dec_tot_amount = $('#total_price').text();
    dec_tot_amount = dec_tot_amount-dec_amount;//calculate new total total amount
    $('#total_price').text(dec_tot_amount.toFixed(2));
    $('#total_payable').text(dec_tot_amount.toFixed(2));

    $("#row"+rownumber).remove();//remove table row
    var itmCount = $('#itemtbl tr').length;//capture table length
    itmCount--;//deduct by 1
    $('#itcount').attr('value',itmCount);
    if(itmCount == 0){
        $("#orderbtn").prop('disabled', true);
    }
}

var c =0;//create variable and set initial value as zero
//add payment details to payment model
$( "#orderbtn" ).click(function() {
    $('#ordersaveForm')[0].reset();//reset model before add data
    //capture all values in to js variables

    var alltotal = $('#total_price').text();
    var totalAmount = $('#total_payable').text();

    //add values to the model input fields
    $('#payamount').val(totalAmount);
    $('#totamount').val(alltotal);
    $('#payableamount').val(totalAmount);
    var totalItemqty = $('#total_item_qty').text();
    $('#tot_items').val(totalItemqty);
    var rcount = parseInt($('#itcount').val());//capture item count
    var count = (rcount);
    $('#payrowcount').attr('value',count);
    for (c; c < count; c++) {
        //capture table data into js variables
        var foodid = $("#foodid"+c).val();
        var itemqty = $("input[name=qty"+c+"]").val();
        var uprice = $('#perprice'+c).val();
        var total = $('#tot'+c).val();

        var markup = "<tr id='row"+c+"'><td><input name='foodid[]' id='foodid"+c+"' value='"+ foodid +"' type='text' readonly /></td><td><input name='qty[]' id='"+c+"' value='"+ itemqty +"' type='text' class='cls_items_qtys'  style='max-width: 60px;text-align: center;'/></td><td><input name='perprice[]' id='perprice"+c+"' value='"+ uprice +"' type='text'   style='max-width: 60px;text-align: center;border: none;' readonly='readonly'/></td><td><input name='tot[]' id='tot"+c+"' value='"+ total +"' type='text'   style='max-width: 60px;text-align: center;border: none;' readonly='readonly'/></td></tr>";
        $("#paymentTbl tbody").append(markup);//append data into payment table
    }
});

// rollback to default state if payment model is canceled
$( "#btn_item_pay_close" ).click(function() {
    jQuery("#item_qty").val("");
    jQuery("#item_total").val("");
});

//call to complete the payment function
$(document).ready(function(){
    $('#ordersaveForm').bootstrapValidator('validate');//validate variable-'val'
    $('#ordersaveForm').data('bootstrapValidator').resetForm();
    $("#btnSaveOrder").click(function(){
        $('#ordersaveForm').bootstrapValidator('validate');//validate variable-'val'
        if ($('#ordersaveForm').data('bootstrapValidator').isValid()) {//isValid() return true if valid
            $('#ordersaveForm').bootstrapValidator('validate');//validate again for the confirmation
            //loading gif image
            swal({
                title: 'Please wait...',
                imageUrl: "../../assets/img/resize.gif",
                showConfirmButton: false
            });
            $.ajax({
                type:"POST",
                url:"controller/order_controller.php?type=make_order",//location of the loading page
                data:new FormData($("#ordersaveForm")[0]),//serialize form data
                processData:false,
                contentType:false,
                complete: function(data){
                    if(data.responseText === "DoneDone"){//if success
                        swal.close();
                        //pop-up success message
                        $.confirm({
                            title: 'Done!',
                            content: 'Your order has been placed!',
                            type: 'green',
                            typeAnimated: true,
                            animationBounce: 'RotateYR',
                            closeAnimation: 'scale',
                            buttons: {
                                tryAgain: {
                                    text: 'Ok',
                                    btnClass: 'btn-green',
                                    action: function(){
                                        $('#ordersaveForm').each(function(){
                                            this.reset();
                                            $('#ordersaveForm').data('bootstrapValidator').resetForm();
                                            window.location.href ="waiterMain.php";
                                        });
                                    }
                                },
                                close: function () {
                                    $('#ordersaveForm').each(function(){
                                        this.reset();
                                        $('#ordersaveForm').data('bootstrapValidator').resetForm();
                                        window.location.href ="waiterMain.php";
                                    });
                                }
                            }
                        });
                    }
                    else {
                        swal.close();
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
                                    }
                                },
                                close: function () {
                                }
                            }
                        });
                    }
                }
            });
        }
    });
    $("#btn_r").click(function(){
        $('#ordersaveForm').data('bootstrapValidator').resetForm();//reset form
    });
});

//give discount for grand total
$("#dis_amt").keyup(function(){
    var totalAmount = parseFloat($('#total_price').text(), 10);
    var discount = parseFloat($('#dis_amt').val(), 10);

    if(discount >= 0){//if discount greater than or equal to zero
        var distot = (totalAmount * discount)/100;
        var grandtot = parseFloat(totalAmount) - parseFloat(distot);
        $("#total_payable").html('<b>'+grandtot.toFixed(2));//set new total payable value
    }
    else if(discount <= 0){//if discount less than or equal to zero
        //pop-up error message
        $.confirm({
            title: 'Warning!',
            content: 'Invalid discount percentage!',
            type: 'red',
            typeAnimated: true,
            animationBounce: 'RotateYR',
            closeAnimation: 'scale',
            buttons: {
                tryAgain: {
                    text: 'Try again',
                    btnClass: 'btn-red',
                    action: function(){
                        $('#dis_amt').val('');
                    }
                },
                close: function () {
                    $('#dis_amt').val('');
                }
            }
        });
    }
    else{
        $("#total_payable").html('<b>'+totalAmount.toFixed(2));
    }
});