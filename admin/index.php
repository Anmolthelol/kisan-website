<?php
require('top.inc.php');

if(!isset($_POST['login'])){
  header('Location:dashboard.php');
  die();
  }
?>

<!doctype html>
<html lang="en">

<head>
    <?php require('links.php'); ?>
    <link rel="stylesheet" href="css/dashborad.css">
</head>
<title>Kisan Suvidha</title>
<body>
    <?php
     require('navbar.php');
     require('slidebar.php');
    ?>
   
	<div class="col-lg-3 col-md-6 col-sm-6 col-10 mt-2">
		<div class="card bg-shadow-blue border-0" style="width: 85%">
			<div class="card-body pr-0">
				<div class="row">
					<div class="col-lg-5 col-5 text-left ">
						<i class="material-icons background-round">Add Product</i>
						
					</div>
					<div class="col-lg-6 col-6 text-right">
						<h4 class="text-white font-weight-bold">Product</h4>

						<h3 class="text-white font-weight-bold mt-3">
							<?php
							$res=mysqli_query($con,"select * from `product` ");
	                        $getData=mysqli_fetch_assoc($res);
						   
							?>
						</h3>
					</div>
				</div>
			</div>
		</div>
	</div>
                
	<div class="col-lg-3 col-md-6 col-sm-6 col-10 mt-2">
		<div class="card bg-shadow-orenge border-0" style="width: 85%">
			<div class="card-body pr-1">
				<div class="row">
					<div class="col-lg-5 col-5 text-left ">
						<i class="material-icons background-round">store_menu</i>
					</div>
					<div class="col-lg-7 col-7 text-right">
					<h5 class="text-white font-weight-bold mt-1">Category</h5>
					<h3 class="text-white font-weight-bold mt-3">
					<?php
					   
					   $res=mysqli_query($con,"select * from `categories` ");
					   $row=mysqli_fetch_assoc($res);
						
					?>
					</h3>
					</div>
				</div>
			</div>
		</div>
	</div>
   
        
</body>

</html>