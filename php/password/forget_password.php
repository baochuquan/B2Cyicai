<?php
// This page allows a user to reset their password, if forgotten.
require ('../../includes/config.inc.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require (MYSQL);

	// Assume nothing:
	$uid = FALSE;

	// Check for the existence of that email address...
	$q = 'SELECT user_id FROM users WHERE usermail="'.  mysqli_real_escape_string ($dbc, $_POST['usermail']) . '"';
	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
	
	if (mysqli_num_rows($r) == 1) { // Retrieve the user ID:
		list($uid) = mysqli_fetch_array ($r, MYSQLI_NUM); 
	} else { 
		echo "Unexist";	
		mysqli_close($dbc);
		exit();	
	}
	
	if ($uid) { // If everything's OK.
		// Create a new, random password:
		$p = substr ( md5(uniqid(rand(), true)), 3, 10);

		// Update the database:
		
		$q = "UPDATE users SET pass=SHA1('$p') WHERE user_id=$uid LIMIT 1";
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

		if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
		
			// Send an email:
			$body = "您可以使用临时密码：'$p' 登陆【衣彩】账户。登陆后，您可以自行修改密码。";
			mail ($_POST['usermail'], '【衣彩】账户临时密码', $body, 'From: shuimuyicai@yicai.net');

			echo "Success";
			mysqli_close($dbc);
			exit(); // Stop the script.			
		} else { // If it did not run OK.
			echo "Error";	
		}
	} else { // Failed the validation test.
		echo "Error";
	}
	mysqli_close($dbc);
}
?>