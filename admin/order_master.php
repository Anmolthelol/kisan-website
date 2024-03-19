<?php 
require('top.inc.php');


$sql="select * from users order by uid desc";
$res=mysqli_query($con,$sql);
?>        
<div class="content pb-0">
    <div class="orders">
        <div class="row">	
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                           <h4 class="box-title">Order Master</h4>
					 </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
							  <table>
									<thead>
										<tr>
										<th class="product-thumbnail">Order ID</th>
										<th class="product-name"><span class="nobr">Order Date</span></th>
										<th class="product-price"><span class="nobr">Address</span></th>
										<th class="product-stock-status"><span class="nobr">Payment Type</span></th>
										<th class="product-stock-status"><span class="nobr">Payment Status</span></th>
										<th class="product-stock-status"><span class="nobr">order Status
										</span></th>
										</tr>
									</thead>
									<tbody>
										<?php 
										 $uid=$_SESSION[]
										
										
										
										
										?>
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