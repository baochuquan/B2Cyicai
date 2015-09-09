<?php
//-------------------------------------------------------------
//for product_management.html
//$.post by ...
//to calculate the amount of all the products
//-------------------------------------------------------------
require ('../../includes/config.inc.php');

//redirect if is not admin or unlogged in
if (!isset($_COOKIE['username']) || ($_COOKIE['userlevel'] == 0)) {
	$url = BASE_URL .'index.html';
	header("Location: $url");
	exit();
}
else { 
	// Need the database connection:
	require (MYSQL);
	if(isset($_POST["querytype"])) {
		switch ($_POST["querytype"]) {
			case 'all':
				$q = "SELECT COUNT(product_id) FROM products";
				break;		
			case 'name':
				$q = "SELECT COUNT(product_id) FROM products WHERE product_name LIKE '" . "%" . $_POST['keyword'] . "%'";
				break;
			case 'tag':
				$q = "SELECT COUNT(product_id) FROM products LEFT JOIN product_tag USING(product_id) LEFT JOIN tags USING(tag_id) WHERE tag_name LIKE '" . "%" . $_POST['keyword'] . "%'";
				break;
			case 'price':
				if ($_POST['keyword'] == 200) {
					$q = "SELECT COUNT(product_id) FROM products WHERE cur_price BETWEEN 200.00 AND 300.00";
				}
				elseif ($_POST['keyword'] == 300) {
					$q = "SELECT COUNT(product_id) FROM products WHERE cur_price >= 300.00";
				}
				else {
					$uplimit = $_POST['keyword'] + 50.00;
					$q = "SELECT COUNT(product_id) FROM products WHERE cur_price BETWEEN " . $_POST['keyword'] . " AND " . $uplimit;
				}
				break;
			default:
				break;
		}
		$r = @mysqli_query($dbc, $q);
		if (!$r) {
 			printf("Error: %s\n", mysqli_error($dbc));
 			exit();
 		}
		// Get the mount of registered users
		$productamount = mysqli_fetch_array($r, MYSQLI_NUM);
		echo "{$productamount['0']}";	
	}
	mysqli_free_result($r);
	mysqli_close($dbc);
}
?>
