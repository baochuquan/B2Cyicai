<?php
//this is the main page for the site.
//include the configuration file:
require ('includes/config.inc.php');

//set the page title and include the HTML header:
$page_title = '订单管理';
include ('includes/header.html');

//redirect if is not admin or unlogged in
if (!isset($_SESSION['username']) || ($_SESSION['userlevel'] == 0)) {
	$url = BASE_URL .'index.php';
	ob_end_clean();
	header("Location: $url");
	exit();
}
?>

<main role="main">
	<div class="container">
		<h1 class="page-header">订单管理</h1>
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#allorders" aria-controls="allorders" role="tab" data-toggle="tab">所有订单</a></li>
			<li role="presentation"><a href="#unpayed" aria-controls="unpayed" role="tab" data-toggle="tab">待付款</a></li>
			<li role="presentation"><a href="#unsend" aria-controls="unsend" role="tab" data-toggle="tab">待发货</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="allorders">				
					<?php
					// Need the database connection:
					require (MYSQL);

					// Define the query...
					$q = "SELECT order_date, order_id, username, total, reciver, reci_phone, paystate, sendstate, addr, user_info FROM orders INNER JOIN address USING(addr_id) INNER JOIN users ON address.user_id=users.user_id ORDER BY order_date ASC";
					$r = @mysqli_query($dbc, $q);

					// Fetch and print all the record
					while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
						echo '<div class="panel panel-info">
					  			<div class="panel-heading">
					    			<h3 class="panel-title"><span>' . $row['order_date'] . '</span>
					    								<span>订单号：' . $row['order_id'] . '</span>
					    								<span>客户：' . $row['username'] . '</span>
					    								<span>总金额：' . $row['total'] . '</span></h3>
					  			</div>
					  			<div class="panel-body">';
					  	echo '<table class="table table-striped">
			        			<thead>
				            		<tr>
					            		<th>产品</th>
							            <th>颜色</th>
							            <th>尺寸</th>
							            <th>单价</th>
							            <th>数量</th>
							            <th>金额</th>
						        	</tr>
					    		</thead>
					        	<tbody>';

					    // Define the detail query...
					    $q = "SELECT product_name, color, size, cur_price, quantity, price FROM orders INNER JOIN order_content USING(order_id) INNER JOIN products USING(product_id) WHERE order_id=" . $row['order_id'];
					    $r = @mysqli_query($dbc, $q);

					    // Fetch and print all the detail
					    while ($detail = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
					    	echo '<tr>
								<td>' . $detail['product_name'] . '</td>
								<td>' . $detail['color'] . '</td>
								<td>' . $detail['size'] . '</td>
								<td>' . $detail['cur_price'] . '</td>
								<td>' . $detail['quantity'] . '</td>
								<td>' . $detail['price'] . '</td>
							</tr>';
					    }
					  	echo '</tbody>
					  		</table>
					  		<div class="highlight">
					  			<p>
					  				<span>收件人：' . $row['reciver'] . '</span>
					  				<span>收件人联系方式：' . $row['reci_phone'] . '</span>';
					  	if ($row['paystate'] == 'Y') {
					  		echo '<span>已支付</span>';
					  	}
					  	else {
					  		echo '<span>未支付</span>';
					  	}
					  	if ($row['sendstate'] == 'Y') {
					  		echo '<span>已发货</span>';
					  	}
					  	else {
					  		echo '<span>未发货</span>';
					  	}

					  	echo '</p>
					  			<p>收件地址：' . $row['addr'] . '</p>
					  			<p>备注：' . $row['user_info'] . '</p>
					  		</div>
					  		</div>
							</div>';
					}
					mysqli_free_result($r);
					mysqli_close($dbc);
					?>
				</div>

				<div role="tabpanel" class="tab-pane" id="unpayed">
					<div>
						<h1>哈哈哈哈</h1>
					</div>
				</div>
				<!---->
				<div role="tabpanel" class="tab-pane" id="unsend">

				</div>

	</div>
</main>

<?php include ('includes/footer.html')  ?>