<?php
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
			$body .= BASE_URL . 'activate.php?x=' . urlencode($e) . "&y=$a";
			mail($trimmed['usermail'], '衣彩账户注册激活', $body, 'From: baochuquan@163.com');
			
			// redirect:
			//echo '<h3>感谢您的注册！激活码已经发送至您的邮箱。请点击邮件中的链接以激活您的账户。</h3>';
			$url = BASE_URL . 'register_success.php';
			ob_end_clean();
			header("Location: $url");
			
			//include ('includes/footer.html'); // Include the HTML footer.
			exit(); // Stop the page.
			
		} else { // If it did not run OK.
			//echo '<p class="error">由于系统问题，暂时无法注册，很抱歉为您带来不便。</p>';
		}
		
	} else { // The email address is not available.
		//echo '<p class="error">该邮箱地址已经被注册。</p>';
	}
	
} else { // If one of the data tests failed.
	//echo '<p class="error">请重新注册。</p>';
}
mysqli_close($dbc);
} // End of the main Submit conditional.

?>