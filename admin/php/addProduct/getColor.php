<?php
//-------------------------------------------------------------
//for product_management.html
//$.post by productAdd.js
//to get color
//-------------------------------------------------------------
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

	// Need the database connection:
	$q = "SELECT color_id, color_name FROM color";
	$r = mysqli_query($dbc, $q);
	
	$colorcontent = '[';
	while($eachcolor = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		$colorcontent .= '{"color_id": ' . $eachcolor['color_id'] . ', "color_name": "' . $eachcolor['color_name'] . '"},';
	}
	$colorcontent = substr($colorcontent, 0, strlen($colorcontent)-1);
	$colorcontent .= ']';

	$colorfile = fopen("../../json/color.json", "w");
	fwrite($colorfile, $colorcontent);
	fclose($colorfile);
}
?>