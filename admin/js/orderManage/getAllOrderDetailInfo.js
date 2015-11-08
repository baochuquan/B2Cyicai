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
				ordercontent +=		'<div class="col-xs-6 media"><div class="media-left media-middle"><a href="product.html?product_id='+orderinfo['product_id']+'" target="_blank"><img src="img/productImg/'+orderinfo['img_name']+'" width="100px" height="100px" class="media-object img-thumbnail"></a></div><div class="media-body"><a href="product.html?product_id='+orderinfo['product_id']+'" target="_blank"><h4 class="media-heading">'+orderinfo['product_name']+'</h4></a><p>尺码: '+orderinfo['size']+' | 颜色:'+orderinfo['color']+'</p></div></div>';				//product
				ordercontent +=		'<div class="col-xs-2 text-center">'+orderinfo['price']+'</div>';	//price
				ordercontent +=		'<div class="col-xs-2 text-center">'+orderinfo['quantity']+'</div>';	//amount
				ordercontent +=		'<div class="col-xs-2 text-center">'+parseInt(orderinfo['price']) * parseInt(orderinfo['quantity'])+'</div>';	//total
				ordercontent +=	'</div>';
				var temp = "#" + orderinfo['order_id'];
				$(temp).append(ordercontent); 
			});
		}
	});
});

$(function(){
	$(".cancelorder").click(function(){
		if(confirm("请确认是否删除该订单？")){
			$(this).parent().parent().parent().parent().addClass("hidden");
			$.post("php/order/deleteOrder.php",{
				user_id: $.cookie("user_id"),
				order_id: $(this).parent().parent().children().eq(0).attr("id")
			},function(){
				alert("成功删除订单");
			});
		}
	});
	$(".payoff").click(function(){
		var total='';
		total = $(this).parent().parent().children().eq(1).text();
		alert("接下来要创建支付宝并支付"+total+"元");
	});
});
