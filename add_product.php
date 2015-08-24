<?php
ob_start();
session_start();
//this is the main page for the site.
//include the configuration file:
require ('includes/config.inc.php');

//redirect if is not admin or unlogged in
if (!isset($_SESSION['username']) || ($_SESSION['userlevel'] == 0)) {
	$url = BASE_URL .'index.php';
	//ob_end_clean();
	header("Location: $url");
	exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.
	require(MYSQL);

	if(!empty($_POST['product_name'])) {
		$pn = trim($_POST['product_name']);
	}
	if(is_numeric($_POST['pre_price']) && ($_POST['pre_price'] > 0)) {
		$pp = (float)$_POST['pre_price'];
	}
	if(is_numeric($_POST['cur_price']) && ($_POST['cur_price'] > 0)) {
		$cp = (float)$_POST['cur_price'];
	}
	if(!empty($_POST['add_tag'])) {
		$pt = strtok(trim($_POST['add_tag']), ';');
	}
	if(!empty($_POST['add_color'])) {
		$pc = strtok(trim($_POST['add_color']), ';');
	}
	$pd = (!empty($_POST['description'])) ? trim($_POST['description']) : NULL;
	//check for uploaded file:
	$i = 0;
	//print_r($_FILES["myfile"]["tmp_name"][2]);
	
	if(is_uploaded_file($_FILES['myfile']['tmp_name'][0]) { 
		//create a temp file name:
		$temp = '../uploads/' . md5($_FILES['myfile']['name'][$i]);

		//move the file over:
		if (move_uploaded_file($_FILES['myfile']['tmp_name'][$i], $temp)) {
			$pi[$i] = $_FILES['myfile']['name'][$i];
		}
		$i++;
	}
	$q = "INSERT INTO products (pre_price, cur_price, product_name, decription) VALUES ('$pp','$cp','$pn','$pd')";
	$r = mysqli_query($dbc, $q);
	mysqli_close($dbc);
}

?>