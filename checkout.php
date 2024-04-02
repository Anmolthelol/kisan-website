<?php

require('top.php');
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
?>
    <script>
        window.location.href = 'index.php';
    </script>
<?php
}


$cart_total = 0;

if (isset($_POST['confirmed'])) {
    $address = get_safe_value($con, $_POST['address']);
    $city = get_safe_value($con, $_POST['city']);
    $pincode = get_safe_value($con, $_POST['pincode']);
    $payment_type = "";
    // = get_safe_value($con, $_POST['payment_type']);
    $uid = $_SESSION['USER_ID'];
    foreach ($_SESSION['cart'] as $key => $val) {
        $productArr = get_product($con, '', '', $key);
        $price = $productArr[0]['price'];
        $qty = $val['qty'];
        $cart_total = $cart_total + ($price * $qty);
    }
    $total_price = $cart_total;
    $payment_status = 'pending';
    if ($payment_type == 'cod') {
        $payment_status = 'success';
    }
    $order_status = '1';
    $added_on = date('Y-m-d h:i:s');

    $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
    if(isset($_SESSION['COUPON_ID'])){
        $coupon_id=($_SESSION['COUPON_ID']);
        $coupon_code=($_SESSION['COUPON_CODE']);
        $coupon_value=($_SESSION['COUPON_VALUE']);
        $total_price=$total_price-$coupon_value;
        unset($_SESSION['COUPON_ID']);
        unset($_SESSION['COUPON_CODE']);
        unset($_SESSION['COUPON_VALUE']);
    }else{
        $coupon_id='';
        $coupon_code='';
        $coupon_value='';

    }

    mysqli_query($con, "insert into orders(uid,address,city,pincode,total_price,payment_type,payment_status,order_status,added_on,txnid,coupon_id,coupon_code,coupon_value)
    values('$uid','$address','$city','$pincode','$total_price','$payment_type','$payment_status','$order_status','$added_on','$txnid','$coupon_id','$coupon_code','$coupon_value')");

    $order_id = mysqli_insert_id($con);

    foreach ($_SESSION['cart'] as $key => $val) {
        $productArr = get_product($con, '', '', $key);
        $price = $productArr[0]['price'];
        $qty = $val['qty'];


        mysqli_query($con, "insert into order_details(order_id,product_id,qty,price)
        values('$order_id','$key','$qty','$price')");
    }
    unset($_SESSION['cart']);
    //here rough file text to paste   ---------------------------------------------------
    header('location:thank_you.php');
    die();
}

?>
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/4.jpg) no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="index.html">Home</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <span class="breadcrumb-item active">checkout</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- cart-main-area start -->
<div class="checkout-wrap ptb--100">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="checkout__inner">
                    <div class="accordion-list">
                        <div class="accordion bg-light">

                            <!-- <div class="accordion__title">
                                Checkout Method
                            </div> -->


                            <div class="">
                                <h2>
                                    Address Information
                                </h2>
                            </div>
                            <form method="POST" action="order_process.php" id="paymentForm">
                                <div class="accordion__body">
                                    <div class="bilinfo">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="single-input">
                                                    <input type="text" name="address" id="address" placeholder="Street Address">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-input">
                                                    <input type="text" name="city" id="city" placeholder="City/State">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-input">
                                                    <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==6) return false;" name="pincode" id="pincode" placeholder="Post code/ zip">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6" style="margin-bottom: 20px;">
                                    <input class="btn btn-primary btn-lg mb-5" type="button" id="submitBtn" name="Buynow" value="Proceed payment" />
                                </div>
<<<<<<< HEAD


=======
<<<<<<< HEAD
                                <div class="accordion__body">
                                    <div class="paymentinfo">
                                        <div class="single-method">
                                            COD <input type="radio" name="payment_type" value="COD" required />
                                            &nbsp;&nbsp;Instamojo <input type="radio" name="payment_type" value="instamojo" required />
                                        </div>
                                        <div class="single-method">

                                        </div>
                                    </div>
                                </div>
                                <input type="submit" name="submit" class="fv-btn"/>
