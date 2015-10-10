<?php
//-------------------------------------------------------------
//for myaccount.html
//$.post by show_addr.js
//to get all the address of a user
//-------------------------------------------------------------
require ('../../includes/config.inc.php');

//redirect if is not admin or unlogged in
if (!isset($_COOKIE['username'])) {
	$url = BASE_URL .'index.html';
	header("Location: $url");
	exit();
}
else {
	if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.

		// Need the database connection:
		require (MYSQL);

		// Trim all the incoming data:
		$trimmed = array_map('trim', $_POST);
		$save['user_id'] = mysqli_real_escape_string ($dbc, $trimmed['user_id']);
				
		// Need the database connection:
		$q = "SELECT * FROM address WHERE user_id={$_POST['user_id']}";
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
			
		$addrcontent = '[';
		while($eachaddr = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
			$addrcontent .= '{"addr_id":' . $eachaddr['addr_id'] . ', "addr":"' . $eachaddr['addr'] . '","reciver":"' . $eachaddr['reciver'] . '","reci_phone":"' . $eachaddr['reci_phone'] . '","default_addr":"' . $eachaddr['default_addr'] . '"},';
		}
		$addrcontent = substr($addrcontent, 0, strlen($addrcontent)-1);
		$addrcontent .= ']';

		$addrfile = fopen("../../json/address.json", "w");
		fwrite($addrfile, $addrcontent);
		fclose($addrfile);
	}
}
?>