<?php
//-------------------------------------------------------------
//for shoppingcart.html
//$.post by cartManageDetail.js
//to delete the item from cart
//-------------------------------------------------------------
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

	$q = "DELETE FROM order_content WHERE oc_id={$_POST['oc_id']} AND user_id={$_POST['user_id']} LIMIT 1";
	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
	echo "Success";
	mysqli_close($dbc);
}
?>