<?php
//-------------------------------------------------------------
//for index.html
//$.post by indexcart.js
//to get all the carts from database
//-------------------------------------------------------------
require ('../../includes/config.inc.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.

	// Need the database connection:
	require (MYSQL);

	// Need the database connection:
	$q = "SELECT oc_id, product_id, quantity, price, color, size, user_id, img_name, product_name FROM order_content LEFT JOIN imges USING(product_id) LEFT JOIN products USING(product_id) WHERE user_id={$_POST['user_id']} AND cover='Y' AND cmt_status='N'";
	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		
	$cartscontent = '[';
	while($eachcart = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		$cartscontent .= '{"oc_id":' . $eachcart['oc_id'] . ', "product_id":' . $eachcart['product_id'] . ', "quantity":' . $eachcart['quantity'] . ', "price":' . $eachcart['price'] . ', "color":"' . $eachcart['color'] . '", "size":"' . $eachcart['size'] . '", "user_id":' . $eachcart['user_id'] . ', "img_name":"' . $eachcart['img_name'] . '", "product_name":"' . $eachcart['product_name'] . '"},';
	}
	$cartscontent = substr($cartscontent, 0, strlen($cartscontent)-1);
	$cartscontent .= ']';

	$cartfile = fopen("../../json/shoppingcart/cartcontent.json", "w");
	fwrite($cartfile, $cartscontent);
	fclose($cartfile);
}
?>