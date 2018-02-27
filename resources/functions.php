<?php

// Helper Functions

function set_message($message) {
	if(!empty($message)) {
		$_SESSION['message'] = $message;
	} else {
		$message = '';
	}
}

function display_message() {
	if(isset($_SESSION['message'])) {
		echo $_SESSION['message'];
		unset($_SESSION['message']);
	}
}

function redirect ($location) {

	return header("Location: $location ");
}

function query($sql) {
	global $connection;
	return mysqli_query($connection, $sql);
}

function confirm($result) {
	global $connection;
	if (!$result) {
		die("QUERY FAILED ". mysqli_error($connection));
	}
}

function escape_string ($string) {
	global $connection;
	return mysqli_real_escape_string($connection, $string);
}

function fetch_array($result) {
	return mysqli_fetch_array($result);
}

// Get Products

function get_products() {
	$query = query('SELECT * FROM products');
	confirm($query);

	while($row = fetch_array($query)) {
$product = <<<DELIMETER
<div class="col-sm-4 col-lg-4 col-md-4">
    <div class="thumbnail">
        <a href="item.php?id={$row['product_id']}"><img src="../resources/{$product_image}" alt=""></a>
        <div class="caption">
            <h4 class="pull-right">KES {$row['product_price']}</h4>
            <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
            </h4>
            <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>  
             <a class="btn btn-primary" target="_blank" href="item.php?id={$row['product_id']}">Add to cart</a>
        </div>


       
    </div>
</div>
DELIMETER;

	echo $product;
	}
}

// get categories

function get_categories() {
	 $query = query("SELECT * FROM categories");
	 confirm($query);

	 while($row = fetch_array($query)) {
$category = <<<DELIMETER
	<a href='category.php?id={$row['category_id']}' class='list-group-item'>{$row['category_title']}</a>
DELIMETER;

	echo $category;
	}
}

// get products in category

function get_products_in_category_page() {
	$query = query("SELECT * FROM products WHERE product_category_id = ". escape_string($_GET['id']) ." ");
	confirm($query);

	while($row = fetch_array($query)){
$products = <<<DELIMETER
	<div class="col-md-3 col-sm-6 hero-feature">
		<div class="thumbnail">
			<img src="{$row['product_image']}" alt="">
			<div class="caption">
				<h3>{$row['product_title']}</h3>
				<p>{$row['product_short_description']}</p>
				<p>
					<a href="#" class="btn btn-primary">Buy Now!</a>
					<a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
				</p>
			</div>
		</div>
	</div>
DELIMETER;

	echo $products;
	}
}

// get products for shop page

function get_products_in_shop_page() {
	$query = query("SELECT * FROM products");
	confirm($query);

	while($row = fetch_array($query)){
$products = <<<DELIMETER
	<div class="col-md-3 col-sm-6 hero-feature">
		<div class="thumbnail">
			<img src="{$row['product_image']}" alt="">
			<div class="caption">
				<h3>{$row['product_title']}</h3>
				<p>{$row['product_short_description']}</p>
				<p>
					<a href="#" class="btn btn-primary">Buy Now!</a>
					<a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
				</p>
			</div>
		</div>
	</div>
DELIMETER;

	echo $products;
	}
}

// login function

function login_user() {
	if(isset($_POST['submit'])) {
		$username = escape_string($_POST['username']);
		$password = escape_string($_POST['password']);

		$query = query("SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}' ");
		confirm($query);

		if(mysqli_num_rows($query) == 0) {
			set_message('Username or password is incorrect');
			redirect("login.php");
		} else {
			redirect("admin");
		}
	}
}

// send message from contact us page

function send_message() {
	if(isset($_POST['submit'])) {
		global $admin_email;
		$from_name 	= escape_string($_POST['name']);
		$email 		= escape_string($_POST['email']);
		$subject 	= escape_string($_POST['subject']);
		$message 	= escape_string($_POST['message']);

		$headers 	= "From: {$from_name} {$email}";
		$result 	= mail($admin_email, $subject, $message, $headers);

		if(!$result) {
			set_message('Error! message not sent. Try again');
			redirect('contact.php');
		} else {
			set_message('Message sent');
			redirect('contact.php');
		}
	}
}
 
?>