<?php
//-------------------------------------------------------------
//for commitorder.html
//$.post by getCommitInfo.js
//to cartinfo
//-------------------------------------------------------------
require ('../../includes/config.inc.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.

	// Need the database connection:
	require (MYSQL);

	// Need the database connection:
	$q = "SELECT user_id,oc_id, order_id, product_id, quantity, price, color, size, img_name, product_name FROM order_content LEFT JOIN imges USING(product_id) LEFT JOIN products USING(product_id) WHERE user_id={$_POST['user_id']} AND cmt_status='N' AND selected='Y' AND cover='Y'";
	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		
	$cartscontent = '[';
	while($eachcart = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		$cartscontent .= '{"user_id":' . $eachcart['user_id'] .
						', "oc_id":' . $eachcart['oc_id'] .
						', "order_id":' . $eachcart['order_id'] .
						', "product_id":' . $eachcart['product_id'] . 
						', "quantity":' . $eachcart['quantity'] . 
						', "price":' . $eachcart['price'] . 
						', "color":"' . $eachcart['color'] . 
						'", "size":"' . $eachcart['size'] .  
						'", "img_name":"' . $eachcart['img_name'] .
						'", "product_name":"' . $eachcart['product_name'] .
						'"},';
	}
	$cartscontent = substr($cartscontent, 0, strlen($cartscontent)-1);
	$cartscontent .= ']';

	$cartfile = fopen("../../json/commit/cartinfo.json", "w");
	fwrite($cartfile, $cartscontent);
	fclose($cartfile);
}
?>