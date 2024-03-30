
<section class="htc__category__area ptb--100">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="section__title--2 text-center">
                    <h2 class="title__line" style="padding-top: 50px;">PAYMENT COMPLETED</h2>
                    <p>thank you for shopping from kisan suvidha</p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
require('database.php');
require('functions.inc.php');
//$prx($_GET);

if (isset($_GET['payment_status']) && isset($_GET['payment_status']) && isset($_GET['payment_request_id'])) {
	$payment_id = $_GET['payment_id'];
	$payment_status = $_GET['payment_status'];
	$payment_request_id = $_GET['payment_request_id'];

	$res = mysqli_query($con, "select orders.*,users.name from orders,users where orders.txnid='$payment_request_id' and orders.uid=users.uid");
	if (mysqli_num_rows($res) > 0) {
		$row = mysqli_fetch_assoc($res);
		$oid = $row['id'];
		$uid = $row['uid'];

		$_SESSION['USER_LOGIN'] = 'yes';
		$_SESSION['USER_ID'] = $row['uid'];
		$_SESSION['USER_NAME'] = $row['name'];

		if ($payment_status == 'Debit') {
			$res = mysqli_query($con, "select * from orders where txnid='$payment_request_id'");
			mysqli_query($con, "update orders set payment_status='complete', mihpayid='$payment_id' where txnid='$payment_request_id'");
			
?>
			<script>
				window.location.href = 'thank_you.php';
			</script>
		<?php
		} else {
			mysqli_query($con, "update orders set payment_status='fail', mihpayid='$payment_id' where txnid='$payment_request_id'");
		?>
			<script>
				window.location.href = 'payment_fail.php';
			</script>
	<?php
		}
	}
} else {
	?>
	<script>
		window.location.href = 'index.php';
	</script>
<?php
}


?>