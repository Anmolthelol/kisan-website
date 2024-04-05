<?php
function pr($arr){
	echo '<pre>';
	print_r($arr);

}
function prx($arr){
	echo '<pre>';
	print_r($arr);
	die();
}
function get_safe_value($con,$str){
	if($str!=''){
		$str=trim($str);
		return mysqli_real_escape_string($con,$str);
	}
}	
function get_product($con, $limit='', $cat_id='', $product_id='', $search_str='', $sort_order='',$is_best_seller='') {
    //$sql="select *  from product where status=1";
    $sql="select product.*,categories.categories  from product,categories where product.status=1";
    if ($cat_id!='') {
        $sql .= " and product.category_id=$cat_id";
    }
    if ($product_id!='') {
        $sql .= " and product.id=$product_id";
    }
	if ($is_best_seller!='') {
        $sql .= " and product.best_seller=1";
    }
    $sql .= " and product.category_id=categories.category_id";
    if ($search_str!='') {
        $sql .= " and (product.product_name like '%$search_str%' or product.description like '%$search_str%')";
    }
    if ($sort_order!='') {
        $sql .= " " . $sort_order; // Appending the sort order separately
    } else {
        $sql .= " order by product.id desc";
    }
   if($limit!=''){
		$sql.=" limit $limit";
	}
	//echo $sql;
	
	$res=mysqli_query($con,$sql);
	$data=array();
	while($row=mysqli_fetch_assoc($res)){
		$data[]=$row;
	}
	return $data;
}
function get_scheme($con,$limit=''){
	$sql="select * from scheme where status=1";
	
	if($limit!=''){
		$sql.=" limit $limit";
	}
	$res=mysqli_query($con,$sql);
	$data=array();
	while($row=mysqli_fetch_assoc($res)){
		$data[]=$row;
	}
	return $data;
}
function productSoldQtyByProductId($con,$pid){
	$sql="select sum(order_details.qty) as qty from order_details,orders where orders.id=order_details.order_id and order_details.product_id=$pid and orders.order_status!=4";
	$res=mysqli_query($con,$sql);
	$row=mysqli_fetch_assoc($res);
	return $row['qty'];
}
?>