<?php 
require('database.php');
require('functions.inc.php');
require('add_to_cart.php');


$pid=get_safe_value($con,$_POST['pid']);
$qty=get_safe_value($con,$_POST['qty']);
$type=get_safe_value($con,$_POST['type']);

$obj=new add_to_cart();
if($type=='add'){
    $obj->addProduct($pid,$qty);

}
echo $obj ->totalProduct();
?>