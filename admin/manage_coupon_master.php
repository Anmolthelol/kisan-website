<?php 
require('top.inc.php');
$coupon_code="";
$coupon_type="";
$coupon_value="";
$cart_min_value="";


$msg='';

if(isset($_GET['id']) && $_GET['id']!=''){
	$image_required='';
	$id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"select * from coupon_master where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$coupon_code=$row['coupon_code'];
		$coupon_type=$row['coupon_type'];
		$coupon_value=$row['coupon_value'];
		$cart_min_value=$row['cart_min_value'];
		
	}else{
		header('location:coupon_master.php');
		die();
	}
	
}
if(isset($_POST['cancel'])){
	
	 header('location:coupon_master.php');
	   die();
}


if(isset($_POST['submit'])){
	$coupon_code=get_safe_value($con,$_POST['coupon_code']);
	$coupon_type=get_safe_value($con,$_POST['coupon_type']);
	$coupon_value=get_safe_value($con,$_POST['coupon_value']);
	$cart_min_value=get_safe_value($con,$_POST['cart_min_value']);
	
	$res=mysqli_query($con,"select * from coupon_master where coupon_code ='$coupon_code'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['id']){
				
			}else{
				$msg="Coupon Code already exist";
			}
		}else{
			$msg="Coupon Code already exist";
		}
	}
	
	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){
				$update_sql="update coupon_master set coupon_code='$coupon_code',coupon_type='$coupon_type',coupon_value='$coupon_value',
                cart_min_value='$cart_min_value' where id='$id'";
				mysqli_query($con,$update_sql);
			
	   }else{
		  mysqli_query($con,"insert into coupon_master(coupon_code,coupon_type,coupon_value,cart_min_value,status) 
		  values('$coupon_code','$coupon_type','$coupon_value','$cart_min_value',1)");
	   }
	
	   header('location:coupon_master.php');
	   die();
	}
	
}
?>        
   <div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Coupon</strong><small> Form</small></div>
						<Form method="post" enctype="multipart/form-data">
						    <div class="card-body card-block">
								<div class="form-group">
							       <label for="categories" class=" form-control-label">Coupon Code
								   </label>
							       <input type="text" name="coupon_code" placeholder="Enter Coupon Code" 
								   class="form-control" required value="<?php echo $coupon_code?>">
						        </div>
								<div class="form-group">
							       <label for="categories" class=" form-control-label">Coupon Value
								   </label>
							       <input type="text" name="coupon_value" placeholder="Enter Coupon Value" 
								   class="form-control" required value="<?php echo $coupon_value?>">
						        </div>
								<div class="form-group">
							       <label for="categories" class=" form-control-label">Coupon Type
								   </label>
							       <select class="form-control" name="coupon_type" required>
										<option value=''>Select</option>
										<?php
										if($coupon_type=='percentage'){
											echo '<option value="percentage" selected>percentage</option>
												<option value="rupee">rupee</option>';
										}elseif($coupon_type=='rupee'){
											echo '<option value="percentage">percentage</option>
												<option value="rupee" selected>rupee</option>';
										}else{
											echo '<option value="percentage" >percentage</option>
												<option value="rupee">rupee</option>';
										}
										?>
										
									</select>
						        </div>
								<div class="form-group">
							       <label for="categories" class=" form-control-label">Cart Min Value
								   </label>
							       <input type="text" name="cart_min_value" placeholder="Enter Cart Min Value" 
								   class="form-control" required value="<?php echo $cart_min_value?>">
						        </div>
								<button name="cancel" class="btn btn-outline-danger w3-myfont px-2 py-2 m-2 float-right shadow-none  waves-effect waves-light" 
								id="cancelslider">Cancel
							    </button>
							    <button id="payment-button" type="submit" name="submit" class="btn btn-info px-2 py-2 m-2  w3-myfont float-right waves-effect waves-light" style="font-size: 13pt;" >
							    <span id="payment-button-amount">Submit</span>
							    </button>
							 
							  <div class="field_error"><?php echo $msg?></div>
						   </div>
						</Form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>     
         </div>
        
<?php 
require('footer.inc.php');
?>       