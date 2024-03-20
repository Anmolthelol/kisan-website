<?php
 session_start();
 $con=mysqli_connect("localhost","root","","kisaansuvidha");
 define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/phpadmindashboard/kisan-website/');
 define('SITE_PATH','http://localhost/phpadmindashboard/kisan-website/');
 
 define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'media/product/');
 define('PRODUCT_IMAGE_SITE_PATH',SITE_PATH.'media/product/');
 
 
?>