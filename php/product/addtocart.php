<?php
require ('../../includes/config.inc.php');

//redirect if is not admin or unlogged in
if (!isset($_COOKIE['username']) || ($_COOKIE['userlevel'] == '')) {
	$url = BASE_URL .'index.html';
	header("Location: $url");
	exit();
}
else { 
	// Need the database connection:
	require (MYSQL);

	$q = "INSERT INTO order_content (product_id,quantity,price,color,size,user_id) VALUES ({$_POST['product_id']},{$_POST['orderamount']},{$_POST['curprice']},'{$_POST['productcolor']}','{$_POST['size']}',{$_POST['user_id']})";
	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
	echo "Success";
	mysqli_close($dbc);
}
?>