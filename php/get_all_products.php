<?php
//-------------------------------------------------------------
//for index.html
//$.post by indexProduct.js
//to get all the products from database
//-------------------------------------------------------------
require ('../includes/config.inc.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.

	// Need the database connection:
	require (MYSQL);

	// Need the database connection:
	$q = "SELECT product_id, product_name, decription, img_name FROM products LEFT JOIN imges USING(product_id) WHERE cover='Y' GROUP BY product_id";
	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		
	$productscontent = '[';
	while($eachproduct = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		$productscontent .= '{"product_id":' . $eachproduct['product_id'] . ', "product_name":"' . $eachproduct['product_name'] . '","decription":"' . $eachproduct['decription'] . '","img_name":"' . $eachproduct['img_name'] . '"},';
	}
	$productscontent = substr($productscontent, 0, strlen($productscontent)-1);
	$productscontent .= ']';

	$productfile = fopen("../json/products.json", "w");
	fwrite($productfile, $productscontent);
	fclose($productfile);
}
?>