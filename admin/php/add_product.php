<?php
//-------------------------------------------------------------
//for product_management.html
//$.post by productAdd.js
//to add new product to database
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

	if ($_SERVER['REQUEST_METHOD'] == "POST") {	
		$flag = "Success";

		// add cur_price, pre_price, product_name, decription
		$q = "INSERT INTO products (pre_price,cur_price,product_name,decription) VALUES ({$_POST['newproductpreprice']},{$_POST['newproductcurprice']},'"."{$_POST['newproductname']}','"."{$_POST['newproductinfo']}')";
		$r = @mysqli_query($dbc, $q);
		if (mysqli_affected_rows($dbc) == 0)
			$flag = "Failed";

		// get product_id 
		$q = "SELECT product_id FROM products ORDER BY product_id DESC LIMIT 1";
		$r = mysqli_query($dbc, $q);
		$product_id = mysqli_fetch_array($r, MYSQLI_NUM);

		// add color, size, tag
		$colorarray = explode(',', $_POST['newproductcolor']);
		$sizearray  = explode(',', $_POST['newproductsize']);
		$tagarray   = explode(',', $_POST['newproducttag']);

		//add color 
		for ($i=0; $i < count($colorarray); $i++) { 
			$q = "SELECT color_name FROM color WHERE color_name='" . $colorarray[$i] . "' LIMIT 1";
			$r = mysqli_query($dbc, $q);
			if (mysqli_affected_rows($dbc) == 0) {// if not exist this color
				//the color name does not exist then insert into color
				$q = "INSERT INTO color (color_name) VALUES ('" . $colorarray[$i] . "')";
				$r = mysqli_query($dbc, $q);
			}
			// get color id
			$q = "SELECT color_id FROM color WHERE color_name='" . $colorarray[$i] . "' LIMIT 1";
			$r = mysqli_query($dbc, $q);
			$color_id = mysqli_fetch_array($r, MYSQLI_NUM);

			$q = "INSERT INTO product_color (product_id, color_id) VALUES ({$product_id['0']},{$color_id['0']})";
			$r = mysqli_query($dbc, $q);
			if (mysqli_affected_rows($dbc) == 0)
				$flag = "Failed";
		}	

		//add size 
		for ($i=0; $i < count($sizearray); $i++) { 
			$q = "SELECT size_name FROM size WHERE size_name='" . $sizearray[$i] . "' LIMIT 1";
			$r = mysqli_query($dbc, $q);
			if (mysqli_affected_rows($dbc) == 0) {// if not exist this size
				//the size name does not exist then insert into size
				$q = "INSERT INTO size (size_name) VALUES ('" . $sizearray[$i] . "')";
				$r = mysqli_query($dbc, $q);
			}
			// get color id
			$q = "SELECT size_id FROM size WHERE size_name='" . $sizearray[$i] . "' LIMIT 1";
			$r = mysqli_query($dbc, $q);
			$size_id = mysqli_fetch_array($r, MYSQLI_NUM);

			$q = "INSERT INTO product_size (product_id, size_id) VALUES ({$product_id['0']},{$size_id['0']})";
			$r = mysqli_query($dbc, $q);
			if (mysqli_affected_rows($dbc) == 0)
				$flag = "Failed";
		}

		//add tag 
		for ($i=0; $i < count($tagarray); $i++) { 
			$q = "SELECT tag_name FROM tags WHERE tag_name='" . $tagarray[$i] . "' LIMIT 1";
			$r = mysqli_query($dbc, $q);
			if (mysqli_affected_rows($dbc) == 0) {// if not exist this size
				//the size name does not exist then insert into size
				$q = "INSERT INTO tags (tag_name) VALUES ('" . $tagarray[$i] . "')";
				$r = mysqli_query($dbc, $q);
			}
			// get color id
			$q = "SELECT tag_id FROM tags WHERE tag_name='" . $tagarray[$i] . "' LIMIT 1";
			$r = mysqli_query($dbc, $q);
			$tag_id = mysqli_fetch_array($r, MYSQLI_NUM);

			$q = "INSERT INTO product_tag (product_id, tag_id) VALUES ({$product_id['0']},{$tag_id['0']})";
			$r = mysqli_query($dbc, $q);
			if (mysqli_affected_rows($dbc) == 0)
				$flag = "Failed";
		}

		// add imges 
		for ($i=0; $i < count($_POST['newproductimg']); $i++) { 
			$q = "SELECT img_name FROM imges WHERE img_name='" . $_POST['newproductimg'][$i] . "' LIMIT 1";
			$r = mysqli_query($dbc, $q);
			if (mysqli_affected_rows($dbc) == 0) {// if not exist
				//the size name does not exist then insert into size
				$q = "INSERT INTO imges (img_name, product_id, add_date) VALUES ('" . $_POST['newproductimg'][$i] . "',{$product_id['0']}, NOW())";
				$r = mysqli_query($dbc, $q);
			}
			else { //if exist just update
				$q = "UPDATE imges SET add_date=NOW() WHERE img_name='" . $_POST['newproductimg'][$i] . "' LIMIT 1";
				$r = mysqli_query($dbc, $q);
			}
			if (mysqli_affected_rows($dbc) == 0)
				$flag = "Failed";
		}
		// set cover 
		$q = "UPDATE imges SET cover=1 WHERE product_id={$product_id['0']} ORDER BY add_date LIMIT 1";
		$r = mysqli_query($dbc, $q);

		if (mysqli_affected_rows($dbc) == 0)
			$flag = "Failed";
		echo $flag;
		mysqli_close($dbc);
	}
}
?>