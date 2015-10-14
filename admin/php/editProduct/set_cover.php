<?php
//-------------------------------------------------------------
//for product_management.html
//$.post by productAdd.js
//to add new product to database
//-------------------------------------------------------------
require ('../../../includes/config.inc.php');

//redirect if is not admin or unlogged in
if (!isset($_COOKIE['username']) || ($_COOKIE['userlevel'] == 0)) {
	$url = BASE_URL .'index.html';
	header("Location: $url");
	exit();
}
else {
	if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.
		// Need the database connection:
		require (MYSQL);

		$flag = 'Success';

		//
		if($_POST['type'] == 'new'){
			// all img cover set to 'N'
			$q = "UPDATE imges SET cover='N' WHERE cover='Y' AND product_id={$_POST['product_id']} LIMIT 1";
			$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

			// add imges 
			for ($i=0; $i < count($_POST['img_name']); $i++) { 
				$q = "INSERT INTO imges (img_name, product_id, add_date) VALUES ('" . mysqli_real_escape_string ($dbc, $_POST['img_name'][$i]) . "',{$_POST['product_id']}, NOW())";
				$r = mysqli_query($dbc, $q);
				if (mysqli_affected_rows($dbc) == 0)
					$flag = "Failed";
			}
			// set new cover
			$q = "UPDATE imges SET cover='Y' WHERE img_name='{$_POST['checked']}' AND product_id={$_POST['product_id']} LIMIT 1";
			$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
			if (mysqli_affected_rows($dbc) == 0)
				$flag = "Failed";
		}

		if($_POST['type'] == 'old') {
			// all img cover set to 'N'
			$q = "UPDATE imges SET cover='N' WHERE cover='Y' AND product_id={$_POST['product_id']} LIMIT 1";
			$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

			// set new cover
			$q = "UPDATE imges SET cover='Y' WHERE img_name='{$_POST['checked']}' AND product_id={$_POST['product_id']} LIMIT 1";
			$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
			if (mysqli_affected_rows($dbc) == 0)
				$flag = "Failed";
		}
		echo $flag;

		mysqli_close($dbc);
	}
}
?>