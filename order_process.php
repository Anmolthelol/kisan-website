<?php

// require('top.php');
require('database.php');
require('functions.inc.php');
require('add_to_cart.php');

if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
?>
    <script>
        window.location.href = 'index.php';
    </script>
    <?php
}


$cart_total = 0;

  //if (isset($_POST['confirmed'])) {
    $address = get_safe_value($con, $_GET['address']);
    $city = get_safe_value($con, $_GET['city']);
    $pincode = get_safe_value($con, $_GET['pincode']);
    
    // = get_safe_value($con, $_POST['payment_type']);
    $uid = $_SESSION['USER_ID'];
    foreach ($_SESSION['cart'] as $key => $val) {
        $productArr = get_product($con, '', '', $key);
        $price = $productArr[0]['price'];
        $qty = $val['qty'];
        $cart_total = $cart_total + ($price * $qty);
    }
    $total_price = $cart_total;
    $payment_status = 'success';
    // if () {
    //     $payment_status = 'success';
    // }
    $order_status = '1';
    $added_on = date('Y-m-d h:i:s');

    $payment_id = $_GET['payment_id'] ;

    mysqli_query($con, "insert into orders(uid,address,city,pincode,total_price,payment_status,order_status,added_on,payment_id)
    values('$uid','$address','$city','$pincode','$total_price','$payment_status','$order_status','$added_on','$payment_id')");

    $order_id = mysqli_insert_id($con);

    foreach ($_SESSION['cart'] as $key => $val) {
        $productArr = get_product($con, '', '', $key);
        $price = $productArr[0]['price'];
        $qty = $val['qty'];


        mysqli_query($con, "insert into order_details(order_id,product_id,qty,price)
        values('$order_id','$key','$qty','$price')");
    }
    
    $_SESSION['showCart'] = $_SESSION['cart'] ;
    unset($_SESSION['cart']);
    header('location:thank_you.php');
    die();










?>