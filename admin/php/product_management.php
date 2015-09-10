<?php

require ('../../includes/config.inc.php');

//redirect if is not admin or unlogged in
if (!isset($_SESSION['username']) || ($_SESSION['userlevel'] == 0)) {
	$url = BASE_URL .'index.html';
	ob_end_clean();
	header("Location: $url");
	exit();
}
else {
	// Need the database connection:
	require (MYSQL);
	// Define the query...
	// Fetch all the information of products;
	$q = "SELECT product_id, product_name, pre_price, cur_price, SUM(quantity) AS sales FROM products LEFT JOIN order_content USING(product_id) GROUP BY (products.product_id) ORDER BY sales DESC";
	$r = @mysqli_query($dbc, $q);	
	$i = 1;
?>