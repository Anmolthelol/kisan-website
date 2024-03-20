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
function get_product($con,$limit='', $cat_id='', $product_id=''){
	$sql="select * from product where status=1";
	if( $cat_id!=''){
		$sql.=" and category_id=$cat_id";
	}
	if( $product_id!=''){
		$sql.=" and id=$product_id";
	}
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
?>