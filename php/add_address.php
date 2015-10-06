<?php
//this is the main page for the site.
//include the configuration file:
header("Content-Type:text/html; charset=utf-8");

require ('../includes/config.inc.php');

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
		$save['receivername'] = mysqli_real_escape_string ($dbc, $trimmed['receivername']);
		$save['receiverphone'] = mysqli_real_escape_string ($dbc, $trimmed['receiverphone']);
		$save['receiveraddr'] = mysqli_real_escape_string ($dbc, $trimmed['receiveraddr']);
		$save['setdefault'] = mysqli_real_escape_string ($dbc, $trimmed['setdefault']);

		if($save['receivername'] && $save['receiverphone'] && $save['receiveraddr']){			
			$q = "SELECT user_id FROM users WHERE user_id={$save['user_id']}";
			$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
			if (mysqli_num_rows($r) == 1) { // user exist
				if ($save['setdefault'] == 'Y') {
					$q = "UPDATE address SET default_addr='N' WHERE user_id={$save['user_id']}";
					$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
				}

				$q = "INSERT INTO address (addr,reciver,reci_phone,user_id,default_addr) VALUES ('{$save['receiveraddr']}','{$save['receivername']}','{$save['receiverphone']}','{$save['user_id']}','{$save['setdefault']}')";
				$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

				echo "Success";
			}
		}
		mysqli_close($dbc);
	}
}	
?>