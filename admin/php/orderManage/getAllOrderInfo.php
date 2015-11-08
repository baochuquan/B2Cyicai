<?php
//-------------------------------------------------------------
//for myorder.html
//$.post by getOrderInfo.js
//to get all the order infomation of a user
//-------------------------------------------------------------
require ('../../../includes/config.inc.php');

if (!isset($_COOKIE['username']) || $_COOKIE['userlevel'] != 1) {
	$url = BASE_URL .'index.html';
	header("Location: $url");
	exit();
}
else {
	if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.

		// Need the database connection:
		require (MYSQL);

		// to write order.json
		$q = "SELECT order_id, user_id, paystate, sendstate, user_info, total, order_date, addr, reciver, reci_phone FROM orders";
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		$orderscontent = '[';
		while($eachorder = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
			$orderscontent .= '{"user_id":' . $eachorder['user_id'] . 
							', "order_id":' . $eachorder['order_id'] . 
							', "paystate":"' . $eachorder['paystate'] .
							'", "sendstate":"' . $eachorder['sendstate'] .
							'", "user_info":"' . $eachorder['user_info'] . 
							'", "total":' . $eachorder['total'] .
							', "order_date":"' . $eachorder['order_date'] .
							'", "addr":"' . $eachorder['addr'] .
							'", "reciver":"' . $eachorder['reciver'] . 
							'", "reci_phone":"' . $eachorder['reci_phone'] . 
							'"},';
		}
		$orderscontent = substr($orderscontent, 0, strlen($orderscontent)-1);
		$orderscontent .= ']';
		$orderfile = fopen("../../json/orderManage/order.json", "w");
		fwrite($orderfile, $orderscontent);
		fclose($orderfile);

		// to write orderdetail
		$q = "SELECT oc_id, order_id, product_id, quantity, price, color, size, cmt_status, user_id, selected, product_name, img_name FROM order_content LEFT JOIN products USING(product_id) LEFT JOIN imges USING(product_id) WHERE cover='Y' AND cmt_status='Y'";
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));	
		$orderscontent = '[';
		while($eachorder = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
			$orderscontent .= '{"user_id":' . $eachorder['user_id'] . 
							', "order_id":' . $eachorder['order_id'] .
							', "oc_id":' . $eachorder['oc_id'] .
							', "product_id":' . $eachorder['product_id'] .
							', "quantity":' . $eachorder['quantity'] .
							', "price":' . $eachorder['price'] . 
							', "color":"' . $eachorder['color'] .
							'", "size":"' . $eachorder['size'] .
							'", "cmt_status":"' . $eachorder['cmt_status'] .
							'", "selected":"' . $eachorder['selected'] . 
							'", "product_name":"' . $eachorder['product_name'] . 
							'", "img_name":"' . $eachorder['img_name'] .
							'"},';
		}
		$orderscontent = substr($orderscontent, 0, strlen($orderscontent)-1);
		$orderscontent .= ']';

		$orderfile = fopen("../../json/orderManage/orderdetail.json", "w");
		fwrite($orderfile, $orderscontent);
		fclose($orderfile);
		echo "succcc";
	}
}
?>