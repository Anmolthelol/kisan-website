<?php
include 'database.php';
if(isset($_GET['status'])){
    $status=$_GET['status'];
    $id=$_GET['statusid'];
    $sql = "UPDATE `item` SET status='$status' WHERE id=$id";  
    if (mysqli_query($conn, $sql)) {
        echo $status;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
if(isset($_GET['getUserInfo'])){
    $id=$_GET['getUserInfo'];
    $sql = "SELECT * FROM `user` where u_id=$id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);  
    echo json_encode($row); 
}
if(isset($_GET['updateUserInfo'])){
    $uid=$_GET['uid'];
    $name=$_GET['update_name'];
    $email=$_GET['Update_email'];
    $moblie=$_GET['Update_moblie'];

    $sql = "UPDATE user SET name='$name',email='$email',moblie='$moblie' WHERE u_id=$uid";  
        if (mysqli_query($conn, $sql)) {
        echo "1";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
if(isset($_GET['deleteuser'])){
    $uid=$_GET['deleteuser'];
    $sql = "DELETE FROM user WHERE u_id=$uid";
    if (mysqli_query($conn, $sql)) {
        echo "1";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
if(isset($_GET['orderaccept'])){
    $id=$_GET['orderaccept'];
    $sql = "UPDATE `restaurants` SET status='Accpted' WHERE res_id=$id";  
    if (mysqli_query($conn, $sql)) {
        echo "1";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
if(isset($_GET['orderreject'])){
    $id=$_GET['orderreject'];
    $sql = "UPDATE `restaurants` SET status='Rejected' WHERE res_id=$id";  
    if (mysqli_query($conn, $sql)) {
        echo "1";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

if(isset($_POST['offercodeinsert'])){
    $offer_code=$_POST['offercodeinsert'];

    $offer_code=strtoupper($offer_code);

    $date_t=$_POST['edate']." ".$_POST['etime'];
    $end_date = strtotime($date_t);
    $edate= date("Y-m-d H:i:s", $end_date);

    $sql = "SELECT * FROM `offers` where offer_code='$offer_code'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 0) {
        if($_POST['discount_type'] == "percent"){
            $sql = "INSERT INTO `offers` (`offer_code`, `offer_text`, `valid_user`, `max_usage`, `discount_type`, `min_amount`, `max_discount_amount`, `discount_percentage`,`expire_time`) 
            VALUES ('$offer_code','".$_POST['offerText']."','".$_POST['user']."',".$_POST['maxusage'].",'".$_POST['discount_type']."',".$_POST['min_amount'].",".$_POST['max_discount_amount'].",".$_POST['discount_percentage'].",'$edate')";
        }else{
            $sql = "INSERT INTO `offers` (`offer_code`, `offer_text`, `valid_user`, `max_usage`, `discount_type`, `min_amount`,`flat_discount_amount`,`expire_time`) 
            VALUES ('$offer_code','".$_POST['offerText']."','".$_POST['user']."',".$_POST['maxusage'].",'".$_POST['discount_type']."',".$_POST['min_amount'].",".$_POST['flat_discount_amount'].",'$edate')";
        }
        //echo $sql; 
        if(mysqli_query($conn,$sql)){
           echo "1";
        }else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }else{
        echo "offercodeErr";
    }
}
if(isset($_POST['offercodeupdate'])){
    $id=$_POST['updateid'];
    $offer_code=$_POST['offercodeupdate'];
    $offerText=$_POST['offerText'];
    $user=$_POST['user'];
    $maxusage=$_POST['maxusage'];
    $discount_type=$_POST['discount_type'];
    $min_amount=$_POST['min_amount'];
    $discount_percentage=$_POST['discount_percentage'];
    $max_discount_amount=$_POST['max_discount_amount'];
    $flat_discount_amount=$_POST['flat_discount_amount'];

    $date_t=$_POST['edate']." ".$_POST['etime'];
    $end_date = strtotime($date_t);
    $edate= date("Y-m-d H:i:s", $end_date);

    $offer_code=strtoupper($offer_code);                
    if($_POST['discount_type'] == "percent"){
        $sql = "UPDATE  `offers` SET `offer_code`='$offer_code',`offer_text`='$offerText',
            `valid_user`='$user',`max_usage`=$maxusage,`expire_time`='$edate',
            `discount_type`='$discount_type',`min_amount`=$min_amount,
            `max_discount_amount` =$max_discount_amount,`discount_percentage`=$discount_percentage 
            where id=$id";
    }else{
        $sql = "UPDATE  `offers` SET `offer_code`='$offer_code',`offer_text`='$offerText',
        `valid_user`='$user',`max_usage`=$maxusage,`expire_time`='$edate',
        `discount_type`='$discount_type',`min_amount`=$min_amount,
        `flat_discount_amount` =$flat_discount_amount
        where id=$id";
    }
    if(mysqli_query($conn,$sql)){
        echo "1";
    }else{
        //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        echo "offercodeErr";
    }
        
    
    
}
if(isset($_GET['deleteOffer'])){
    $id=$_GET['deleteOffer'];
    $sql = "DELETE FROM `offers` WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo "1";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
if(isset($_GET['changeOfferid']) and isset($_GET['changeOfferStatus'])){
    $id=$_GET['changeOfferid'];
    $status=$_GET['changeOfferStatus'];
    $sql = "UPDATE `offers` SET status=$status WHERE id=$id";  
    if (mysqli_query($conn, $sql)) {
        echo "1";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
if(isset($_GET['addsliderImage'])){
    $target_dir = "../../uploads/";
    $sql="SELECT  MAX(id) FROM `slider`";
    $result=mysqli_query($conn, $sql);
    $row=mysqli_fetch_assoc($result);
   // $name=date("(Y-m-d)(h-i-s)");
    
    $name=$row['MAX(id)']+1;
    $target_file = $target_dir  . $name . basename($_FILES["file"]["name"]);
    $imagename=$name . basename($_FILES["file"]["name"]);
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO `slider` (`img_name`) VALUES ('$imagename')";
         if (mysqli_query($conn, $sql)) {
            echo "1";
        } 
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }else{
        echo "Sorry, there was an error uploading your file.";
    }
    
}

if(isset($_GET['deletesliderImage'])){
    $id=$_GET['deletesliderImage'];
    $target_dir = "../../uploads/";
    $sql = "SELECT * FROM slider WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $imgname=$row['img_name'];
    $target_file = $target_dir  . $imgname;
    if (file_exists($target_file)){
        unlink($target_file);
        $sql = "DELETE FROM `slider`  WHERE id=$id";
         if (mysqli_query($conn, $sql)) {
            echo "1";
        } 
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }    
}
?>