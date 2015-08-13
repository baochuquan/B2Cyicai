<?php
// This is the login page for the site.
require ('includes/config.inc.php'); 
$page_title = '登录';
include ('includes/head.html');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require (MYSQL);
	
	// Validate the email address:
	if (!empty($_POST['usermail'])) {
		$e = mysqli_real_escape_string ($dbc, $_POST['usermail']);
	} else {
		$e = FALSE;
		echo '<p class="error">请输入邮箱地址</p>';
	}
	
	// Validate the password:
	if (!empty($_POST['pass'])) {
		$p = mysqli_real_escape_string ($dbc, $_POST['pass']);
	} else {
		$p = FALSE;
		echo '<p class="error">请输入密码</p>';
	}
	
	if ($e && $p) { // If everything's OK.

		// Query the database:
		$q = "SELECT user_id, username, userlevel FROM users WHERE (usermail='$e' AND pass=SHA1('$p')) AND active IS NULL";		
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		
		if (@mysqli_num_rows($r) == 1) { // A match was made.

			// Register the values:
			$_SESSION = mysqli_fetch_array ($r, MYSQLI_ASSOC); 
			mysqli_free_result($r);
			mysqli_close($dbc);
							
			// Redirect the user:
			$url = BASE_URL . 'index.php'; // Define the URL.
			ob_end_clean(); // Delete the buffer.
			header("Location: $url");
			exit(); // Quit the script.
				
		} else { // No match was made.
			echo '<p class="error">邮箱和密码不匹配，请确认您的账户是否已经验证。</p>';
		}
		
	} else { // If everything wasn't OK.
		echo '<p class="error">请重新尝试。</p>';
	}
	mysqli_close($dbc);
} // End of SUBMIT conditional.
?>

<h1>登录</h1>
<p>允许浏览器cookie</p>
<form action="login.php" method="post">
	<fieldset>
	<p><b>邮箱:</b> <input type="text" name="usermail" size="20" maxlength="60" /></p>
	<p><b>密码:</b> <input type="password" name="pass" size="20" maxlength="20" /></p>
	<div align="center"><input type="submit" name="submit" value="Login" /></div>
	</fieldset>
</form>
<a href="login.php">注册</a>
<a href="forget_password.php">忘记密码</a>

<?php include ('includes/foot.html'); ?>
