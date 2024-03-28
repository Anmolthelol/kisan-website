<?php
require('database.php');
require('functions.inc.php');
//$prx($_GET);
echo '<b>Transaction In Process, Please do not reload</b>';
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

		if ($payment_status == 'Credit') {
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