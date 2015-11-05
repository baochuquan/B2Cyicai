//-------------------------------------------------------------
//for myorder.html
// getScript by getOrderInfo.js
// to show the order infomation
//-------------------------------------------------------------
$(function(){

	$.getScript("json/order/orderdetail.json",function (data){
		data = JSON.parse(data);
		if(data[0]['user_id'] == $.cookie('user_id')){
			$.each(data, function (index, orderinfo){
				var ordercontent = '';
				ordercontent +=	'<div class="row mb20">';
				ordercontent +=		'<div class="col-xs-6 media"><div class="media-left media-middle"><a href="product.html?product_id='+orderinfo['product_id']+'" target="_blank"><img class="img-thumbnail" src="img/productImg/'+orderinfo['img_name']+'" width="100px" height="100px"></img></a></div><div class="media-body"><a href="product.html?product_id='+orderinfo['product_id']+'" target="_blank"><h4 class="media-heading">'+orderinfo['product_name']+'</h4></a><p>尺码: '+orderinfo['size']+' | 颜色:'+orderinfo['color']+'</p></div></div>';				//product
				ordercontent +=		'<div class="col-xs-2 text-center">'+orderinfo['price']+'</div>';	//price
				ordercontent +=		'<div class="col-xs-2 text-center">'+orderinfo['quantity']+'</div>';	//amount
				ordercontent +=		'<div class="col-xs-2 text-center">'+parseInt(orderinfo['price']) * parseInt(orderinfo['quantity'])+'</div>';	//total
				ordercontent +=	'</div>';
				var temp = "#product" + orderinfo['order_id'];
				$(temp).append(ordercontent); 
			});
		}
	});
});
