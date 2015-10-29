<?php
//-------------------------------------------------------------
//for commitorder.html
//$.post by getCommitInfo.js
//to get user address & carinfo
//-------------------------------------------------------------
require ('../../includes/config.inc.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.

	// Need the database connection:
	require (MYSQL);

	// Need the database connection:
	$q = "SELECT * FROM address WHERE user_id={$_POST['user_id']}";
	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		
	$addrscontent = '[';
	while($eachaddr = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		$addrscontent .= '{"user_id":' . $eachaddr['user_id'] . 
						', "addr_id":' . $eachaddr['addr_id'] . 
						', "addr":"' . $eachaddr['addr'] . 
						'", "reciver":"' . $eachaddr['reciver'] . 
						'", "reci_phone":"' . $eachaddr['reci_phone'] . 
						'", "default_addr":"' . $eachaddr['default_addr'] . 
						'"},';
	}
	$addrscontent = substr($addrscontent, 0, strlen($addrscontent)-1);
	$addrscontent .= ']';

	$addrfile = fopen("../../json/commit/address.json", "w");
	fwrite($addrfile, $addrscontent);
	fclose($addrfile);
}
?>