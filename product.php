<?php require('top.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
$product_id = mysqli_real_escape_string($con, $_GET['id']);
//$product_name=mysqli_real_escape_string($con,$_GET['id']);
$get_product = get_product($con, '', '', $product_id);
//$categories=mysqli_real_escape_string($con,$_GET['id']);

if (isset($_POST['review_submit'])) {
	$rating = get_safe_value($con, $_POST['rating']);
	$review = get_safe_value($con, $_POST['review']);

	$added_on = date('Y-m-d h:i:s');
	mysqli_query($con, "insert into product_review(product_id,user_id,rating,review,status,added_on) values('$product_id','" . $_SESSION['USER_ID'] . "','$rating','$review','1','$added_on')");
	//header('location:product.php?id=' . $product_id);
    //header('location:product.php');
}


$product_review_res = mysqli_query($con, "select users.name,product_review.id,product_review.rating,product_review.review,product_review.added_on from users,product_review where product_review.status=1 and product_review.user_id=users.uid and product_review.product_id='$product_id' order by product_review.added_on desc");


?>



<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/4.jpg) no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                            <div class="bradcaump__inner">
                                <h2 style="color: white; ">Products</h2>
                            </div>
                            
                            
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- Start Product Details Area -->
<section class="htc__product__details bg__white ptb--100">
    <!-- Start Product Details Top -->
    <div class="htc__product__details__top">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-lg-4 col-sm-12 col-xs-12">
                    <div class="htc__product__details__tab__content">
                        <!-- Start Product Big Images -->
                        <div class="product__big__images">
                            <div class="portfolio-full-image tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="img-tab-1">
                                    <img src="<?php echo PRODUCT_IMAGE_SITE_PATH . $get_product['0']['image']
                                                ?>" alt="full-image">
                                </div>
                            </div>
                        </div>
                        <!-- End Product Big Images -->

                    </div>
                </div>
                <div class="col-md-7 col-lg-7 col-sm-12 col-xs-12 smt-40 xmt-40">
                    <div class="ht__product__dtl">
                        <h2>
                            <?php echo $get_product['0']['product_name'] ?>
                        </h2>



                        <p class="pro__info"  ><s>MRP : Rs
                            <?php echo $get_product['0']['mrp'] ?>
                            </s><br>
                            <span style="color:green;"> Off 20%</span>
                        </p>
                        <p class="pro__info">PRICE : Rs
                            <?php echo $get_product['0']['price'] ?>
                        </p>
                        <p class="pro__info">SHORT_DESC :
                            <?php echo $get_product['0']['short_description'] ?>
                        </p>
                        <div class="ht__pro__desc">
                            <div class="sin__desc">
                                <?php
                                    $productSoldQtyByProductId=productSoldQtyByProductId($con,$get_product['0']['id']);
                                    $cart_show='yes';
                                    if($get_product['0']['qty']>$productSoldQtyByProductId){
                                        $stock='In Stock';                                      
                                    }else{
                                        $stock='Not In Stock';
                                        $cart_show='';
                                    }
                                ?>
                                <p><span>Availability:</span><?php echo $stock ?></p>
                            </div>
                            <div class="sin__desc">
                            <?php if($cart_show!=''){?>
                                <p><span>Qty:</span>
                                    <select id="qty">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>
                                        <option>10</option>
                                    </select>
                                </p>
                                <?php }?>
                            </div>
                            <div class="sin__desc align--left">
                                <p><span>Categories:</span></p>
                                <ul class="pro__cat__list">
                                    <li><a href="#">
                                            <?php echo $get_product['0']['categories'] ?>
                                        </a></li>
                                </ul>
                            </div>
                            <div>
                                <?php if($cart_show!=''){?>
                                <button> <a class="btn btn-primary btn-lg mb-5" href="javascript:void(0)" onclick="manage_cart('<?php echo
                                                                                                                                $get_product['0']['id'] ?>','add')">Add to Cart</a></button>

                                <button> <a class="btn btn-warning btn-lg mb-5" href="javascript:void(0)" onclick="manage_cart('<?php echo
                                                                                                                                $get_product['0']['id'] ?>','add','yes')">Buy Now</a></button>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Product Details Top -->
</section>
<!-- End Product Details Area -->
<!-- Start Product Description -->
<section class="htc__produc__decription bg__white">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <!-- Start List And Grid View -->
                <ul class="pro__details__tab" role="tablist">
                    <li role="presentation" class="description active"><a href="#description" role="tab" data-toggle="tab">description</a></li>
                </ul>
                <!-- End List And Grid View -->
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="ht__pro__details__content">
                    <!-- Start Single Content -->
                    <div role="tabpanel" id="description" class="pro__single__content tab-pane fade in active">
                        <div class="pro__tab__content__inner">
                            <p>
                                <?php echo $get_product['0']['description'] ?>
                            </p>
                        </div>
                    </div>
                    <!-- End Single Content -->

                    <div role="tabpanel" id="review" class=" tab-pane ">
                        <div class="" >
                            <h2 style="padding: 20px;">Review</h2>
                            <?php
                            if (mysqli_num_rows($product_review_res) > 0) {

                                while ($product_review_row = mysqli_fetch_assoc($product_review_res)) {
                            ?>

                                    <article class="row">
                                        <div class="col-md-6 col-sm-6">

                                            <div class="panel panel-default arrow left">
                                                <div class="panel-body">
                                                    <header class="text-left">
                                                        <div><span class="comment-rating"> <?php echo $product_review_row['rating'] ?></span> (<?php echo $product_review_row['name'] ?>)</div>
                                                        <time class="comment-date">
                                                            <?php
                                                            $added_on = strtotime($product_review_row['added_on']);
                                                            echo date('d M Y', $added_on);
                                                            ?>



                                                        </time>
                                                    </header>
                                                    <div class="comment-post">
                                                        <p>
                                                            <?php echo $product_review_row['review'] ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                            <?php }
                            } else {
                                echo "<h3 class='submit_review_hint'>No review added</h3><br/>";
                            }
                            ?>


                            <h3 class="review_heading">Enter your review</h3><br />
                            <?php
                            if (isset($_SESSION['USER_LOGIN'])) {
                            ?>
                                <div class="row" id="post-review-box" style=>
                                    <div class="col-md-12">
                                        <form action="" method="post">
                                            <select class="form-control" name="rating" required>
                                                <option value="">Select Rating</option>
                                                <option>Worst</option>
                                                <option>Bad</option>
                                                <option>Good</option>
                                                <option>Very Good</option>
                                                <option>Fantastic</option>
                                            </select> <br />
                                            <textarea class="form-control" cols="50" id="new-review" name="review" placeholder="Enter your review here..." rows="5"></textarea>
                                            <div class="text-right mt10">
                                                <button class="btn btn-success btn-lg" type="submit" name="review_submit">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            <?php } else {
                                echo "<span class='submit_review_hint'>Please <a href='login_user.php'>login</a> to submit your review</span>";
                            }
                            ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Product Description -->
<?php require('footer.php') ?>