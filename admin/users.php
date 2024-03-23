<?php 
require('top.inc.php');

if(isset($_GET['type'])&& $_GET['type']!=''){
	$type=get_safe_value($con,$_GET['type']);
	   if($type=='delete'){
		 $uid=get_safe_value($con,$_GET['id']);
		 $delete_sql="delete from users  where uid='$uid'";
		 mysqli_query($con,$delete_sql);
	}
	
}
$sql="select * from users order by uid asc";
$res=mysqli_query($con,$sql);
?>        
<div class="content pb-0">
    <div class="orders">
        <div class="row">	
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                           <h4 class="box-title">Users</h4>
					 </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                     
                                       <th>ID</th>
                                       <th>Name</th>
									   <th>Email</th>
									  <th>Password</th>
									   <th>Mobile</th>
                                       <th>Date</th>
									    <th></th>
                                    </tr>
                                 </thead>
                                 <tbody>
								    <?php 
								    $i=1;
								    while($row=mysqli_fetch_assoc($res)){?>
                                     <tr>
									   
									    <td ><?php echo $row['uid']?></td>
									    <td ><?php echo $row['name']?></td>
										<td ><?php echo $row['email']?></td>
										<td><?php  echo $row['password']?></td>
										<td ><?php echo $row['mobile']?></td>
										<td ><?php echo $row['added_on']?></td>
									    <td >
									    <?php 
										echo "<span class='badge badge-delete'><a href='?type=delete&id="
										.$row['uid']."'>Delete</a></span>";
										
										
								      
									    ?>
									   </td>
									 </tr>
								    <?php }?>
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