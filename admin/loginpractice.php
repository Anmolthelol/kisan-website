<?php
require('database.php');
if(isset($_SESSION['username'])){
  header('Location:categories.php');
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
          <img src="images/kisansplash.png" alt="IMG">
        </div>

        <form class="login100-form validate-form" method="POST" action="logincheck.php">
          <span class="login100-form-title">
            Admin Login
          </span>

          <div class="alert alert-danger" role="alert" id="error" style="display:none;"></div>

          <div class="wrap-input100 validate-input" >
            <input class="input100" type="text" name="email" id="email" placeholder="Email" required/>
            <span class="symbol-input100">
              <i class="fa fa-envelope" aria-hidden="true"></i>
            </span>
          </div>

          <div class="wrap-input100 validate-input">
            <input class="input100" type="password" name="pass" id="pass" placeholder="Password" required/>
            <span class="symbol-input100">
              <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
          </div>

          <div class="container-login100-form-btn">
            <button class="login100-form-btn" id="btnlogin" type="submit" onclick="login(event);">
              Login
            </button>
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
  
  <script>
    $(".js-tilt").tilt({
      scale: 1.1
    });
  </script>
  <!--===============================================================================================-->
  <script>
        function login(e){
            e.preventDefault();
            var email = $('#email').val();   
            var pass = $('#pass').val();
            $.ajax({
                    url: "php/logincheck.php",
                    type: "POST",
                    data: {
                        email: email,
                        pass: pass
                    },
                    success: function(dataResult){
                        if (dataResult == "1") {
                            window.location.replace("dashbord.php");
                        } else{
                            $("#error").show();
                            $('#error').html(dataResult);
                        }
                    }
                });
        }
        </script>

</body>

</html>
