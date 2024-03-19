<table>
<?php
include('database.php');
$id=$_GET['id'];
$sql = "SELECT * FROM `offers` where id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
foreach ( $row as $key => $value )
{
  if($value != ""){
    ?>
    <div class="pair-group-item text-capitalize">
      <div class="pair-label" style="font-size: smaller;">
        <?php 
            if($key == "offer_code"){
                echo "Offer Code"; 
            }
            else if($key == "offer_text"){
              echo "Offer Text"; 
            }
            else if($key == "valid_user"){
              echo "Valid Users"; 
            }
            else if($key == "max_usage"){
              echo "Maximum Usage"; 
            }
            else if($key == "discount_type"){
              echo "Discount Type"; 
            }
            else if($key == "min_amount"){
              echo "Min Discount"; 
            }
            else if($key == "flat_discount_amount"){
              echo "Discount Amount"; 
            }
            else if($key == "discount_percentage"){
              echo "Discount Percentage"; 
            }
            else if($key == "max_discount_amount"){
              echo "Max Discount Amount"; 
            }
            else if($key == "expire_time"){
              echo "Expire Date & Time"; 
            }
            else{
              echo $key; 
            }
        ?>
      </div>
      <div class="pair-value">
        <?php
            if($value == "1" and $key == "status"){ 
              echo "<span class='label--primary badge badge-success'><a>Enabled</a></span><u style='cursor:pointer;' class='ml-2 text-danger' onclick='changeOfferStatus($id,0)'>Disable</u>";
            }
            else if($value == "0" and $key == "status"){
             echo "<span class='label--primary badge badge-danger'><a>Disabled</a></span><u style='cursor:pointer;' class='ml-2 text-success' onclick='changeOfferStatus($id,1)'>Enable</u>";
            }
            else if($key == "offer_code"){
              echo "<span class='label--primary badge badge-info'>$value</span>";
            }
            else if($key == "expire_time"){
              echo date("d F,Y h:i", strtotime($row['expire_time'])); 
            }
            else{
              echo "<span class='label--primary'>$value</span>";
            }
          ?>
      </div>
    </div>
    <?php
}
}
?>
</table>