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

	$q = "UPDATE products SET product_name='" . mysqli_real_escape_string($dbc, $_POST['productname']) . "', pre_price={$_POST['productcurprice']}, cur_price={$_POST['productcurprice']} WHERE product_id=" . $_POST['productid'] . " LIMIT 1";
	$r = @mysqli_query($dbc, $q);
	//echo mysqli_affected_rows($dbc);

	//save color add 
	for ($i=0; $i < count($_POST['productcolor']); $i++) { 
		$q = "SELECT color_name FROM color LEFT JOIN product_color USING(color_id) WHERE product_id={$_POST['productid']} AND color_name='" . $_POST['productcolor'][$i] . "'";
		$r = mysqli_query($dbc, $q);
		if (mysqli_affected_rows($dbc) == 0) {
			//echo " Color Success -- round:" + $i + $_POST['productcolor'][$i];
			$q = "SELECT color_name FROM color WHERE color_name='" . $_POST['productcolor'][$i] . "' LIMIT 1";
			$r = mysqli_query($dbc, $q);
			if (mysqli_affected_rows($dbc) == 0) {
				//the color name does not exist then insert into color
				$q = "INSERT INTO color (color_name) VALUES ('" . $_POST['productcolor'][$i] . "')";
				$r = mysqli_query($dbc, $q);
			}
			// add the color to the product
			$q = "SELECT color_id FROM color WHERE color_name='" . $_POST['productcolor'][$i] . "' LIMIT 1";
			$r = mysqli_query($dbc, $q);
			$temp_color_id = mysqli_fetch_array($r, MYSQLI_NUM);

			$q = "INSERT INTO product_color (product_id, color_id) VALUES ({$_POST['productid']}, {$temp_color_id['0']})";
			$r = mysqli_query($dbc, $q);
		
		}
	}
	//save color delete
	$q = "SELECT color_name FROM product_color LEFT JOIN color USING(color_id) WHERE product_id={$_POST['productid']}";
	$r = mysqli_query($dbc, $q);
	while($eachcolor = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		if(!(in_array($eachcolor['color_name'], $_POST['productcolor']))) {		
			//echo $eachcolor['color_name'];

			$q = "SELECT color_id FROM color WHERE color_name='" . $eachcolor['color_name'] . "' LIMIT 1";
			$rr = mysqli_query($dbc, $q);
			$delete_color_id = mysqli_fetch_array($rr, MYSQLI_NUM);

			$q = "DELETE FROM product_color WHERE color_id={$delete_color_id['0']} LIMIT 1"; 
			$rr = mysqli_query($dbc, $q);
		}
	}

	//save size add
	for ($i=0; $i < count($_POST['productsize']); $i++) { 
		$q = "SELECT size_name FROM size LEFT JOIN product_size USING(size_id) WHERE product_id={$_POST['productid']} AND size_name='" . $_POST['productsize'][$i] . "'";
		$r = mysqli_query($dbc, $q);
		if (mysqli_affected_rows($dbc) == 0) {
			$q = "SELECT size_name FROM size WHERE size_name='" . $_POST['productsize'][$i] . "' LIMIT 1";
			$r = mysqli_query($dbc, $q);
			if (mysqli_affected_rows($dbc) == 0) {
				//the color name does not exist
				$q = "INSERT INTO size (size_name) VALUES ('" . $_POST['productsize'][$i] . "')";
				$r = mysqli_query($dbc, $q);
			}
			// add the color to the product
			$q = "SELECT size_id FROM size WHERE size_name='" . $_POST['productsize'][$i] . "' LIMIT 1";
			$r = mysqli_query($dbc, $q);
			$temp_size_id = mysqli_fetch_array($r, MYSQLI_NUM);

			$q = "INSERT INTO product_size (product_id, size_id) VALUES ({$_POST['productid']}, {$temp_size_id['0']})";
			$r = mysqli_query($dbc, $q);
		}
	}
	//save size delete
	$q = "SELECT size_name FROM product_size LEFT JOIN size USING(size_id) WHERE product_id={$_POST['productid']}";
	$r = mysqli_query($dbc, $q);
	while($eachsize = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		if(!(in_array($eachsize['size_name'], $_POST['productsize']))) {		
			//echo $eachsize['size_name'];

			$q = "SELECT size_id FROM size WHERE size_name='" . $eachsize['size_name'] . "' LIMIT 1";
			$rr = mysqli_query($dbc, $q);
			$delete_size_id = mysqli_fetch_array($rr, MYSQLI_NUM);

			$q = "DELETE FROM product_size WHERE size_id={$delete_size_id['0']} LIMIT 1"; 
			$rr = mysqli_query($dbc, $q);
		}
	}

	//save tags add
	for ($i=0; $i < count($_POST['producttag']); $i++) { 
		$q = "SELECT tag_name FROM tags LEFT JOIN product_tag USING(tag_id) WHERE product_id={$_POST['productid']} AND tag_name='" . $_POST['producttag'][$i] . "'";
		$r = mysqli_query($dbc, $q);
		if (mysqli_affected_rows($dbc) == 0) {
			$q = "SELECT tag_name FROM tags WHERE tag_name='" . $_POST['producttag'][$i] . "' LIMIT 1";
			$r = mysqli_query($dbc, $q);
			if (mysqli_affected_rows($dbc) == 0) {
				//the color name does not exist
				$q = "INSERT INTO tags (tag_name) VALUES ('" . $_POST['producttag'][$i] . "')";
				$r = mysqli_query($dbc, $q);
			}
			// add the color to the product
			$q = "SELECT tag_id FROM tags WHERE tag_name='" . $_POST['producttag'][$i] . "' LIMIT 1";
			$r = mysqli_query($dbc, $q);
			$temp_tag_id = mysqli_fetch_array($r, MYSQLI_NUM);

			$q = "INSERT INTO product_tag (product_id, tag_id) VALUES ({$_POST['productid']}, {$temp_tag_id['0']})";
			$r = mysqli_query($dbc, $q);
		}
	}
	//save tags delete
	$q = "SELECT tag_name FROM product_tag LEFT JOIN tags USING(tag_id) WHERE product_id={$_POST['productid']}";
	$r = mysqli_query($dbc, $q);
	while($eachtag = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		if(!(in_array($eachtag['tag_name'], $_POST['producttag']))) {		
			//echo $eachcolor['color_name'];

			$q = "SELECT tag_id FROM tags WHERE tag_name='" . $eachtag['tag_name'] . "' LIMIT 1";
			$rr = mysqli_query($dbc, $q);
			$delete_tag_id = mysqli_fetch_array($rr, MYSQLI_NUM);

			$q = "DELETE FROM product_tag WHERE tag_id={$delete_tag_id['0']} LIMIT 1"; 
			$rr = mysqli_query($dbc, $q);
		}
	}
	mysqli_free_result($r);
	mysqli_close($dbc);
}
?>