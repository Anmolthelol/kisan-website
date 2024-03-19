<?php 
require('top.inc.php');
$category_id="";
$product_name="";
$mrp="";
$price="";
$qty="";
$image="";
$short_description="";
$description="";
$meta_title="";
$meta_description="";
$meta_keyword="";
$msg='';

$image_required='required';

if(isset($_GET['id']) && $_GET['id']!=''){
	$image_required='';
	$id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"select * from product where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$category_id=$row['category_id'];
		$product_name=$row['product_name'];
		$mrp=$row['mrp'];
		$price=$row['price'];
		$qty=$row['qty'];
		$short_description=$row['short_description'];
		$description=$row['description'];
		$meta_title=$row['meta_title'];
		$meta_description=$row['meta_description'];
		$meta_keyword=$row['meta_keyword'];
		
	}else{
		header('location:product.php');
		die();
	}
	
}
if(isset($_POST['cancel'])){
	
	 header('location:product.php');
	   die();
}


if(isset($_POST['submit'])){
	$category_id=get_safe_value($con,$_POST['category_id']);
	$product_name=get_safe_value($con,$_POST['product_name']);
	$mrp=get_safe_value($con,$_POST['mrp']);
	$price=get_safe_value($con,$_POST['price']);
	$qty=get_safe_value($con,$_POST['qty']);
	$short_description=get_safe_value($con,$_POST['short_description']);
	$description=get_safe_value($con,$_POST['description']);
	$meta_title=get_safe_value($con,$_POST['meta_title']);
	$meta_description=get_safe_value($con,$_POST['meta_description']);
	$meta_keyword=get_safe_value($con,$_POST['meta_keyword']);
	
	$res=mysqli_query($con,"select * from product where  product_name ='$product_name'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['id']){
				
			}else{
				$msg="Product already exist";
			}
		}else{
			$msg="Product already exist";
		}
	}
	
	if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']
	['type']!='image/jpeg'){
		$msg="Please select only png,jpg and jpeg image formate";
	}
	
	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){
			if($_FILES['image']['name']!=''){
				$image=rand(111111111,999999999).'_'.$_FILES['image']['name']; 
				move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
				$update_sql="update product set category_id='$category_id',product_name='$product_name',mrp='$mrp',
                price='$price',qty='$qty',short_description='$short_description',description='$description',meta_title='$meta_title',   
                meta_description='$meta_description',meta_keyword='$meta_keyword',image='$image' where id='$id'";
			}else{
				$update_sql="update product set category_id='$category_id',product_name='$product_name',mrp='$mrp',
                price='$price',qty='$qty',short_description='$short_description',description='$description',meta_title='$meta_title',   
                meta_description='$meta_description',meta_keyword='$meta_keyword' where id='$id'";
			}
		  mysqli_query($con,$update_sql);
	   }else{
		  $image=rand(111111111,999999999).'_'.$_FILES['image']['name']; 
		  move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
		  mysqli_query($con,"insert into 
		  product(category_id,product_name,mrp,price,qty,short_description,description,meta_title,meta_description,meta_keyword,status,image) 
		  values('$category_id','$product_name','$mrp','$price','$qty','$short_description','$description','$meta_title','$meta_description','$meta_keyword',1,'$image')");
	   }
	
	   header('location:product.php');
	   die();
	}
	
}
?>        
   <div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Product</strong><small> Form</small></div>
						<Form method="post" enctype="multipart/form-data">
						    <div class="card-body card-block">
                                <div class="form-group">
							       <label for="categories" class=" form-control-label">Categories
								   </label>
							       <select class="form-control" name="category_id">
										<option>Select Category</option>
										<?php 
											$res=mysqli_query($con,"select category_id,categories from categories order by categories asc");
											while($row=mysqli_fetch_assoc($res)){
												if($row['category_id']==$category_id){
													echo "<option selected value=".$row['category_id'].">".$row['categories']."</option>";
												}else{
													echo "<option value=".$row['category_id'].">".$row['categories']."</option>";
												}
												
											}
										?>
									</select>
						        </div>
								<div class="form-group">
							       <label for="categories" class=" form-control-label">Product Name
								   </label>
							       <input type="text" name="product_name" placeholder="Enter product name" 
								   class="form-control" required value="<?php echo $product_name?>">
						        </div>
								<div class="form-group">
							       <label for="categories" class=" form-control-label">MRP
								   </label>
							       <input type="text" name="mrp" placeholder="Enter product mrp" 
								   class="form-control" required value="<?php echo $mrp?>">
						        </div>
								<div class="form-group">
							       <label for="categories" class=" form-control-label">price
								   </label>
							       <input type="text" name="price" placeholder="Enter product price" 
								   class="form-control" required value="<?php echo $price?>">
						        </div>
								<div class="form-group">
							       <label for="categories" class=" form-control-label">Qty
								   </label>
							       <input type="text" name="qty" placeholder="Enter product quantity" 
								   class="form-control" required value="<?php echo $qty?>">
						        </div>
								<div class="form-group">
							       <label for="categories" class=" form-control-label">Image </label>
							       <input type="file" name="image" class="form-control" <?php echo
								    $image_required?>>
						        </div>
								<div class="form-group">
							       <label for="categories" class=" form-control-label">Short Descption
								   </label>
							       <textarea name="short_description" placeholder="Enter product short description" 
								   class="form-control" required ><?php echo $short_description?></textarea>
						        </div>
								
								<div class="form-group">
							       <label for="categories" class=" form-control-label">Descption
								   </label>
							       <textarea name="description" placeholder="Enter product description" 
								   class="form-control" required ><?php echo $description?></textarea>
						        </div>
								<div class="form-group">
							       <label for="categories" class=" form-control-label">Meta Title
								   </label>
							       <textarea name="meta_title" placeholder="Enter product meta title" 
								   class="form-control"><?php echo $meta_title?></textarea>
						        </div>
								<div class="form-group">
							       <label for="categories" class=" form-control-label">Meta Descption
								   </label>
							       <textarea name="meta_description" placeholder="Enter product meta description" 
								   class="form-control"><?php echo $meta_description?></textarea>
						        </div>
								<div class="form-group">
							       <label for="categories" class=" form-control-label">Meta Keyword
								   </label>
							       <textarea name="meta_keyword" placeholder="Enter product meta keyword" 
								   class="form-control"><?php echo $meta_keyword?></textarea>
						        </div>
								
								
								<button name="cancel" class="btn btn-outline-danger w3-myfont px-2 py-2 m-2 float-right shadow-none  waves-effect waves-light" 
								id="cancelslider">Cancel
							    </button>
							    <button id="payment-button" type="submit" name="submit" class="btn btn-info px-2 py-2 m-2  w3-myfont float-right waves-effect waves-light" style="font-size: 13pt;" 
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