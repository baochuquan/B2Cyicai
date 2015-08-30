<?php
// This page activates the user's account.
require ('includes/config.inc.php'); 
$page_title = '账户激活';
include ('includes/header.html');
?>

<main role="main">
	<div class="container">
		<div class="jumbotron">
			<?php
			// If $x and $y don't exist or aren't of the proper format, redirect the user:
			if (isset($_GET['x'], $_GET['y']) 
				&& filter_var($_GET['x'], FILTER_VALIDATE_EMAIL)
				&& (strlen($_GET['y']) == 32 )
				) {

				// Update the database...
				require (MYSQL);
				$q = "UPDATE users SET active=NULL WHERE (usermail='" . mysqli_real_escape_string($dbc, $_GET['x']) . "' AND active='" . mysqli_real_escape_string($dbc, $_GET['y']) . "') LIMIT 1";
				$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
				
				// Print a customized message:
				if (mysqli_affected_rows($dbc) == 1) {
					echo '<h1 class="text-center"><small>验证完成</small></h1>
							<p class="text-center"><i class="icon fa fa-check fa-2x"></i></p>';
				} else {
					echo '<h1 class="text-center"><small>验证失败</small></h1>
							<p class="text-center"><i class="icon fa fa-times fa-2x"></i></p>'; 
				}
				mysqli_close($dbc);

			} else { // Redirect.

				$url = BASE_URL . 'index.php'; // Define the URL.
				ob_end_clean(); // Delete the buffer.
				header("Location: $url");
				exit(); // Quit the script.

			} // End of main IF-ELSE.
			?>
		</div>
	</div>
</main>

<?php include ('includes/footer.html'); ?>
