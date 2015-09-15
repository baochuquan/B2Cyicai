<?php
//-------------------------------------------------------------
//for product_management.html
//$.post by productAdd.js
//to get tag
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

	// Need the database connection:
	$q = "SELECT tag_id, tag_name FROM tags ORDER BY tag_id";
	$r = mysqli_query($dbc, $q);
	
	$tagcontent = '[';
	while($eachtag = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		$tagcontent .= '{"tag_id": ' . $eachtag['tag_id'] . ', "tag_name": "' . $eachtag['tag_name'] . '"},';
	}
	$tagcontent = substr($tagcontent, 0, strlen($tagcontent)-1);
	$tagcontent .= ']';

	$tagfile = fopen("../json/tag.json", "w");
	fwrite($tagfile, $tagcontent);
	fclose($tagfile);
}
?>