<?php
require('top.php');



?>
<style>
     .product-table {
            width: 100%;
            border-collapse: collapse;
        }

        .product-table th,
        .product-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        .product-table th {
            background-color: #f2f2f2;
        }
</style>


<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/4.jpg) no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="index.html">Home</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <span class="breadcrumb-item active">Thank YOu</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="htc__category__area ptb--100">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="section__title--2 text-center">
                    <h2 class="title__line" style="padding-top: 50px;">ORDER COMPLETED</h2>
                    <p>thank you for shopping from kisan suvidha</p>
                    <table class="product-table">
                        <thead>
                            <tr>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>MRP</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                            foreach ($_SESSION['showCart'] as $key => $val) {
                                $productArr = get_product($con, '', '', $key);
                                $productArr = get_product($con, '', '', $key);
                                $pname = $productArr[0]['product_name'];
                                $mrp = $productArr[0]['mrp'];
                                $price = $productArr[0]['price'];
                                $image = $productArr[0]['image'];
                                $qty = $val['qty'];
                            ?>
                                <tr>
                                    <td class="product-thumbnail">
                                        <img src="<?php echo PRODUCT_IMAGE_SITE_PATH . $image ?>" width="130" height="130" />
                                    </td>
                                    <td><?php echo $pname ?></td>
                                    <td><?php echo $mrp ?></td>
                                    <td><?php echo  $price ?></td>
                                    <td><?php echo $qty ?></td>
                                    <td><?php echo  $qty * $price ?></td>
                                </tr>

                            <?php } ?>
                        
                            </tbody>
</table>

                </div>
            </div>
        </div>
    </div>
</section>
<?php

unset($_SESSION['cart']);
require('footer.php'); ?>