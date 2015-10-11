<?php
//-------------------------------------------------------------
//$.post by manudeleteproduct.js
//to delete products
//-------------------------------------------------------------

//include the configuration file:
require ('../../../includes/config.inc.php');

//redirect if is not admin or unlogged in
if (!isset($_COOKIE['username']) || ($_COOKIE['userlevel'] == 0)) {
	$url = BASE_URL .'index.html';
	header("Location: $url");
	exit();
}
else {
	// Need the database connection:
	require (MYSQL);

	$q = "DELETE FROM products WHERE product_id='" . $_POST['product_id'] . "' LIMIT 1";
	$r = @mysqli_query($dbc, $q);
	echo "Success";

 	mysqli_close($dbc);
}
?>