=======
                               
                              
>>>>>>> d74564f7499a4e82da78fc05858b2d51f44de3bb
>>>>>>> 58e3dc74e579b8f29cdbae3c9eef95d4b606b04d
                            </form>

                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                            <script>
                                $(document).ready(function() {
                                    $('#submitBtn').click(function(e) {
                                        e.preventDefault(); // Prevent the default form submission behavior
                                        console.log("Form submission prevented");

                                        // Retrieve user name and total amount
                                        var name = "<?php echo $_SESSION['USER_NAME'] ?>";
                                        var amt = $("#totalPrice").text();
                                        var userId = "<?php echo $_SESSION['USER_ID'] ?>";


                                        let address = $('#address').val();
                                        let city = $('#city').val();
                                        let pincode = $('#pincode').val();

                                        let validate = false;
                                        if (address != '' && city != '' && pincode != '') {
                                            validate = true;
                                        }

                                        if (validate) {
                                            // Make AJAX request to Razorpay payment_process.php
                                            jQuery.ajax({
                                                type: 'post',
                                                url: 'razorpay/payment_process.php',
                                                data: {
                                                    amt: amt,
                                                    name: name
                                                },
                                                success: function(result) {
                                                    var options = {
                                                        "key": "rzp_test_ZzcGlK3pyzA67u",
                                                        "amount": amt * 100,
                                                        "currency": "INR",
                                                        "name": "Kissan Suvidha",
                                                        "description": "Test Transaction",
                                                        "image": "https://image.freepik.com/free-vector/logo-sample-text_355-558.jpg",
                                                        "handler": function(response) {
                                                            // Trigger form submission after successful payment
                                                            jQuery.ajax({
                                                                type: 'post',
                                                                url: 'razorpay/payment_process.php',
                                                                data: {
                                                                    payment_id: response.razorpay_payment_id
                                                                },
                                                                success: function(result) {
                                                                    // Now, submit the form to order_process.php
                                                                        var url = "order_process.php?address=" + encodeURIComponent(address) +
                                                                        "&city=" + encodeURIComponent(city) +
                                                                        "&pincode=" + encodeURIComponent(pincode) +
                                                                        "&payment_id=" + encodeURIComponent(response.razorpay_payment_id);

                                                                    window.location.href = url;

                                                                    console.log("Razorpay payment successful");
                                                                    // $('#paymentForm').submit();

                                                                }
                                                            });
                                                        }
                                                    };
                                                    var rzp1 = new Razorpay(options);
                                                    rzp1.open();

                                                }
                                            });
                                        } else {
                                            alert('Please fill the address');
                                        }
                                    });
                                });
                            </script>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="order-details">
                    <h5 class="order-details__title">Your Order</h5>
                    <div class="order-details__item">
                        <?php
                        $cart_total = 0;
                        foreach ($_SESSION['cart'] as $key => $val) {
                            $productArr=get_product($con, '', '', $key);
                            $pname = $productArr[0]['product_name'];
                            $mrp = $productArr[0]['mrp'];
                            $price = $productArr[0]['price'];
                            $image = $productArr[0]['image'];
                            $qty = $val['qty'];
                            $cart_total = $cart_total + ($price * $qty);
                        ?>
                            <div class="single-item">
                                <div class="single-item__thumb">
                                    <img src="<?php echo PRODUCT_IMAGE_SITE_PATH . $image
                                                ?>" />
                                </div>
                                <div class="single-item__content">
                                    <a href="#"><?php echo  $pname ?></a>
                                    <span class="price"><?php echo  $price * $qty ?></span>
                                </div>
                                <div class="single-item__remove">
                                    <a href="javascript:void(0)" onclick="manage_cart('<?php echo $key ?>','remove')"><i class="icon-trash icons"></i></a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="ordre-details__total" id="coupon_box">
                            <h5>Coupon Value</h5>
                            <span class="price" id="coupon_price"></span>
                        </div>
                        <div class="ordre-details__total">
                            <h5>Order total</h5>
<<<<<<< HEAD
                            <span class="price" id="order_total_price"><?php echo $cart_total ?></span>
=======
                            <span id="totalPrice" class="price"><?php echo $cart_total ?></span>
>>>>>>> d74564f7499a4e82da78fc05858b2d51f44de3bb
                        </div>
                        <div class="ordre-details__total bilinfo">
                            <input type="textbox" id="coupon_str" class="coupon_style mr5"/>
                            <input type="button" name="submit" class="fv-btn coupon_style" value="Apply Coupon" onclick="set_coupon()"/>
                        </div>
                        <div id="coupon_result"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function set_coupon(){
            var coupon_str=jQuery('#coupon_str').val();
            if(coupon_str!=''){
                jQuery('#coupon_result').html('');
                jQuery.ajax({
                    url:'set_coupon.php',
                    type:'post',
                    data:'coupon_str='+coupon_str,
                    success:function(result){
                        var data=jQuery.parseJSON(result);
                        console.log(data.is_error);
                        if(data.is_error=='yes'){
                            jQuery('#coupon_box').hide();
                            jQuery.('#coupon_result').html(data.dd);
                            jQuery.('#order_total_price').html(data.result);
                        }
                        if(data.is_error=='no'){
                            jQuery('#coupon_box').show();
                            jQuery.('#coupon_price').html(data.dd);
                            jQuery.('#order_total_price').html(data.result);
                        }
                    }
                });
            }
        }
    </script>
    <?php 
    if(isset($_SESSION['COUPON_ID'])){
        unset($_SESSION['COUPON_ID']);
        unset($_SESSION['COUPON_CODE']);
        unset($_SESSION['COUPON_VALUE']);
    }
    require('footer.php') ?>