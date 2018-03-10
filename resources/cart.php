<?php require_once("config.php"); ?>

<?php 

// check if add to cart action

if(isset($_GET['add'])) {

	$query = query('SELECT * FROM products WHERE product_id = '. escape_string($_GET['add']) .' ');
	confirm($query);

	while($row = fetch_array($query)) {
		if($row['product_quantity'] != $_SESSION['product_'. $_GET['add']]) {
			$_SESSION['product_'. $_GET['add']] += 1;
			redirect('../public/checkout.php');
		} else {
			set_message('We only have '. $row['product_quantity'] .' '. $row["product_title"] .' available');
			redirect('../public/checkout.php');
		}
	}
}

// check if remove from cart action

if(isset($_GET['remove'])) {
	$_SESSION['product_'. $_GET['remove']] --;

	if($_SESSION['product_'. $_GET['remove']] < 1) {
		unset($_SESSION['items_total']);
		unset($_SESSION['items_quantity']);
		redirect('../public/checkout.php');
	} else {
		redirect('../public/checkout.php');
	}
}

// check if delete from cart action

if(isset($_GET['delete'])) {
	$_SESSION['product_'. $_GET['delete']] = '0';
	unset($_SESSION['items_total']);
	unset($_SESSION['items_quantity']);
	redirect('../public/checkout.php');
}


// render products in cart

function cart() {

	$total = 0;
	$item_quantity = 0;

	// payment variables
	$item_name = 1;
	$item_number = 1;
	$amount = 1;
	$quantity = 1;

	foreach($_SESSION as $name => $value) {

		if($value > 0 && substr($name, 0, 8) == 'product_') {

			$length = strlen($name - 8);
			$id = substr($name, 8, $length);
			
			$query = query("SELECT * FROM products WHERE product_id=". escape_string($id));
			confirm($query);

			while($row = fetch_array($query)){

				$sub_total = $row['product_price'] * $value;
				$item_quantity += $value;

$products = <<<DELIMETER
<tr>
	<td>{$row['product_title']}</td>
	<td>KES {$row['product_price']}</td>
	<td>{$value}</td>
	<td>KES {$sub_total}</td>
	<td><a class="btn btn-info" href="../public/cart.php?add={$row['product_id']}"><span class="glyphicon glyphicon-plus"></span></a>
	<a class="btn btn-warning" href="../public/cart.php?remove={$row['product_id']}"><span class="glyphicon glyphicon-minus"></span></a>
	<a class="btn btn-danger" href="../public/cart.php?delete={$row['product_id']}" ><span class="glyphicon glyphicon-remove"></span></a></td>
</tr>
<input type="hidden" name="item_name_{$item_name}" value="bl">
<input type="hidden" name="item_number_{$item_number}" value="bl">
<input type="hidden" name="amount_{$amount}" value="bl">
<input type="hidden" name="quantity_{$quantity}" value="bl">
DELIMETER;

				echo $products;

				$item_name++;
				$item_number++;
				$amount++;
				$quantity++;
			}

			$_SESSION['items_total'] = $total += $sub_total;
			$_SESSION['items_quantity'] = $item_quantity;
		}
	}
}


?>
