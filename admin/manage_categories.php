<?php 
require('top.inc.php');
$categories='';
$msg='';

if(isset($_GET['id']) && $_GET['id']!=''){
	$category_id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"select * from categories where category_id='$category_id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$categories=$row['categories'];
	}else{
		header('location:categories.php');
		die();
	}
	
}
if(isset($_POST['cancel'])){
	
	 header('location:categories.php');
	   die();
}
	
	

if(isset($_POST['submit'])){
	$categories=get_safe_value($con,$_POST['categories']);
	$res=mysqli_query($con,"select * from categories where categories='$categories'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($category_id==$getData['category_id']){
				
			}else{
				$msg="Categories already exist";
			}
		}else{
			$msg="Categories already exist";
		}
	}
	
	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){
		  mysqli_query($con,"update categories set categories='$categories' where category_id='$category_id'");
	   }else{
		  mysqli_query($con,"insert into categories(categories,status) values('$categories','1')");
	   }
	
	   header('location:categories.php');
	   die();
	}
	
}
?>        
   <div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Categories</strong><small> Form</small></div>
						<Form method="post">
						    <div class="card-body card-block">
                                <div class="form-group">
							       <label for="categories" class=" form-control-label">Categories
								   </label>
							       <input type="text" name="categories" placeholder="Enter categories name" 
								   class="form-control" required value="<?php echo $categories?>">
						        </div>
								
                             <button name="cancel" class="btn btn-outline-danger w3-myfont px-2 py-2 m-2 float-right shadow-none  waves-effect waves-light" 
							  id="cancelslider">Cancel
							  </button>
							  <button id="payment-button" type="submit" name="submit" class="btn btn-info px-2 py-2 m-2  w3-myfont float-right waves-effect waves-light" style="font-size: 13pt;" 
							  <span id="payment-button-amount">Submit</span>
							  </button>
							  
							<!--  <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                              <span id="payment-button-amount">Submit</span>
							  </button>-->
							  
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