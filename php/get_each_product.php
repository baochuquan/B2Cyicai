<?php
//-------------------------------------------------------------
//for product.html
//$.post by generateProduct.js
//write each product infomation to productbase.json,
//productcolor.json, productsize.json, producttag.json
//productimg.json
//-------------------------------------------------------------
require ('../includes/config.inc.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.

	// Need the database connection:
	require (MYSQL);

	$trimmed = array_map('trim', $_POST);
	$save['product_id'] = mysqli_real_escape_string ($dbc, $trimmed['product_id']);

	// to write productbase.json
	$q = "SELECT * FROM products WHERE product_id={$save['product_id']}";
	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
	if (mysqli_num_rows($r) == 1) { // user exist
		$basecontent = '[';
		while($eachbase = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
			$basecontent .= '{"product_id":' . $eachbase['product_id'] . ', "product_name":"' . $eachbase['product_name'] . '","decription":"' . $eachbase['decription'] . '","pre_price":' . $eachbase['pre_price'] . ',"cur_price":' . $eachbase['cur_price'] . '},';
		}
		$basecontent = substr($basecontent, 0, strlen($basecontent)-1);
		$basecontent .= ']';

		$basefile = fopen("../json/productbase.json", "w");
		fwrite($basefile, $basecontent);
		fclose($basefile);
	}
	else {	// if url was edited by customer
		$url = BASE_URL .'index.html';
		header("Location: $url");
		exit();
	}

	// to write productimg.json
	$q = "SELECT img_name FROM imges WHERE product_id={$save['product_id']}";
	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
	if (mysqli_num_rows($r) != 0) { // user exist
		$imgcontent = '[';
		while($eachimg = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
			$imgcontent .= '{"img_name":' . $eachimg['img_name'] . '},';
		}
		$imgcontent = substr($imgcontent, 0, strlen($imgcontent)-1);
		$imgcontent .= ']';

		$imgfile = fopen("../json/productimg.json", "w");
		fwrite($imgfile, $imgcontent);
		fclose($imgfile);
	}

	// to write productcolor.json
	$q = "SELECT color_id, color_name FROM product_color LEFT JOIN color USING(color_id) WHERE product_id={$save['product_id']}";
	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
	if (mysqli_num_rows($r) != 0) { // user exist
		$colorcontent = '[';
		while($eachcolor = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
			$colorcontent .= '{"color_name":"' . $eachcolor['color_name'] . '","color_id":' . $eachcolor['color_id'] . '},';
		}
		$colorcontent = substr($colorcontent, 0, strlen($colorcontent)-1);
		$colorcontent .= ']';

		$colorfile = fopen("../json/productcolor.json", "w");
		fwrite($colorfile, $colorcontent);
		fclose($colorfile);
	}

	// to write productsize.json
	$q = "SELECT size_id, size_name FROM product_size LEFT JOIN size USING(size_id) WHERE product_id={$save['product_id']}";
	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
	if (mysqli_num_rows($r) != 0) { // user exist
		$sizecontent = '[';
		while($eachsize = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
			$sizecontent .= '{"size_name":"' . $eachsize['size_name'] . '","size_id":' . $eachsize['size_id'] . '},';
		}
		$sizecontent = substr($sizecontent, 0, strlen($sizecontent)-1);
		$sizecontent .= ']';

		$sizefile = fopen("../json/productsize.json", "w");
		fwrite($sizefile, $sizecontent);
		fclose($sizefile);
	}

	// to write productsize.json
	$q = "SELECT tag_id, tag_name FROM product_tag LEFT JOIN tags USING(tag_id) WHERE product_id={$save['product_id']}";
	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
	if (mysqli_num_rows($r) != 0) { // user exist
		$tagcontent = '[';
		while($eachtag = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
			$tagcontent .= '{"tag_name":"' . $eachtag['tag_name'] . '","tag_id":' . $eachtag['tag_id'] . '},';
		}
		$tagcontent = substr($tagcontent, 0, strlen($tagcontent)-1);
		$tagcontent .= ']';

		$tagfile = fopen("../json/producttag.json", "w");
		fwrite($tagfile, $tagcontent);
		fclose($tagfile);
	}
	mysqli_close($dbc);
}
?>