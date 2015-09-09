<?php
//-------------------------------------------------------------
//for product_management.html
//$.post by ...
//to calculate the amount of all the products
//-------------------------------------------------------------
require ('../../includes/config.inc.php');

//redirect if is not admin or unlogged in
if (!isset($_COOKIE['username']) || ($_COOKIE['userlevel'] == 0)) {
	$url = BASE_URL .'index.html';
	header("Location: $url");
	exit();
}
else {
	// Need the database connection:
	require (MYSQL);


	$q = "UPDATE products SET (product_name, pre_price, cur_price) VALUES ('" . $_POST['productname'] . "', {$_POST['productpreprice']}, {$_POST['productcurprice']} WHERE porduct_id=" . $_POST['productid'] . " LIMIT 1";

	mysqli_close($dbc);
}
?>