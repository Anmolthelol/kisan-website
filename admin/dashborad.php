<?php
require('database.php');
require('functions.inc.php');
if(!isset($_SESSION["aid"])){
  
 }
?>
<!doctype html>
<html lang="en">

<head>
    <?php require('links.php'); ?>
    <link rel="stylesheet" href="css/dashborad.css">
</head>
<title>Kisansuvidha Admin</title>
<body>
    <?php
     require('navbar.php');
     require('slidebar.php');
    ?>
  <div class="conten-body">   
	<div id="content-wrapper">
		<div class="row mt-3 mr-0 pr-0 ml-2">
			<div class="col-lg-3 col-md-6 col-sm-6 col-10 mt-2">
				<div class="card bg-shadow-skyblue border-0" style="width: 85%">
					<div class="card-body pr-0">
						<div class="row">
							<div class="col-lg-5 col-5 text-left ">
								<i class="material-icons background-round">person_outline</i>
							</div>
							<div class="col-lg-6 col-6 text-right">
								<h4 class="text-white font-weight-bold">Users</h4>

								<h3 class="text-white font-weight-bold mt-3">
									<?php
									$sql="select * from `users` order by uid desc";
                                    $res=mysqli_query($con,$sql);
									$check=mysqli_num_rows($res);
									echo $check;
									?>
								</h3>
							</div>
						</div>
					</div>
				</div>
			</div>

		   
			<div class="col-lg-3 col-md-6 col-sm-6 col-10 mt-2">
				<div class="card bg-shadow-blue border-0" style="width: 85%">
					<div class="card-body pr-0">
						<div class="row">
							<div class="col-lg-5 col-5 text-left ">
								<i class="material-icons background-round">add_shopping_cart</i>
								
							</div>
							<div class="col-lg-6 col-6 text-right">
								<h4 class="text-white font-weight-bold">Product</h4>

								<h3 class="text-white font-weight-bold mt-3">
									<?php
									$sql="select * from `product`";
									$res=mysqli_query($con,$sql);
									$check=mysqli_num_rows($res);
									echo $check;
								   
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
								<i class="material-icons background-round">menu</i>
							</div>
							<div class="col-lg-7 col-7 text-right">
							<h5 class="text-white font-weight-bold mt-1">Category</h5>
							<h3 class="text-white font-weight-bold mt-3">
							<?php
							   $sql="select * from `categories`";
							   $res=mysqli_query($con,$sql);
							   $check=mysqli_num_rows($res);
							   echo $check;
								
							?>
							</h3>
							</div>
						</div>
					</div>
				</div>
			</div>
			 
			<div class="col-lg-3 col-md-6 col-sm-6 col-10 mt-2">
				<div class="card bg-shadow-green border-0" style="width: 85%">
					<div class="card-body pr-1">
						<div class="row">
							<div class="col-lg-5 col-5 text-left ">
								<i class="material-icons background-round">store</i>
							</div>
							<div class="col-lg-7 col-7 text-right">
							<h5 class="text-white font-weight-bold mt-1">Schemes</h5>
							<h3 class="text-white font-weight-bold mt-3">
							<?php
							   $sql="select * from `scheme`";
							   $res=mysqli_query($con,$sql);
							   $check=mysqli_num_rows($res);
							   echo $check;
								
							?>
							</h3>
							</div>
						</div>
					</div>
				</div>
			</div>
			  
        </div>
    </div>
  </div>
        
</body>

</html>