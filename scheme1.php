 <?php require('top.php');

    $get_scheme = get_scheme($con, '');
    ?>
 <div class="body__overlay"></div>

 <!-- Start Bradcaump area -->
 <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/4.jpg) no-repeat scroll center center / cover ;">
     <div class="ht__bradcaump__wrap">
         <div class="container">
             <div class="row">
                 <div class="col-xs-12">
                     <div class="bradcaump__inner">
                         <h2 style="color: white; ">Scheme</h2>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- End Bradcaump area -->
 <!-- Start Product Grid -->
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
                                    <img src="<?php echo PRODUCT_IMAGE_SITE_PATH . $get_scheme['0']['image']
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
                            <?php echo $get_scheme['0']['scheme_title'] ?>
                        </h2>


                        <p class="pro__info">APPLYING FEES :
                            <?php echo $get_scheme['0']['applying_fee'] ?>
                        </p>
                        <p class="pro__info">LAST DATE :
                            <?php echo $get_scheme['0']['last_date'] ?>
                        </p>
                        <p class="pro__info">DESCRIPTION :
                            <?php echo $get_scheme['0']['description'] ?>
                        </p>
                        <button> <a class="btn btn-primary btn-lg mb-5" href="https://instapdf.in/pm-kisan-registration-form/#google_vignette">APPLY Now</a></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Product Details Top -->
</section>
 <!-- End Product Grid -->


 <!-- End Banner Area -->
 <?php require('footer.php') ?>