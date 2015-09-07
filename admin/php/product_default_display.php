
<?php
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

	$q = "SELECT product_id, product_name, pre_price, cur_price, SUM(quantity) AS sales FROM products LEFT JOIN order_content USING(product_id) GROUP BY (products.product_id) ORDER BY sales DESC";
	$r = @mysqli_query($dbc, $q);
	if (!$r) {
 		printf("Error: %s\n", mysqli_error($dbc));
 		exit();
 	}
 	$i = 0;
	while ($eachproduct = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		if (is_null($eachproduct['sales'])) {
			$eachproduct['sales'] = 0;
		}
		echo 	'<tr>
					<td>' . $eachproduct['product_id'] . '</td>
					<td><a href="#">' . $eachproduct['product_name'] . '</a></td>
					<td>' . $eachproduct['pre_price'] . '</td>
					<td>' . $eachproduct['cur_price'] . '</td>
					<td>' . $eachproduct['sales'] . '</td>
					<td>';
		//get all the color of each products
		$q = "SELECT color_name FROM products LEFT JOIN product_color USING(product_id) LEFT JOIN color USING(color_id) WHERE product_id=" . $eachproduct["product_id"];
		$rr = @mysqli_query($dbc, $q);
		while ($eachcolor = mysqli_fetch_array($rr, MYSQLI_ASSOC)) {
			echo 	$eachcolor['color_name'] . ',';
		}
		echo 			'</td>
					<td>';
		//get all the size of each products
		$q = "SELECT size_name FROM products LEFT JOIN product_size USING(product_id) LEFT JOIN size USING(size_id) WHERE product_id=" . $eachproduct["product_id"];
		$rr = @mysqli_query($dbc, $q);
		while ($eachsize = mysqli_fetch_array($rr, MYSQLI_ASSOC)) {
			echo 	$eachsize['size_name'] . ',';
		}
		echo 			'</td>
					<td>';
		//get all the tags of each products
		$q = "SELECT tag_name FROM products LEFT JOIN product_tag USING(product_id) LEFT JOIN tags USING(tag_id) WHERE product_id=" . $eachproduct["product_id"];
		$rr = @mysqli_query($dbc, $q);
		while ($eachtag = mysqli_fetch_array($rr, MYSQLI_ASSOC)) {
			echo 	$eachtag['tag_name'] . ',';
		}
		echo 			'</td>		
				 	<td><button type="button" class="btn btn-success" data-toggle="modal" data-target=".manuactivate" data-whatever="' . $eachproduct['product_id'] . '">编辑</button></td>
				 	<td><button type="button" class="btn btn-danger" data-toggle="modal" data-target=".manudelete" data-whatever="' . $eachproduct['product_id'] . '">删除</button></td>
				</tr>';
	} 
	mysqli_free_result($r);
	mysqli_free_result($rr);
	mysqli_close($dbc);
}
?>
