<?php
include 'database.php';
if(isset($_POST['msg'])){
    echo "1";
}else{
    ?>
    <a class="nav-link navbar-text  text-white "  style="position:relative;cursor:pointer"
            id="navbarDropdown" type="button"role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            
        <i class="far fa-bell  iconsizeuser" aria-hidden="true"></i>
        
        <span class="text-dark badge badge-pill bg-white  px-1 " style="position: absolute;top: -2px;right: -7px;z-index:9999;">
        <?php
        $flag1=0;
        $flag2=0;
        $sql="SELECT * FROM `restaurants` where status='pending'";
        $result=mysqli_query($conn,$sql);
        $no_rows1=mysqli_num_rows($result);
        $sql="SELECT * FROM `item` where status='pending'";
        $result=mysqli_query($conn,$sql);
        $no_rows2=mysqli_num_rows($result);
        echo $no_rows1+$no_rows2;
        ?>
        </span>
    </a>
    <div  class="dropdown-menu mt-5" aria-labelledby="navbarDropdown" style="top: -11px;right: 30%">    
        <?php
            $sql="SELECT * FROM `restaurants` where status='pending'";
            $result=mysqli_query($conn,$sql);
            $sql2="SELECT * FROM `item` where status='pending'";
            $result2=mysqli_query($conn,$sql2);
            if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
            ?>
            <a class="dropdown-item px-4 py-2" href="manageRestorant.php">
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
            <a class="dropdown-item px-4 py-2" href="manageRestorant.php">
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

    <?php
}

?>
