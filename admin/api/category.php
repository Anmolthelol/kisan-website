<?php 
 
require('../database.php');
require('../functions.inc.php');


if(isset($_GET['type']) && $_GET['type']!='') {
    $type = get_safe_value($con, $_GET['type']);
    if($type == 'status') {
        $operation = get_safe_value($con, $_GET['operation']);
        $category_id = get_safe_value($con, $_GET['id']);
        if($operation == 'active') {
            $status = '1';
        } else {
            $status = '0';
        }
        $update_status_sql = "update categories set status='$status' where category_id='$category_id'";
        mysqli_query($con, $update_status_sql);
    }

    if($type == 'delete') {
        $category_id = get_safe_value($con, $_GET['id']);
        $delete_sql = "delete from categories where category_id='$category_id'";
        mysqli_query($con, $delete_sql);
    }
}

$sql = "select * from categories order by categories asc";
$res = mysqli_query($con, $sql);

// Fetching all rows and storing them in an array
$data = array();
while ($row = mysqli_fetch_assoc($res)) {
    $data[] = $row;
}
$returnData = array(
	'flag' => 1,
	'msg' => 'success',
	'data' => $data
);
echo json_encode($returnData);
return;
?>
