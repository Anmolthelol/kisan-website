<?php
require('top.inc.php');
$order_id = get_safe_value($con, $_GET['id']);
//$coupon_details=mysqli_fetch_assoc(mysqli_query($con,"select coupon_value,coupon_code from orders where id='$order_id"));
//$coupon_value=$coupon_details['coupon_value'];
//$coupon_code=$coupon_details['coupon_code'];
?>
<?php
if (isset($_POST['update_order_status'])) {
    $update_order_status = $_POST['update_order_status'];
    mysqli_query($con, "update orders set order_status='$update_order_status' where id='$order_id'");
}

?>
<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Order Details</h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">Product Name</th>
                                        <th class="product-thumbnail">Product Image</th>
                                        <th class="product-name">Qty</th>
                                        <th class="product-name">Price</th>
                                        <th class="product-name">Total Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    // $res = mysqli_query($con, "select distinct(order_details.id),order_details.*,product.product_name,
                                    // product.image,orders.address,orders.city,orders.pincode from order_details,
                                    // product,orders where order_details.order_id='$order_id' and order_details.product_id=product.id ");
                                    $res = mysqli_query($con, "select * from orders where id = $order_id");
                                    echo "<pre>";
                                    $order = mysqli_fetch_assoc($res);
                                    $res2 = mysqli_query($con, "SELECT od.*, p.* 
                                                FROM order_details AS od 
                                                INNER JOIN product AS p ON p.id = od.product_id 
                                                WHERE od.order_id = $order_id");


                                    $order_details = mysqli_fetch_assoc($res2);
                                    // print_r($order_details);
                                    // die('kkhy');
                                    $total_price = 0;
                                    $address = $order['address'];
                                    $city = $order['city'];
                                    $pincode = $order['pincode'];
                                   
                                    // while ($row = mysqli_fetch_assoc($res2)) {
                                        // echo "<br> id : " . $order_details['id'];
                                        $total_price = $total_price + ($order_details['qty'] * $order_details['price']);
                                    ?>
                                        <tr>
                                            <td class="product-name"><?php echo $order_details['product_name'] ?></td>
                                            <td class="product-name"> <img src="<?php echo PRODUCT_IMAGE_SITE_PATH . $order_details['image'] ?>"></td>
                                            <td class="product-name"><?php echo $order_details['qty'] ?></td>
                                            <td class="product-name"><?php echo $order_details['price'] ?></td>
                                            <td class="product-name"><?php echo $order_details['qty'] * $order_details['price'] ?></td>

                                        </tr>

                                    <?php 
                                // } 
                                ?>

                                    <?php
                                    if($coupon_value!=''){
                                    ?>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td class="product-name">Coupon Value
                                        </td>
                                        <td class="product-name"><?php echo $coupon_value."($coupon_code)" ?>
                                        </td>
                                    </tr>
                                    <?php }?>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td class="product-name">TOTAL PRICE
                                        </td>
                                        <td class="product-name"><?php echo $total_price-$coupon_value ?>
                                        </td>
                                    </tr>
                                    ?>
                                </tbody>
                            </table>
                            <div id="address_details">
                                <h5 class="px-3"><strong>Address</strong></h5>
                                <p class="px-3">
                                <?php echo $address ?>, <?php echo $city ?>, <?php echo $pincode ?></br></br>
                                </p>
                                <h5 class="px-3">
                                    <strong>Order Status</strong>
                                </h5>
                                <?php
                                $order_status_arr = mysqli_fetch_assoc(mysqli_query($con, "select order_status.name from order_status,orders where
                                 orders.id='$order_id' and orders.order_status=order_status.id"));

                                ?>
                                <div class="container py-3">
                                    <form method="post">
                                        <select class="form-control col-4" name="update_order_status">
                                            <option>Select Status</option>
                                            <?php
                                            $res = mysqli_query($con, "select * from order_status");
                                            while ($row = mysqli_fetch_assoc($res)) {
                                                if ($row['id'] == $category_id) {
                                                    echo "<option selected value=" . $row['id'] . ">" . $row['name'] . "</option>";
                                                } else {
                                                    echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>

                                        <input type="submit" class="form-control btn btn-warning col-4 mt-3" onclick="myFunction()" />
                                        <script>
                                            function myFunction() {
                                                window.location.href = "order_master.php";
                                            }
                                        </script>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require('footer.inc.php');
?>