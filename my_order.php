<?php
require('top.php');
?>
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/4.jpg) no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
    <div class="container">
             <div class="row">
                 <div class="col-xs-12">
                     <div class="bradcaump__inner">
                     <!--<a class="breadcrumb-item" href="index.html">Home</a>-->
                        
                         <h2 style="color: white; ">Thank you</h2>
                     </div>
                 </div>
             </div>
         </div>
    </div>
    </div>
</div>

<div class="wishlist-area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="wishlist-content">
                            <form action="#">
                                <div class="wishlist-table table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="product-thumbnail">Order ID</th>
                                                <th class="product-name"><span class="nobr">Order Date</span></th>
                                                <th class="product-price"><span class="nobr">Address </span></th>
                                                <th class="product-stock-stauts"><span class="nobr"> Payment Status </span></th>
                                                <th class="product-stock-stauts"><span class="nobr"> Order Status  </span></th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $uid= $_SESSION['USER_ID'];
                                            //$uid=get_safe_value($con,$_GET['id']);
                                            // $sql="select * from orders where uid='$uid'";

                                            $sql = "SELECT orders.id, orders.uid, orders.address,orders.city,orders.pincode,orders.total_price,orders.payment_status,orders.order_status,orders.payment_id,orders.added_on, order_status.name
                                            FROM orders
                                            JOIN order_status ON orders.order_status = order_status.id;
                                            "; 
                                            $res=mysqli_query($con,$sql);
                                            
                                            //$sql="select orders.*,order_status.name as order_status_str from orders,order_status where orders.uid='$uid'and order_status.id=orders.order_status";
                                            //$res=mysqli_query($con,"select orders.*,order_status.name as order_status_str from orders,order_status where orders.uid='$uid' and order_status.id=orders.order_status order by orders.id desc");
                                            while($row=mysqli_fetch_assoc($res)){
                                            ?>
                                            <tr>
                                                <td class="product-add-to-cart"><a href="my_order_details.php?id=<?php echo $row['id']?>"><?php echo $row['id']?></a></td>
                                                <td class="product-name"><a href="#">
                                                    <?php echo $row['added_on']?></a></td>
                                                <td class="product-name">
                                                    <?php echo $row['address']?><br/>
                                                    <?php echo $row['city']?><br/>
                                                    <?php echo $row['pincode']?>
                                                
                                                </td>
                                                <td class="product-name"><?php echo $row['payment_status']?>
                                                </td>
                                                <td class="product-name"><?php echo $row['name']?>
                                                </td>
                                                
                                                
                                            </tr>
                                           <?php } ?>
                                        </tbody>
                                       
                                    </table>
                                </div>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
<?php
require('footer.php'); ?>