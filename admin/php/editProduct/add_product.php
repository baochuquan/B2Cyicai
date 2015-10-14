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
	if ($_SERVER['REQUEST_METHOD'] == "POST") {	
		// Need the database connection:
		require (MYSQL);

		$save['product_id'] = mysqli_real_escape_string ($dbc, trim($_POST['product_id']));
		$save['newproductname'] = mysqli_real_escape_string ($dbc, trim($_POST['newproductname']));
		$save['newproductpreprice'] = mysqli_real_escape_string ($dbc, trim($_POST['newproductpreprice']));
		$save['newproductcurprice'] = mysqli_real_escape_string ($dbc, trim($_POST['newproductcurprice']));

		//$save['newproductsizedetail'] = mysqli_real_escape_string ($dbc, $trimmed['newproductsizedetail']);
		$save['type'] = mysqli_real_escape_string ($dbc, trim($_POST['type']));
		$save['style'] = mysqli_real_escape_string ($dbc, trim($_POST['style']));
		$save['material'] = mysqli_real_escape_string ($dbc, trim($_POST['material']));
		$save['component'] = mysqli_real_escape_string ($dbc, trim($_POST['component']));
		$save['sleeve_style'] = mysqli_real_escape_string ($dbc, trim($_POST['sleeve_style']));
		$save['type_version'] = mysqli_real_escape_string ($dbc, trim($_POST['type_version']));
		$save['collar'] = mysqli_real_escape_string ($dbc, trim($_POST['collar']));

		$save['newproductcolor'] = mysqli_real_escape_string ($dbc, trim($_POST['newproductcolor']));
		$save['newproductcolor'] = mysqli_real_escape_string ($dbc, trim($_POST['newproductcolor']));
		$save['newproducttag'] = mysqli_real_escape_string ($dbc, trim($_POST['newproducttag']));
		$save['newproductinfo'] = mysqli_real_escape_string ($dbc, trim($_POST['newproductinfo']));
		//$save['newproductimg'] = mysqli_real_escape_string ($dbc, trim($_POST['newproductimg']));


		$flag = "Success";

		// add cur_price, pre_price, product_name, decription
		//$q = "UPDATE products SET (pre_price,cur_price,product_name,decription) VALUES ({$save['newproductpreprice']},{$save['newproductcurprice']},'"."{$save['newproductname']}','"."{$save['newproductinfo']}')";
		$q = "UPDATE products SET pre_price={$save['newproductpreprice']}, cur_price={$save['newproductcurprice']}, product_name='{$save['newproductname']}', decription='{$save['newproductinfo']}' WHERE product_id={$save['product_id']} LIMIT 1";
		$r = @mysqli_query($dbc, $q);

		// get product_id 
		//$q = "SELECT product_id FROM products ORDER BY product_id DESC LIMIT 1";
		//$r = mysqli_query($dbc, $q);
		//$product_id = mysqli_fetch_array($r, MYSQLI_NUM);

		// add color, size, tag
		$colorarray = explode('/', $save['newproductcolor']);
		$tagarray   = explode('/', $save['newproducttag']);

		//add color
		//delete color
		$q = "DELETE FROM product_id WHERE product_id={$save['product_id']}";
		$r = mysqli_query($dbc, $q);

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

			//$q = "INSERT INTO product_color (product_id, color_id) VALUES ({$product_id['0']},{$color_id['0']})";
			$q - "INSERT INTO product_color (product_id, color_id) VALUES ({$save['product_id']}, {$color_id['0']}) LIMIT 1";
			$r = mysqli_query($dbc, $q);
			if (mysqli_affected_rows($dbc) == 0)
				$flag = "Failed";
		}	

		//add tag 
		// delete tag
		$q = "DELETE FROM product_tag WHERE product_id={$save['product_id']}";
		$r = mysqli_query($dbc, $q);

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

			//$q = "INSERT INTO product_tag (product_id, tag_id) VALUES ({$product_id['0']},{$tag_id['0']})";
			$q = "INSERT INTO product_tag (product_id, tag_id) VALUES ({$save['product_id']}, {$tag_id['0']})";
			$r = mysqli_query($dbc, $q);
			if (mysqli_affected_rows($dbc) == 0)
				$flag = "Failed";
		}

		//add parameter
		//$q = "INSERT INTO parameter (product_id, style, material, sleeve_style, type_version, component, collar) VALUES ({$product_id['0']}, '{$save['style']}', '{$save['material']}', '{$save['sleeve_style']}', '{$save['type_version']}', '{$save['component']}', '{$save['collar']}')";
		$q = "UPDATE parameter SET style='{$save['style']}', material='{$save['material']}', sleeve_style='{$save['sleeve_style']}', type_version='{$save['type_version']}', component='{$save['component']}', collar='{$save['collar']}' WHERE product_id={$save['product_id']}";
		$r = mysqli_query($dbc, $q);

		//add size_detail
		// cloth
		// delete all the pre info
		$q = "DELETE FROM size_detail WHERE product_id={$save['product_id']}";
		$r = mysqli_query($dbc, $q);

		if ( $save['type'] == 'Y') {
			for ($i=0; $i < count($_POST['newproductsizedetail']); $i++) { 
				$q = "INSERT INTO size_detail (product_id, type, shoulder, breast, sleeve, cloth_len, waist, size_name, sex, collar) VALUES ({$save['product_id']},";
				$q .= "'" . mysqli_real_escape_string ($dbc, $_POST['newproductsizedetail'][$i]['type']) . "',";
				$q .= mysqli_real_escape_string ($dbc, $_POST['newproductsizedetail'][$i]['shoulder']) . ",";
				$q .= mysqli_real_escape_string ($dbc, $_POST['newproductsizedetail'][$i]['breast']) .",";
				$q .= mysqli_real_escape_string ($dbc, $_POST['newproductsizedetail'][$i]['sleeve']) .",";
				$q .= mysqli_real_escape_string ($dbc, $_POST['newproductsizedetail'][$i]['cloth_len']) .",";
				$q .= mysqli_real_escape_string ($dbc, $_POST['newproductsizedetail'][$i]['waist']) . ",";
				$q .= "'" . mysqli_real_escape_string ($dbc, $_POST['newproductsizedetail'][$i]['size_name']) . "',";
				$q .= "'" . mysqli_real_escape_string ($dbc, $_POST['newproductsizedetail'][$i]['sex']) . "',";
				$q .= mysqli_real_escape_string ($dbc, $_POST['newproductsizedetail'][$i]['collar']) . ")";
				$r = @mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));			
				if (mysqli_affected_rows($dbc) == 0)
					$flag = "Failed";
			}
		}
		else {
			for ($i=0; $i < count($_POST['newproductsizedetail']); $i++) { 
				$q = "INSERT INTO size_detail (product_id, type, waist, buttocks, leg, shank, trous_len, size_name, sex) VALUES ({$save['product_id']},";
				$q .= "'" . mysqli_real_escape_string ($dbc, $_POST['newproductsizedetail'][$i]['type']) . "',";
				$q .= mysqli_real_escape_string ($dbc, $_POST['newproductsizedetail'][$i]['waist']) . ",";
				$q .= mysqli_real_escape_string ($dbc, $_POST['newproductsizedetail'][$i]['buttocks']) . ",";				
				$q .= mysqli_real_escape_string ($dbc, $_POST['newproductsizedetail'][$i]['leg']) . ",";
				$q .= mysqli_real_escape_string ($dbc, $_POST['newproductsizedetail'][$i]['shank']) . ",";
				$q .= mysqli_real_escape_string ($dbc, $_POST['newproductsizedetail'][$i]['trous_len']) . ",";
				$q .= "'" . mysqli_real_escape_string ($dbc, $_POST['newproductsizedetail'][$i]['size_name']) . "',";
				$q .= "'" . mysqli_real_escape_string ($dbc, $_POST['newproductsizedetail'][$i]['sex']) . "')";
				$r = @mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));			
				if (mysqli_affected_rows($dbc) == 0)
					$flag = "Failed";
			}
		}

		// add imges
		if(!empty($_POST['newproductimg'])){ 
			for ($i=0; $i < count($_POST['newproductimg']); $i++) { 
				$q = "INSERT INTO imges (img_name, product_id, add_date) VALUES ('" . mysqli_real_escape_string ($dbc, $_POST['newproductimg'][$i]) . "',{$save['product_id']}, NOW())";
				$r = mysqli_query($dbc, $q);
				if (mysqli_affected_rows($dbc) == 0)
					$flag = "Failed";
			}
		}
		// set cover 
		/*
		$q = "UPDATE imges SET cover=1 WHERE product_id={$product_id['0']} ORDER BY add_date LIMIT 1";
		$r = mysqli_query($dbc, $q);

		if (mysqli_affected_rows($dbc) == 0)
			$flag = "Failed";
			*/
		echo $flag;
		mysqli_close($dbc);
	}
}
?>