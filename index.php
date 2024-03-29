 <?php require('top.php') ?>
 <div class="body__overlay"></div>

 <!-- Start Slider Area -->

 <!-- Start Slider Area -->
 <!-- Start Category Area -->
 <div class="col-lg-12">
     <video autoplay muted loop width="100%">
         <source src="images/mp4/slide1.mp4" type="video/mp4">
         Your browser does not support the video tag.
     </video>
 </div>
 <section class="htc__category__area ptb--100">
     <div class="container">
         <div class="row">
             <div class="col-xs-12">
                 <div class="section__title--2 text-center">
                     <h2 class="title__line" style="padding-top: 50px;">New Arrivals</h2>
                     <p>But I must explain to you how all this mistaken idea</p>
                 </div>
             </div>
         </div>
         <div class="htc__product__container">
             <div class="row">
                 <div class="product__list clearfix mt--30">
                     <?php
                        $get_product = get_product($con, 2);
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

                     <?php } ?>
                 </div>
             </div>
         </div>
     </div>
 </section>
 <!-- End Category Area -->
 <!-- Start Product Area -->
 <section class="ftr__product__area ptb--100">
     <div class="container">
         <div class="row">
             <div class="col-xs-12">
                 <div class="section__title--2 text-center">
                     <h2 class="title__line">Best Seller</h2>
                     <p>But I must explain to you how all this mistaken idea can be solve</p>
                 </div>
             </div>
         </div>
         <div class="row">
             <div class="product__list clearfix mt--30">
                 <?php
                    $get_product = get_product($con, 2,'','','','','yes');
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

                 <?php } ?>
             </div>
         </div>
     </div>
 </section>
 <!-- End Product Area -->
 <?php require('footer.php') ?>