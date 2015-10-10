<?php
//this is the main page for the site.
//include the configuration file:
header("Content-Type:text/html; charset=utf-8");

require ('../../includes/config.inc.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.
	// Need the database connection:
	require (MYSQL);
	
	// Trim all the incoming data:
	$trimmed = array_map('trim', $_POST);

	// Assume invalid values:
	$n = $e = $p = FALSE;
	
	$n = mysqli_real_escape_string ($dbc, $trimmed['username']);
	$e = mysqli_real_escape_string ($dbc, $trimmed['usermail']);
	$p = mysqli_real_escape_string ($dbc, $trimmed['password1']);
	
	if ($n && $e && $p) { // If everything's OK...
		// Make sure the email address is available:
		$q = "SELECT user_id FROM users WHERE usermail='$e'";
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		if (mysqli_num_rows($r) == 0) { // Available.
			// Create the activation code:
			$a = md5(uniqid(rand(), true));
			// Add the user to the database:
			$q = "INSERT INTO users (usermail, pass, username, active, regist_date) VALUES ('$e', SHA1('$p'), '$n', '$a', NOW() )";
			$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
				$body = "感谢您注册【衣彩】账户https://www.yicai.net/点击以下链接激活您的账号:\n\n";
				$body .= BASE_URL . 'activate.html?x=' . urlencode($e) . "&y=$a";
				mail($trimmed['usermail'], '衣彩账户注册激活', $body, 'From: baochuquan@163.com');

				echo 'Success';
				exit(); // Stop the page.	
			} else { // If it did not run OK.
				echo 'Error';
			}	
		} else { // The email address is not available.
			echo 'Reuse';
		}
	} else { // If one of the data tests failed.
		echo 'Retry';
	}
	mysqli_close($dbc);
} // End of the main Submit conditional.
?>