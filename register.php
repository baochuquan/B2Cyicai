<?php
//this is the main page for the site.
//include the configuration file:
require ('includes/config.inc.php');

//set the page title and include the HTML header:
$page_title = '注册';
include ('includes/header.html');

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.

	// Need the database connection:
	require (MYSQL);
	
	// Trim all the incoming data:
	$trimmed = array_map('trim', $_POST);

	// Assume invalid values:
	$n = $e = $p = FALSE;
	
	// Check for a first name:
	if (preg_match ('/^[A-Z \'.-]{2,60}$/i', $trimmed['username'])) {
		$n = mysqli_real_escape_string ($dbc, $trimmed['username']);
	} else {
		//echo '<p class="error">请输入用户名！</p>';
	}
	
	// Check for an email address:
	if (filter_var($trimmed['usermail'], FILTER_VALIDATE_EMAIL)) {
		$e = mysqli_real_escape_string ($dbc, $trimmed['usermail']);
	} else {
		//echo '<p class="error">邮箱地址无效！</p>';
	}

	// Check for a password and match against the confirmed password:
	if (preg_match ('/^\w{4,20}$/', $trimmed['password1']) ) {
		if ($trimmed['password1'] == $trimmed['password2']) {
			$p = mysqli_real_escape_string ($dbc, $trimmed['password1']);
		} else {
			//echo '<p class="error">两次密码不匹配！</p>';
		}
	} else {
		//echo '<p class="error">密码格式不符合！</p>';
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

<main role="main">
	<div class="container">
		<div class="jumbotron">	
			<h2 class="text-center"><small>注册衣彩账号</small></h2>
			<form class="form-horizontal" action="register.php" method="post">
			  	<div class="form-group">
			    	<label for="username" class="col-xs-2 control-label">用户名</label>
			    	<div class="col-xs-10">
			    		<input type="text" class="form-control" id="username" name="username" size="60" maxlength="60" placeholder="Userename" 
			    			value="<?php if (isset($_POST['username'])) echo $_POST['username'];?>">   
			    	</div>
			    </div>
				<div class="form-group">
			    	<label for="usermail" class="col-xs-2 control-label">邮箱</label>
			    	<div class="col-xs-10">
			    		<input type="email" class="form-control" id="usermail" name="usermail" size="60" maxlength="60" placeholder="Useremail" 
			    			value="<?php if (isset($_POST['usermail'])) echo $_POST['usermail'];?>">   
			    	</div>	  
			  	</div>
			  	<div class="form-group">
			  		<label for="password1" class="col-xs-2 control-label">输入密码</label>
			  		<div class="col-xs-10">
			  			<input type="password" class="form-control" id="password1" name="password1" size="20" maxlength="20" placeholder="Password">
			  		</div>
			  	</div>
			  	<div class="form-group">
			  		<label for="password2" class="col-xs-2 control-label">确认密码</label>
			  		<div class="col-xs-10">
			  			<input type="password" class="form-control" id="password2" name="password2" size="20" maxlength="20" placeholder="Password">
			  		</div>
			  	</div>			  	
        		<div class="form-group">
        			<div class="col-xs-offset-2 col-xs-10">
			  			<button type="submit" class="btn btn-success">注册</button>
			  		</div>
			  	</div>
			</form>
		</div>
	</div>
</main>

<?php include ('includes/footer.html')  ?>