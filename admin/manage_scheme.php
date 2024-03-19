<?php 
require('top.inc.php');
$scheme_id="";
$scheme_title="";
$description="";
$image="";
$applying_fee="";
$last_date="";
$url="";

$msg='';

$image_required='required';

if(isset($_GET['id']) && $_GET['id']!=''){
	$image_required='';
	$scheme_id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"select * from scheme where scheme_id='$scheme_id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$scheme_id=$row['scheme_id'];
		$scheme_title=$row['scheme_title'];
		$description=$row['description'];
		$image=$row['image'];
		$applying_fee=$row['applying_fee'];
		$last_date=$row['last_date'];
		$url=$row['url'];
		
	}else{
		header('location:scheme.php');
		die();
	}
	
}
if(isset($_POST['cancel'])){
	
	 header('location:scheme.php');
	   die();
}


if(isset($_POST['submit'])){
	
	$scheme_title=get_safe_value($con,$_POST['scheme_title']);
	$description=get_safe_value($con,$_POST['description']);
	
	$applying_fee=get_safe_value($con,$_POST['applying_fee']);
	$last_date=get_safe_value($con,$_POST['last_date']);
	$url=get_safe_value($con,$_POST['url']);
	
	$res=mysqli_query($con,"select * from scheme where  scheme_id ='$scheme_id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($scheme_id==$getData['scheme_id']){
				
			}else{
				$msg="scheme already exist";
			}
		}else{
			$msg="scheme already exist";
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
				$update_sql="update scheme set scheme_title='$scheme_title',
				description='$description',applying_fee='$applying_fee',
				last_date='$last_date',url='$url',image='$image' where scheme_id='$scheme_id'";
			}else{
				$update_sql="update scheme set scheme_title='$scheme_title',
				description='$description',applying_fee='$applying_fee',
				last_date='$last_date',url='$url',image='$image' where scheme_id='$scheme_id'";
			}
		  mysqli_query($con,$update_sql);
	   }else{
		  $image=rand(111111111,999999999).'_'.$_FILES['image']['name']; 
		  move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
		  mysqli_query($con,"insert into 
		  scheme(scheme_id,scheme_title,description,applying_fee,last_date,url,status,image) 
		  values('$scheme_id','$scheme_title','$description','$applying_fee','$last_date','$url',1,'$image')");
	   }
	
	   header('location:scheme.php');
	   die();
	}
	
}
?>        
<div class="content pb-0">
	<div class="animated fadeIn">
	   <div class="row">
		  <div class="col-lg-12">
			 <div class="card">
				<div class="card-header"><strong>Scheme</strong><small> Form</small></div>
				<Form method="post" enctype="multipart/form-data">
					<div class="card-body card-block">
						<div class="form-group">
						   <label for="categories" class="form-control-label">Scheme Title
						   </label>
						   <input type="text" name="scheme_title" placeholder="Enter scheme title" 
						   class="form-control" required value="<?php echo $scheme_title?>">
						</div>
						<div>
						   <label for="categories" class="form-control-label">Description
						   </label>
						   <textarea name="description" placeholder="Enter scheme description" 
						   class="form-control" required ><?php echo $description?></textarea>
						</div>
						<div class="form-group">
						   <label for="categories" class="form-control-label">Scheme Image
						   </label>
							<input type="file" name="image" class="form-control" <?php echo
							$image_required?>>
						</div>
						<div class="form-group">
						   <label for="categories" class="form-control-label">Applying Fees
						   </label>
						   <textarea name="applying_fee" placeholder="Enter applying_fee" 
						   class="form-control"><?php echo $applying_fee?></textarea>
						</div>
						<div class="form-group">
						   <label for="categories" class=" form-control-label">Last Date
						   </label>
						   <textarea name="last_date" placeholder="Enter last_date" 
						   class="form-control"><?php echo $last_date?></textarea>
						</div>
						<div class="form-group">
						   <label for="categories" class=" form-control-label">URL
						   </label>
						   <textarea name="url" placeholder="Enter url" 
						   class="form-control"><?php echo $url?></textarea>
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