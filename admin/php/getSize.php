<?php
//-------------------------------------------------------------
//for product_management.html
//$.post by productAdd.js
//to get size
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

	// Need the database connection:
	$q = "SELECT size_id, size_name FROM size ORDER BY size_id";
	$r = mysqli_query($dbc, $q);
	
	$sizecontent = '[';
	while($eachsize = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		$sizecontent .= '{"size_id": ' . $eachsize['size_id'] . ', "size_name": "' . $eachsize['size_name'] . '"},';
	}
	$sizecontent = substr($sizecontent, 0, strlen($sizecontent)-1);
	$sizecontent .= ']';

	$sizefile = fopen("../json/size.json", "w");
	fwrite($sizefile, $sizecontent);
	fclose($sizefile);
}
?>