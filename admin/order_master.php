<?php
require('top.inc.php');
$sql = "select * from users order by uid asc";
$res = mysqli_query($con, $sql);
?>
<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Order Master</h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">Order ID</th>
                                        <th class="product-name"><span class="nobr">Order Date</span></th>
                                        <th class="product-price"><span class="nobr">Address </span></th>
                                        <th class="product-stock-stauts"><span class="nobr"> Payment Status </span></th>
                                        <th class="product-stock-stauts"><span class="nobr"> Order Status </span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                   
                                        $uid = $_SESSION['USER_ID'];
                                    
                                        //$uid=get_safe_value($con,$_GET['id']);
                                        // $sql="select * from orders where uid='$uid'";

                                        $sql = "SELECT orders.id, orders.uid, orders.address,orders.city,orders.pincode,orders.total_price,orders.payment_status,orders.order_status,orders.payment_id,orders.added_on, order_status.name
                                           FROM orders
                                           JOIN order_status ON orders.order_status = order_status.id;
                                           ";
                                        $res = mysqli_query($con, $sql);

                                        //$sql="select orders.*,order_status.name as order_status_str from orders,order_status where orders.uid='$uid'and order_status.id=orders.order_status";
                                        //$res=mysqli_query($con,"select orders.*,order_status.name as order_status_str from orders,order_status where orders.uid='$uid' and order_status.id=orders.order_status order by orders.id desc");
                                        while ($row = mysqli_fetch_assoc($res)) {
                                    ?>
                                            <tr>
                                                <td class="product-add-to-cart"><a href="order_master_details.php?id=<?php echo $row['id'] ?>"><?php echo $row['id'] ?></a></td>
                                                <td class="product-name"><a href="#">
                                                        <?php echo $row['added_on'] ?></a></td>
                                                <td class="product-name">
                                                    <?php echo $row['address'] ?><br />
                                                    <?php echo $row['city'] ?><br />
                                                    <?php echo $row['pincode'] ?>

                                                </td>
                                                <td class="product-name"><?php echo $row['payment_status'] ?>
                                                </td>
                                                <td class="product-name"><?php echo $row['name'] ?>
                                                </td>

                                            <?php } ?>
                                        
                                </tbody>

                            </table>
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