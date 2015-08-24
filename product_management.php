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
			<li role="presentation" class="active"><a href="#allproduct" aria-controls="allproduct" role="tab" data-toggle="tab">所有产品</a></li>
			<li role="presentation"><a href="#addproduct" aria-controls="addproduct" role="tab" data-toggle="tab">添加产品</a></li>
			<li role="presentation"><a href="#editproduct" aria-controls="editproduct" role="tab" data-toggle="tab">编辑产品</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-content">
				<!--show allt the products-->
				<div role="tabpanel" class="tab-pane active" id="allproduct">
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
				<div role="tabpanel" class="tab-pane" id="addproduct">
					<div class="jumbotron mt20">
						<form class="form-horizontal" enctype="multipart/form-data" action="add_product.php" method="post">
							<fieldset>
								<div class="form-group">
							    	<label for="ProductName" class="col-xs-2 control-label">产品名称</label>
							    	<div class="col-xs-8">
							    		<input type="text" class="form-control" id="ProductName" name="product_name" placeholder="产品名称">
							    	</div>
							  	</div>
						    	<div class="form-group">
								    <label for="PrePrice" class="col-xs-2 control-label">原价(元)</label>
								    <div class="col-xs-3">
								    	<input type="text" class="form-control" id="PrePrice" name="pre_price" placeholder="原价">
								    </div>
								    <label for="CurPrice" class="col-xs-2 control-label">现价(元)</label>
								   	<div class="col-xs-3">
								    	<input type="text" class="form-control" id="CurPrice" name="cur_price" placeholder="现价">
								    </div>
								</div>';
	echo '
								<div class="form-group">
									<label for="AddTag" class="col-xs-2 control-label">添加标签</label>
									<div class="col-xs-8">
										<input type="text" class="form-control" id="AddTag" name="add_tag" placeholder="多个标签之间用分号隔开，如：男装;短袖;">
									</div>
								</div>
								<div class="form-group">
									<label for="AddColor" class="col-xs-2 control-label">添加颜色</label>
									<div class="col-xs-8">
										<input type="text" class="form-control" id="AddColor" name="add_color" placeholder="多种颜色之间用分号隔开，如：黑色;白色;">
									</div>
								</div>
								<div class="form-group">
									<label for="Description" class="col-xs-2 control-label">产品介绍</label>
									<div class="col-xs-8">
										<textarea class="form-control" rows="5" id="Description" name="description"></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-2 control-label">添加产品图片</label>
									<div class="col-xs-8">
										<input type="hidden" name="MAX_FILE_SIZE" value="1000000">
										选择图片1：<input type="file" name="myfile[]"><br/>
										选择图片2：<input type="file" name="myfile[]"><br/>
										选择图片3：<input type="file" name="myfile[]"><br/>
										选择图片4：<input type="file" name="myfile[]"><br/>
									</div>	
								</div>';
	echo '						
								<div class="form-group">
									<div class="col-xs-2 col-xs-offset-2">
										<button type="submit" class="btn btn-primary">确定</button>				  		
									</div>
								</div>
						  	</fieldset>
						</form>
					</div>
				</div>

				<div role="tabpanel" class="tab-pane" id="editproduct">
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