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

if(isset($_POST['submit'])){
	$address=get_safe_value($con,$_POST['address']);
	$city=get_safe_value($con,$_POST['city']);
	$pincode=get_safe_value($con,$_POST['pincode']);
	$payment_type=get_safe_value($con,$_POST['payment_type']);
	$user_id=$_SESSION['USER_ID'];
	foreach($_SESSION['cart'] as $key=>$val){
		$productArr=get_product($con,'','',$key);
		$price=$productArr[0]['price'];
		$qty=$val['qty'];
		$cart_total=$cart_total+($price*$qty);
		
	}
	$total_price=$cart_total;
	$payment_status='pending';
	if($payment_type=='cod'){
		$payment_status='success';
	}
	$order_status='1';
	$added_on=date('Y-m-d h:i:s');
	
    $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);

    mysqli_query($con, "insert into orders(uid,address,city,pincode,total_price,payment_type,payment_status,order_status,added_on,txnid)
    values('$uid','$address','$city','$pincode','$total_price','$payment_type','$payment_status','$order_status','$added_on','$txnid')");

    $order_id = mysqli_insert_id($con);

    foreach ($_SESSION['cart'] as $key => $val) {
        $productArr = get_product($con, '', '', $key);
        $price = $productArr[0]['price'];
        $qty = $val['qty'];


        mysqli_query($con, "insert into order_details(order_id,product_id,qty,price)
        values('$order_id','$key','$qty','$price')");
    }
    unset($_SESSION['cart']);

    if ($payment_type == 'instamojo') {

        $userArr = mysqli_fetch_assoc(mysqli_query($con, "select * from users where uid='$uid'"));

        //$posted['txnid']=$txnid;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array("X-Api-Key:test_a5ee4680df615d01eb8396e1da4", "X-Auth-Token:test_939292b985fc3339fc5fb21521d")
        );

        $payload = array(
            'purpose' => 'Buy Product',
            'amount' => $total_price,
            'phone' => $userArr['mobile'],
            'buyer_name' => $userArr['name'],
            'redirect_url' => 'http://localhost/phpadmindashboard/kisan-website/payment_complete.php',
            'send_email' => false,
            'send_sms' => false,
            'email' => $userArr['email'],
            'allow_repeated_payments' => false
        );
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);
        $_SESSION['TID'] = $response->payment_request->id;
        mysqli_query($con, "update orders set txnid='" . $response->payment_request->id . "' where id='" . $order_id . "'");
    ?>
        <script>
            window.location.href = '<?php echo $response->payment_request->longurl ?>';
        </script>
    <?php
    } else {


    ?>
        <script>
            window.location.href = 'thank_you.php';
        </script>
<?php
    }
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
                        <div class="accordion">

                            <div class="accordion__title">
                                Checkout Method
                            </div>


                            <div class="accordion__title">
                                Address Information
                            </div>
                            <form method="post">
                                <div class="accordion__body">
                                    <div class="bilinfo">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="single-input">
                                                    <input type="text" name="address" placeholder="Street Address" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-input">
                                                    <input type="text" name="city" placeholder="City/State" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="single-input">
                                                    <input type="text" name="pincode" placeholder="Post code/ zip" required>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="accordion__title">
                                    payment information
                                </div>
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
                                <input type="submit" name="submit" />
                            </form>
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
                            $productArr = get_product($con, '', '', $key);
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

                        <div class="ordre-details__total">
                            <h5>Order total</h5>
                            <span class="price"><?php echo $cart_total ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require('footer.php') ?>