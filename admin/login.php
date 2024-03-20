<?php 
require('database.php');
require('functions.inc.php');
$msg='';
if(isset($_POST['login'])){
	 $email=get_safe_value($con,$_POST['email']);
	 $pass=get_safe_value($con,$_POST['pass']);
	 $sql="select * from admin_users where email='$email' and pass='$pass'";
	 $res=mysqli_query($con,$sql);
     $count=mysqli_num_rows($res);
     if($count>0){
		 $_SESSION['ADMIN_LOGIN']="yes";
		 $_SESSION['ADMIN_EMAIL']="$email";
		 header('location:dashborad.php');
		 die();
	 }else{
		 $msg="Please enter login details ";
	 }	 
	 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>ADMIN</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!--===============================================================================================-->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="css/login.css" />
  <!--===============================================================================================-->
</head>
<title>kisan suvidha</title>

<body>
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <div class="login100-pic js-tilt" data-tilt>
          <img src="images/kisan.jpg" alt="IMG">
        </div>

        <form class="login100-form validate-form" method="POST" action="login.php">
          <span class="login100-form-title">
            Admin Login
          </span>

          <div class="alert alert-danger" role="alert" id="error" style="display:none;"></div>

          <div class="wrap-input100 validate-input" >
            <input class="input100" type="text" name="email"  placeholder="Email" required/>
            <span class="symbol-input100">
              <i class="fa fa-envelope" aria-hidden="true"></i>
            </span>
          </div>

          <div class="wrap-input100 validate-input">
            <input class="input100" type="password" name="pass"  placeholder="Password" required/>
            <span class="symbol-input100">
              <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
          </div>

          <div class="container-login100-form-btn">
            <button type="submit" name="login" class="login100-form-btn">
			  
              Login
            </button>
			 <div class="field_error"><?php echo $msg?></div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!--===============================================================================================-->
  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
  <!--===============================================================================================-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tilt.js/1.2.1/tilt.jquery.min.js"></script>
  <!--===============================================================================================-->
    <link href="../include/fontawesome-free-5.12.1/css/fontawesome.css" rel="stylesheet">
    <link href="../include/fontawesome-free-5.12.1/css/regular.css" rel="stylesheet">
    <link href="../include/fontawesome-free-5.12.1/css/brands.css" rel="stylesheet">
    <link href="../include/fontawesome-free-5.12.1/css/solid.css" rel="stylesheet">
  <!--===============================================================================================-->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>


 
  </body>

</html>

