<!-- Navbar -->
<nav class="navbar  navbar-custom fixed-top">

  <!-- Brand/logo -->
  <a class="navbar-brand navbar-logo  text-light" href="#">
    <!-- <i class="fas fa-hamburger"></i> -->
    <img src="images/kisanlogo.png" style="width:35px;">
  </a>
  <button class="navbar-toggler navbar-brand navbar-logo" type="button"  onclick="$('.sidebar').toggle()"
  style="display: none">
    <i class="fa fa-bars text-white" aria-hidden="true"></i>
  </button>

  <!-- Links -->
    <ul class="nav ml-auto ">
      <li class="nav-item mr-3 dropdown dropleft" id="notification-dropdown">
          <a class="nav-link navbar-text  text-white "  style="position:relative;cursor:pointer"
            id="navbarDropdown" type="button"role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            
            <i class="far fa-bell  iconsizeuser" aria-hidden="true"></i>
            
            <span class="text-dark badge badge-pill bg-white  px-1 " style="position: absolute;top: -2px;right: -7px;z-index:9999;">
            <?php
            $flag1=0;
            $flag2=0;
            $sql="SELECT * FROM `product` where status='active'";
            $result=mysqli_query($con,$sql);
            $no_rows1=mysqli_num_rows($result);
            $sql="SELECT * FROM `categories` where status='active'";
            $result=mysqli_query($con,$sql);
            $no_rows2=mysqli_num_rows($result);
            echo $no_rows1+$no_rows2;
            ?>
            </span>
          </a>
          <div  class="dropdown-menu mt-5" aria-labelledby="navbarDropdown" style="top: -11px;right: 30%">
            <?php
              $sql="SELECT * FROM `product` where status='active'";
              $result=mysqli_query($con,$sql);
              $sql2="SELECT * FROM `categories` where status='active'";
              $result2=mysqli_query($con,$sql2);
              if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                ?>
                <a class="dropdown-item px-4 py-2" href="manage_product.php">
                    <i class="far fa-bell text-info fa-lg pt-2 mr-1" aria-hidden="true"></i>
                    <span class="text-dark"><?php echo "New <b class='text-uppercase'>".$row['name']."</b> Restaurant is Register" ?></span>
                    
                </a>
                <div class="dropdown-divider"></div>
                <?php
                }
              }
              else{
                $flag1=1;
              }
              if (mysqli_num_rows($result2) > 0) {
                while($row2 = mysqli_fetch_assoc($result2)) {
                ?>
                <a class="dropdown-item px-4 py-2" href="manage_product.php">
                    <i class="far fa-bell text-info fa-lg pt-2 mr-1" aria-hidden="true"></i>
                    <span class="text-dark"><?php echo "New <b class='text-uppercase'>".$row2['item_name']."</b> Item is Added" ?></span>
                </a>
                <div class="dropdown-divider"></div>
                <?php
                }
              }
              else{
                $flag2=1;
            }
            if($flag1 == 1 and $flag2 == 1){
              ?>
              <a class="dropdown-item px-4 py-2" href="#">
                    <i class="far fa-bell text-info fa-lg pt-2 mr-1" aria-hidden="true"></i>
                    <span class="text-info">No New Notification</span>
              </a>
              <?php
            }  
            ?>
          </div>
      </li>
      <li class="nav-item dropdown" style="margin-right: 5px;">
        <a class="nav-link dropdown-toggle navbar-text text-white" href="#" 
            id="navbardrop" data-toggle="dropdown">
          <i class="ft-user iconsizeuser" aria-hidden="true"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-default">
          <a class="dropdown-item  animated fadeInUp"  onclick="logout()">Logout</a>
        </div>
      </li>
    </ul>
</nav>
<script>
  function logout() {
    (async () => {
      const {
        value: response
      } = await Swal.fire({
        icon: 'success',
        title: 'Logout successfull',
      })

      
        window.location.replace("logout.php");
      

    })()
  }
</script>