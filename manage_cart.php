<?php 
require('database.php');
require('functions.inc.php');
require('add_to_cart.php');


$pid=get_safe_value($con,$_POST['pid']);
$qty=get_safe_value($con,$_POST['qty']);
$type=get_safe_value($con,$_POST['type']);
$productSoldQtyByProductId=productSoldQtyByProductId($con,$pid);
$productQty=productQty($con,$pid);
$obj=new add_to_cart();
$pending_qty=$productQty-$productSoldQtyByProductId;
if($qty>$pending_qty){
    echo "not_avaliable";
    die();
}


if($type=='add'){
    $obj->addProduct($pid,$qty);

}

if($type=='remove'){
    $obj->removeProduct($pid);

}

if($type=='update'){
    $obj->updateProduct($pid,$qty);

}


echo $obj ->totalProduct();
?>