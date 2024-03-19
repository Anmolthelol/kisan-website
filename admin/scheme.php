<?php 
require('top.inc.php');



if(isset($_GET['type']) && $_GET['type'] != ''){
    $type = get_safe_value($con, $_GET['type']);
    if($type == 'status'){
        $operation = get_safe_value($con, $_GET['operation']);
        $scheme_id = get_safe_value($con, $_GET['id']);
        if($operation == 'active'){
            $status = '1';
        }else{
            $status = '0';
        }
        $update_status_sql = "UPDATE scheme SET status='$status' WHERE scheme_id='$scheme_id'";
        mysqli_query($con, $update_status_sql);
    }

    if($type == 'delete'){
        $scheme_id = get_safe_value($con, $_GET['id']);
        $delete_sql = "DELETE FROM scheme WHERE scheme_id='$scheme_id'";
        mysqli_query($con, $delete_sql);
    }
    
	
}

$sql = "SELECT * FROM scheme ORDER BY scheme_id ASC";
$res = mysqli_query($con, $sql);
?>        
<div class="content pb-0">
    <div class="orders">
        <div class="row">    
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Schemes</h4>
                        <h4 class="box-link"><a href="manage_scheme.php">Add Schemes</a></h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Scheme_title</th>
                                        <th>Description</th>
                                        <th>Scheme_Img</th>
                                        <th>Appling_Fees</th>
                                        <th>Scheme_Last_Date</th>
                                        <th>Url</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i = 1;
                                    while($row = mysqli_fetch_assoc($res)){
                                        ?>
                                        <tr>
                                            <td><?php echo $row['scheme_id']?></td>
                                            <td><?php echo $row['scheme_title']?></td>
                                            <td><?php echo $row['description']?></td>
                                            <td><img src="<?php echo PRODUCT_IMAGE_SITE_PATH . $row['image']?>" /></td>
                                            <td><?php echo $row['applying_fee']?></td>
                                            <td><?php echo $row['last_date']?></td>
                                            <td><?php echo $row['url']?></td>
                                            <td>
                                                <?php 
                                                if($row['status'] == 1){
                                                    echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id=".$row['scheme_id']."'>Active</a></span>&nbsp;";
                                                } else {
                                                    echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id=".$row['scheme_id']."'>Deactive</a></span>&nbsp;";
                                                }
                                                echo "<span class='badge badge-edit'><a href='manage_scheme.php?id=".$row['scheme_id']."'>Edit</a></span>&nbsp;";
                                                echo "<span class='badge badge-delete'><a href='?type=delete&id=".$row['scheme_id']."'>Delete</a></span>";
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
require('footer.inc.php');
?>
