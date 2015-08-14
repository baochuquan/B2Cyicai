<?php
//this is the main page for the site.
//include the configuration file:
require ('includes/config.inc.php');

//set the page title and include the HTML header:
$page_title = '登陆';
include ('includes/header.html');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require (MYSQL);
	
	// Validate the email address:
	if (!empty($_POST['usermail'])) {
		$e = mysqli_real_escape_string ($dbc, $_POST['usermail']);
	} else {
		$e = FALSE;
		//echo '<p class="error">请输入邮箱地址</p>';
	}

	// Validate the password:
	if (!empty($_POST['pass'])) {
		$p = mysqli_real_escape_string ($dbc, $_POST['pass']);
	} else {
		$p = FALSE;
		//echo '<p class="error">请输入密码</p>';
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
			$url = BASE_URL . 'index_new.php'; // Define the URL.
			ob_end_clean(); // Delete the buffer.
			header("Location: $url");
			exit(); // Quit the script.				
		} else { // No match was made.
			//echo '<p class="error">邮箱和密码不匹配，请确认您的账户是否已经验证。</p>';
		}
		
	} else { // If everything wasn't OK.
		//echo '<p class="error">请重新尝试。</p>';
	}
	mysqli_close($dbc);
} // End of SUBMIT conditional.
?>

<main role="main">
	<div class="container">
		<div class="jumbotron">	
			<h2 class="text-center"><small>登录衣彩账号</small></h2>
			<form class="form-horizontal" action="login.php" method="post">
			  	<div class="form-group">
			    	<label for="usermail" class="col-xs-2 control-label">邮箱</label>
			    	<div class="col-xs-10">
			    		<input type="email" class="form-control" id="usermail" name="usermail" size="60" maxlength="60" placeholder="Useremail" 
			    			value="<?php if (isset($_POST['usermail'])) echo $_POST['usermail'];?>">			   
			    	</div>
			  	</div>
			  	<div class="form-group">
			  		<label for="pass" class="col-xs-2 control-label">密码</label>
			  		<div class="col-xs-10">
			  			<input type="password" class="form-control" id="pass" name="pass" size="20" maxlength="20" placeholder="Password">
			  		</div>
			  	</div>		  	
			  	<div class="form-group">
			  		<div class="col-xs-offset-2 col-xs-10">
			  			<div class="checkbox">			  	
        					<label>
        						<input type="checkbox"> 记住我
        					</label>
        				</div>
        			</div>
        		</div>
        		<div class="form-group">
        			<div class="col-xs-offset-2 col-xs-10">
			  			<button type="submit" class="btn btn-success">登录</button>
			  			<a href="forget_password.php">忘记密码了？</a>
			  		</div>
			  	</div>
			</form>
		</div>
	</div>
</main>

<?php include ('includes/footer.html') ?>
