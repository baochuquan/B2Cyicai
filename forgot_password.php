<?php
// This page allows a user to reset their password, if forgotten.
require ('includes/config.inc.php'); 
$page_title = '忘记密码';
include ('includes/head.html');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require (MYSQL);

	// Assume nothing:
	$uid = FALSE;

	// Validate the email address...
	if (!empty($_POST['usermail'])) {

		// Check for the existence of that email address...
		$q = 'SELECT user_id FROM users WHERE usermail="'.  mysqli_real_escape_string ($dbc, $_POST['usermail']) . '"';
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		
		if (mysqli_num_rows($r) == 1) { // Retrieve the user ID:
			list($uid) = mysqli_fetch_array ($r, MYSQLI_NUM); 
		} else { // No database match made.
			echo '<p class="error">该邮箱未注册。</p>';
		}
		
	} else { // No email!
		echo '<p class="error">请输入邮箱地址。</p>';
	} // End of empty($_POST['usermail']) IF.
	
	if ($uid) { // If everything's OK.

		// Create a new, random password:
		$p = substr ( md5(uniqid(rand(), true)), 3, 10);

		// Update the database:
		$q = "UPDATE users SET pass=SHA1('$p') WHERE user_id=$uid LIMIT 1";
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

		if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
		
			// Send an email:
			$body = "你可以以下的临时密码登陆【衣彩】账户。登陆后，你可以自行修改密码。";
			mail ($_POST['usermail'], '衣彩账户临时密码', $body, 'From: shuimuyicai@yicai.net');
			
			// Print a message and wrap up:
			echo '<h3>系统已经将临时登陆密码发送至您的邮箱，您可以通过改密码登陆衣彩账户，登录后您可以进行修改密码。</h3>';
			mysqli_close($dbc);
			include ('includes/foot.html');
			exit(); // Stop the script.
			
		} else { // If it did not run OK.
			echo '<p class="error">Your password could not be changed due to a system error. We apologize for any inconvenience.</p>'; 
		}

	} else { // Failed the validation test.
		echo '<p class="error">Please try again.</p>';
	}

	mysqli_close($dbc);

} // End of the main Submit conditional.
?>

<h1>重置密码</h1>
<p>输入您的邮箱并重置您的密码。</p> 
<form action="forgot_password.php" method="post">
	<fieldset>
	<p><b>邮箱:</b> <input type="text" name="usermail" size="20" maxlength="60" value="<?php if (isset($_POST['usermail'])) echo $_POST['usermail']; ?>" /></p>
	</fieldset>
	<div align="center"><input type="submit" name="submit" value="Reset My Password" /></div>
</form>

<?php include('includes/foot.html'); ?>
