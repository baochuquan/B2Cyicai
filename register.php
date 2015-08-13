<?php
// This is the registration page for the site.
require ('includes/config.inc.php');
$page_title = '注册';
include ('includes/head.html');

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.

	// Need the database connection:
	require (MYSQL);
	
	// Trim all the incoming data:
	$trimmed = array_map('trim', $_POST);

	// Assume invalid values:
	$n = $e = $p = FALSE;
	
	// Check for a first name:
	if (preg_match ('/^[A-Z \'.-]{2,20}$/i', $trimmed['username'])) {
		$n = mysqli_real_escape_string ($dbc, $trimmed['username']);
	} else {
		echo '<p class="error">请输入用户名！</p>';
	}
	
	// Check for an email address:
	if (filter_var($trimmed['usermail'], FILTER_VALIDATE_EMAIL)) {
		$e = mysqli_real_escape_string ($dbc, $trimmed['usermail']);
	} else {
		echo '<p class="error">邮箱地址无效！</p>';
	}

	// Check for a password and match against the confirmed password:
	if (preg_match ('/^\w{4,20}$/', $trimmed['password1']) ) {
		if ($trimmed['password1'] == $trimmed['password2']) {
			$p = mysqli_real_escape_string ($dbc, $trimmed['password1']);
		} else {
			echo '<p class="error">两次密码不匹配！</p>';
		}
	} else {
		echo '<p class="error">密码格式不符合！</p>';
	}
	
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
				$body = "感谢您注册【衣彩】账户https://www.yicai.net. 点击一下链接激活您的账号:\n\n";
				$body .= BASE_URL . 'activate.php?x=' . urlencode($e) . "&y=$a";
				mail($trimmed['usermail'], '衣彩账户注册激活', $body, 'From: shuimuyicai@yicai.net');
				
				// Finish the page:
				echo '<h3>感谢您的注册！激活码已经发送至您的邮箱。请点击邮件中的链接以激活您的账户。</h3>';
				include ('includes/foot.html'); // Include the HTML footer.
				exit(); // Stop the page.
				
			} else { // If it did not run OK.
				echo '<p class="error">由于系统问题，暂时无法注册，很抱歉为您带来不便。</p>';
			}
			
		} else { // The email address is not available.
			echo '<p class="error">该邮箱地址已经被注册。</p>';
		}
		
	} else { // If one of the data tests failed.
		echo '<p class="error">请重新注册。</p>';
	}

	mysqli_close($dbc);

} // End of the main Submit conditional.
?>
	
<h1>注册</h1>
<form action="register.php" method="post">
	<fieldset>
	<p><b>用户名:</b> <input type="text" name="username" size="20" maxlength="60" value="<?php if (isset($trimmed['username'])) echo $trimmed['username']; ?>" /></p>

	<p><b>邮箱:</b> <input type="text" name="usermail" size="30" maxlength="60" value="<?php if (isset($trimmed['usermail'])) echo $trimmed['usermail']; ?>" /> </p>
		
	<p><b>输入密码:</b> <input type="password" name="password1" size="20" maxlength="20" value="<?php if (isset($trimmed['password1'])) echo $trimmed['password1']; ?>" /> <small>使用字母、数字、下划线等，在4~20个字符之间。</small></p>

	<p><b>确认密码:</b> <input type="password" name="password2" size="20" maxlength="20" value="<?php if (isset($trimmed['password2'])) echo $trimmed['password2']; ?>" /></p>
	</fieldset>
	
	<div align="center"><input type="submit" name="submit" value="Register" /></div>

</form>

<?php include ('includes/footer.html'); ?>
