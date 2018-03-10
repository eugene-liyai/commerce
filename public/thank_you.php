<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT . DS . 'header.php') ?>

<?php // process_transaction(); ?>
<?php
	if(isset($_GET['tx'])) {
		$amount = $_GET['amt'];
		$currency = $_GET['cc'];
		$transaction = $_GET['tx'];
		$status = $_GET['st'];

		$query = query("INSERT INTO orders(
			order_amount,
			order_transaction,
			order_status,
			order_currency) VALUES (
			'{$amount}',
			'{$currency}',
			'{$transaction}',
			'{$status}'
			) ");
		confirm(query);
		session_destroy();

	} else {
		redirect('transaction_error.php');
	}
?>
  <!-- Page Content -->
  <div class="container">
  	<h3 class="text-center text-success">THANK YOU FOR SHOPPING WITH US</h3>
  	<h4 class="text-center">Come again soon!!!</h4>
 </div>
 <!-- /.container -->

<?php include(TEMPLATE_FRONT . DS . 'footer.php') ?>
