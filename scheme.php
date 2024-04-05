 <?php require('top.php');
    $get_scheme = get_scheme($con, '');
    // $scheme_id = mysqli_real_escape_string($con, $_GET['scheme_id']);
    // $get_scheme = get_scheme($con, $scheme_id);

    ?>
 <div class="body__overlay"></div>

 <!-- Start Bradcaump area -->
 <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/4.jpg) no-repeat scroll center center / cover ;">
     <div class="ht__bradcaump__wrap">
         <div class="container">
             <div class="row">
                 <div class="col-xs-12">
                     <div class="bradcaump__inner">
                         <h2 style="color: white; ">Schemes</h2>
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
             <?php if (count($get_scheme) > 0) { ?>
                 <div class="col-lg-12  col-md-12 col-sm-12 col-xs-12">
                     <div class="htc__product__rightidebar">
                        
                         <!-- Start Product View -->
                         <div class="row">
                             <div class="shop__grid__view__wrap">
                                 <div role="tabpanel" id="grid-view" class="single-grid-view tab-pane fade in active clearfix">
                                     <?php

                                        foreach ($get_scheme as $list) {
                                        ?>
                                         <!-- Start Single Category -->
                                         <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                             <div class="category">
                                                 <div class="ht__cat__thumb">
                                                     <a href="scheme1.php?id=<?php echo $list['scheme_id'] ?>">
                                                         <img src=<?php echo PRODUCT_IMAGE_SITE_PATH . $list['image'] ?> alt="product images">
                                                     </a>
                                                 </div>

                                                 <div class="fr__product__inner">
                                                     <h4><a href="product-details.html"><?php echo $list['scheme_title'] ?></a></h4>
                                                     <ul class="fr__pro__prize">
                                                         <li class="old__prize"><?php echo $list['applying_fee'] ?></li>
                                                         <li><?php echo $list['last_date'] ?></li>
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