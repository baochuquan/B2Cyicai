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
	$q = "SELECT product_id, img_name FROM imges WHERE product_id={$save['product_id']}";
	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
	if (mysqli_num_rows($r) != 0) { // user exist
		$imgcontent = '[';
		while($eachimg = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
			$imgcontent .= '{"product_id":' . $eachimg['product_id'] . ',"img_name":"' . $eachimg['img_name'] . '"},';
		}
		$imgcontent = substr($imgcontent, 0, strlen($imgcontent)-1);
		$imgcontent .= ']';

		$imgfile = fopen("../json/productimg.json", "w");
		fwrite($imgfile, $imgcontent);
		fclose($imgfile);
	}

	// to write productcolor.json
	$q = "SELECT product_id, color_id, color_name FROM product_color LEFT JOIN color USING(color_id) WHERE product_id={$save['product_id']}";
	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
	if (mysqli_num_rows($r) != 0) { // user exist
		$colorcontent = '[';
		while($eachcolor = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
			$colorcontent .= '{"product_id":' . $eachcolor['product_id'] . ',"color_name":"' . $eachcolor['color_name'] . '","color_id":' . $eachcolor['color_id'] . '},';
		}
		$colorcontent = substr($colorcontent, 0, strlen($colorcontent)-1);
		$colorcontent .= ']';

		$colorfile = fopen("../json/productcolor.json", "w");
		fwrite($colorfile, $colorcontent);
		fclose($colorfile);
	}

	// to write producttag.json
	$q = "SELECT product_id, tag_id, tag_name FROM product_tag LEFT JOIN tags USING(tag_id) WHERE product_id={$save['product_id']}";
	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
	if (mysqli_num_rows($r) != 0) { // user exist
		$tagcontent = '[';
		while($eachtag = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
			$tagcontent .= '{"product_id":' . $eachtag['product_id'] . ',"tag_name":"' . $eachtag['tag_name'] . '","tag_id":' . $eachtag['tag_id'] . '},';
		}
		$tagcontent = substr($tagcontent, 0, strlen($tagcontent)-1);
		$tagcontent .= ']';

		$tagfile = fopen("../json/producttag.json", "w");
		fwrite($tagfile, $tagcontent);
		fclose($tagfile);
	}	

	// to write productdetail.json
	$q = "SELECT * FROM size_detail WHERE product_id={$save['product_id']}";
	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
	if (mysqli_num_rows($r) != 0) { // user exist
		$detailcontent = '[';
		while($eachdetail = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
			$detailcontent .= '{"product_id":' . $eachdetail['product_id'] . ',"type":"' . $eachdetail['type'] . '","shoulder":' . $eachdetail['shoulder'] . ',"breast":' . $eachdetail['breast'] . ',"sleeve":' . $eachdetail['sleeve'] . ',"cloth_len":' . $eachdetail['cloth_len'] . ',"waist":' . $eachdetail['waist'] .',"buttocks":' . $eachdetail['buttocks'] . ',"leg":' . $eachdetail['leg'] .',"shank":' . $eachdetail['shank'] .',"trous_len":' . $eachdetail['trous_len'] .',"size_name":"' . $eachdetail['size_name'] .'","sex":"' . $eachdetail['sex'] .'","collar":' . $eachdetail['collar'] .'},';
		}
		$detailcontent = substr($detailcontent, 0, strlen($detailcontent)-1);
		$detailcontent .= ']';

		$detailfile = fopen("../json/productdetail.json", "w");
		fwrite($detailfile, $detailcontent);
		fclose($detailfile);
	}

	// to write productparameter.json
	$q = "SELECT * FROM parameter WHERE product_id={$save['product_id']}";
	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
	if (mysqli_num_rows($r) != 0) { // user exist
		$paracontent = '[';
		while($eachpara = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
			$paracontent .= '{"product_id":' . $eachpara['product_id'] . ',"style":"' . $eachpara['style'] . '","material":"' . $eachpara['material'] . '","sleeve_style":"' . $eachpara['sleeve_style'] .'","type_version":"' . $eachpara['type_version'] .'","component":"' . $eachpara['component'] . '","collar":"' . $eachpara['collar'] . '"},';
		}
		$paracontent = substr($paracontent, 0, strlen($paracontent)-1);
		$paracontent .= ']';

		$parafile = fopen("../json/productparameter.json", "w");
		fwrite($parafile, $paracontent);
		fclose($parafile);
	}
	mysqli_close($dbc);
}
?>