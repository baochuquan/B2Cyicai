<?php
//this is the main page for the site.
//include the configuration file:
require ('includes/config.inc.php');

//set the page title and include the HTML header:
$page_title = '产品管理';
include ('includes/header.html');

//redirect if is not admin or unlogged in
if (!isset($_SESSION['username']) || ($_SESSION['userlevel'] == 0)) {
	$url = BASE_URL .'index.php';
	ob_end_clean();
	header("Location: $url");
	exit();
}
?>

<main role='main'>
	<div class="container">
		<h1 class="page-header">产品管理</h1>
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#allusers" aria-controls="allusers" role="tab" data-toggle="tab">所有产品</a></li>
			<li role="presentation"><a href="#adduser" aria-controls="adduser" role="tab" data-toggle="tab">添加产品</a></li>
			<li role="presentation"><a href="#edituser" aria-controls="edituser" role="tab" data-toggle="tab">编辑产品</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-content">
				<!--show allt the products-->
				<div role="tabpanel" class="tab-pane active" id="allusers">
					<div class="panel panel-info mt20">
						<div class="panel-heading">
<?php
	// Need the database connection:
	require (MYSQL);

	// Define the query...
	$q = "SELECT COUNT(product_id) FROM products";
	$r = @mysqli_query($dbc, $q);
	// Get the mount of registered users
	$productmount = mysqli_fetch_array($r, MYSQLI_NUM);
	echo '
							<h3 class="panel-title">产品总量:' . $productmount[0] . '</h3>
						</div>
					  	<div class="panel-body">
					  		<table class="table table-striped">
								<thead>
	            					<tr>
					            		<th>产品编号</th>
							            <th>产品ID</th>
							            <th>产品名</th>
							            <th>原价</th>
							            <th>现价</th>
							            <th>销量</th>
						        	</tr>
					    		</thead>
						    	<tbody>';
	// Fetch all the information of products;
	$q = "SELECT product_id, product_name, pre_price, cur_price, SUM(quantity) AS sales FROM products LEFT JOIN order_content USING(product_id) GROUP BY (products.product_id) ORDER BY sales DESC";
	$r = @mysqli_query($dbc, $q);	
	$i = 1;
	while ($productdata = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		echo '
									<tr>
										<td>' . $i . '</td>
										<td>' . $productdata['product_id'] . '</td>
										<td><a href="product_common.php?productid= ' . $productdata['product_id'] . '">' . $productdata['product_name'] . '</a></td>
										<td>' . $productdata['pre_price'] . '</td>
										<td>' . $productdata['cur_price'] . '</td>
										<td>';
		if ($productdata['sales']) {
			echo 								$productdata['sales'] . '</td>
									</tr>';
		}
		else {
			echo 								'0</td>
									</tr>';
		}
		$i++;
	}
	echo '
								</tbody>
							</table>
					  	</div>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="adduser">
					<div class="jumbotron mt20">
						<form class="form-horizontal" action="add_product.php" method="post">
							<div class="form-group">
						    	<label for="ProductName" class="col-xs-2 control-label">产品名称</label>
						    	<div class="col-xs-8">
						    		<input type="text" class="form-control" id="ProductName" name="product_name" placeholder="产品名称">
						    	</div>
						  	</div>
					    	<div class="form-group">
							    <label for="PrePrice" class="col-xs-2 control-label">原价(元)</label>
							    <div class="col-xs-3">
							    	<input type="text" class="form-control" id="PrePrice" placeholder="原价">
							    </div>
							    <label for="CurPrice" class="col-xs-2 control-label">现价(元)</label>
							   	<div class="col-xs-3">
							    	<input type="text" class="form-control" id="CurPrice" placeholder="现价">
							    </div>
							</div>

							<fieldset class="col-xs-4 col-xs-offset-4">
								<legend>上传产品图片</legend>
								<p>
									<b>选择文件(支持多文件)</b>
									<input type="file" multipe="multipe" name="upload">
								</p>
							</fieldset>
						  	<button type="submit" class="btn btn-default">Submit</button>
						</form>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="edituser">
					<div>
						<h1>喝喝喝</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>';
?>

<?php include ('includes/footer.html')  ?>