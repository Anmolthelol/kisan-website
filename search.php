 <?php require('top.php');
	 $cat_id = mysqli_real_escape_string($con, $_GET['str']);
	 $product_id = mysqli_real_escape_string($con, $_GET['str']);
	 $get_product = array();
	 $str = mysqli_real_escape_string($con, $_GET['str']);
	
	if ($str!='') {
		$get_product = get_product($con, '', '', '', $str);
	} else {
	?>
 	<script>
 		window.location.href = 'index.php';
 	</script>
 <?php
	}
	?>
 <div class="body__overlay"></div>

 <!-- Start Bradcaump area -->
 <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/4.jpg) no-repeat scroll center center / cover ;">
 	<div class="ht__bradcaump__wrap">
 		<header>
 			<img src="images/bg/kisanbg.jpg">
 		</header>
 		<div class="container">
 			<div class="row">
 				<div class="col-xs-12">
 					<div class="bradcaump__inner">
 						<h2 style="color: white; ">Search</h2>
 					</div>
 					<div class="bradcaump__inner">
 						<h2 style="color: white; "><?php $str ?></h2>
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>
 </div>
 <!-- End Bradcaump area -->
 <!-- Start Product Grid -->
 <section class="htc__product__grid bg__white ptb--100">
 	<div class="container">
 		<div class="row">
 			<?php if (count($get_product) > 0) { ?>
 				<div class="col-lg-12  col-md-12 col-sm-12 col-xs-12">
 					<div class="htc__product__rightidebar">
 						<!-- Start Product View -->
 						<div class="row">
 							<div class="shop__grid__view__wrap">
 								<div role="tabpanel" id="grid-view" class="single-grid-view tab-pane fade in active clearfix">
 									<?php

										foreach ($get_product as $list) {
										?>
 										<!-- Start Single Category -->
 										<div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
 											<div class="category">
 												<div class="ht__cat__thumb">
 													<a href="product.php?id=<?php echo $list['id'] ?>">
 														<img src=<?php echo PRODUCT_IMAGE_SITE_PATH . $list['image'] ?> alt="product images">
 													</a>
 												</div>

 												<div class="fr__product__inner">
 													<h4><a href="product-details.html"><?php echo $list['product_name'] ?></a></h4>
 													<ul class="fr__pro__prize">
 														<li class="old__prize"><?php echo $list['mrp'] ?></li>
 														<li><?php echo $list['price'] ?></li>
 													</ul>
 												</div>
 											</div>
 										</div>
 										<!--END Single Category -->
 									<?php } ?>
 									<!-- End Single Product -->

 								</div>

 							</div>
 						</div>
 						<!-- End Product View -->
 					</div>

 				</div>
 			<?php } else {
					echo "Data not found";
				} ?>
 		</div>
 	</div>
 </section>
 <!-- End Product Grid -->


 <!-- End Banner Area -->
 <?php require('footer.php') ?>