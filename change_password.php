<?php
// This page allows a logged-in user to change their password.
require ('includes/config.inc.php'); 
$page_title = '修改密码';
include ('includes/head.html');

// If no username session variable exists, redirect the user:
if (!isset($_SESSION['user_id'])) {
	
	$url = BASE_URL . 'index.php'; // Define the URL.
	ob_end_clean(); // Delete the buffer.
	header("Location: $url");
	exit(); // Quit the script.
	
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require (MYSQL);
			
	// Check for a new password and match against the confirmed password:
	$p = FALSE;
	if (preg_match ('/^(\w){4,20}$/', $_POST['password1']) ) {
		if ($_POST['password1'] == $_POST['password2']) {
			$p = mysqli_real_escape_string ($dbc, $_POST['password1']);
		} else {
			echo '<p class="error">两次密码不一致。</p>';
		}
	} else {
		echo '<p class="error">请输入有效格式的密码。</p>';
	}
	
	if ($p) { // If everything's OK.
		// Make the query:
		$q = "UPDATE users SET pass=SHA1('$p') WHERE user_id={$_SESSION['user_id']} LIMIT 1";	
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
			// Send an email, if desired.
			echo '<h3>密码修改成功。</h3>';
			mysqli_close($dbc); // Close the database connection.
			include ('includes/foot.html'); // Include the HTML footer.
			exit();
		} else { // If it did not run OK.
			echo '<p class="error">密码修改失败，请与管理员进行联系。</p>'; 
		}
	} else { // Failed the validation test.
		echo '<p class="error">请重新进行尝试。</p>';		
	}
	mysqli_close($dbc); // Close the database connection.
} // End of the main Submit conditional.
?>

<h1>重置密码</h1>
<form action="change_password.php" method="post">
	<fieldset>
	<p><b>新密码:</b> <input type="password" name="password1" size="20" maxlength="20" /> <small>4~20位字母、数字、下划线</small></p>
	<p><b>确认新密码:</b> <input type="password" name="password2" size="20" maxlength="20" /></p>
	</fieldset>
	<div align="center"><input type="submit" name="submit" value="Change My Password" /></div>
</form>

<?php include ('includes/foot.html'); ?>
