<?php
     include 'database.php';   
	  $email=$_POST['email'];
     $pass=$_POST['pass'];
     $sql = "SELECT * FROM `s_admin` WHERE email='$email' and pass='$pass'";
     $result = mysqli_query($conn, $sql);
     if(mysqli_num_rows($result) > 0)
     {
      $row = mysqli_fetch_assoc($result);
      $_SESSION["aid"] =$row['id'];        
      echo "1";
     }
     else{
        echo "wrong Email or Password";
     }
    mysqli_close($conn);
?>