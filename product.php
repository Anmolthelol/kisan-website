 <?php require('top.php');
 $product_id=mysqli_real_escape_string($con,$_GET['id']);
 $get_product=get_product($con,'',$cat_id,$product_id);
										
 ?>
 
 <?php require('footer.php')?>       