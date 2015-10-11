<?php
require ('../../../includes/config.inc.php');
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
		switch ($_POST['querytype']) {
			case 'all':
				// -----------------------------------------show all the products--------------------------------------------
				$q = "SELECT product_id, product_name, pre_price, cur_price, SUM(quantity) AS sales FROM products LEFT JOIN order_content USING(product_id) GROUP BY (products.product_id) ORDER BY sales DESC";
				break;
			case 'name':
				$q = "SELECT product_id, product_name, pre_price, cur_price, SUM(quantity) AS sales FROM products LEFT JOIN order_content USING(product_id) WHERE product_name LIKE '%" . $_POST['keyword'] . "%' GROUP BY (products.product_id) ORDER BY sales DESC";
				break;
			case 'tag':	
				$q = "SELECT product_id, product_name, pre_price, cur_price, SUM(quantity) AS sales FROM products LEFT JOIN order_content USING(product_id) LEFT JOIN product_tag USING(product_id) LEFT JOIN tags USING(tag_id) WHERE tag_name LIKE '%" . $_POST['keyword'] . "%' GROUP BY (products.product_id) ORDER BY sales DESC";		
				break;
			case 'price':
				if ($_POST['keyword'] == 200) {
					$q = "SELECT product_id, product_name, pre_price, cur_price, SUM(quantity) AS sales FROM products LEFT JOIN order_content USING(product_id) WHERE cur_price BETWEEN 200.00 AND 300.00 GROUP BY (products.product_id) ORDER BY sales DESC";
				}
				elseif ($_POST['keyword'] == 300) {
					$q = "SELECT product_id, product_name, pre_price, cur_price, SUM(quantity) AS sales FROM products LEFT JOIN order_content USING(product_id) WHERE cur_price >= 300.00 GROUP BY (products.product_id) ORDER BY sales DESC";
				}
				else {
					$uplimit = $_POST['keyword'] + 50.00;
					$q = "SELECT product_id, product_name, pre_price, cur_price, SUM(quantity) AS sales FROM products LEFT JOIN order_content USING(product_id) WHERE cur_price BETWEEN " . $_POST['keyword'] . " AND " . $uplimit ." GROUP BY (products.product_id) ORDER BY sales DESC";
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

	 	if (mysqli_affected_rows($dbc) != 0) {
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
				$i = 0;
				while ($eachcolor = mysqli_fetch_array($rr, MYSQLI_ASSOC)) {
					if($i == 0)
						echo 	$eachcolor['color_name'];
					else
						echo 	"/" . $eachcolor['color_name'];
					$i++;
				}
				echo			'</td>
							<td>';

				//get all the size of each products
				$q = "SELECT size_name FROM size_detail WHERE product_id=" . $eachproduct["product_id"];
				$rr = @mysqli_query($dbc, $q);
				$i = 0;
				while ($eachsize = mysqli_fetch_array($rr, MYSQLI_ASSOC)) {
					if ($i == 0)
						echo 	$eachsize['size_name'];
					else
						echo 	"/" . $eachsize['size_name'];
					$i++;
				}
				echo 			'</td>
							<td>';

				//get all the tags of each products
				$q = "SELECT tag_name FROM products LEFT JOIN product_tag USING(product_id) LEFT JOIN tags USING(tag_id) WHERE product_id=" . $eachproduct["product_id"];
				$rr = @mysqli_query($dbc, $q);
				$i = 0;
				while ($eachtag = mysqli_fetch_array($rr, MYSQLI_ASSOC)) {
					if ($i == 0)
						echo 	$eachtag['tag_name'];
					else
						echo 	"/" . $eachtag['tag_name'];
					$i++;
				}										
				echo			'</td>
							<td><a role="button" class="btn btn-success btn-xs" href="product_edit.html?product_id=' . $eachproduct['product_id'] . '" target="_blank">编辑</a></td>
							<td><button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target=".manudeleteproduct" data-whatever="' . $eachproduct['product_id'] . '">删除</button></td>
						</tr>';
			} 	
			mysqli_free_result($r);
			mysqli_free_result($rr);
		}
		else { 
			//no result
		}
	}	
	mysqli_close($dbc);
}
?>