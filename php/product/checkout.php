<?php
//-------------------------------------------------------------
//for shoppingcart.html
//$.post by cartManageDetail.js
//to checkout, and update the cmt_status of order_content
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

	for ($i=0; $i < count($_POST['checkeditem']); $i++) { 
		$q = "UPDATE order_content SET cmt_status='Y' WHERE user_id={$_POST['user_id']} AND oc_id={$_POST['checkeditem'][$i]['oc_id']} LIMIT 1";
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
	}
	echo "Success";
	mysqli_close($dbc);
}
?>