//-------------------------------------------------------------
//for myorder.html
// to show the order infomation
//-------------------------------------------------------------
$(function(){
	$.post("admin/php/orderManage/getAllOrderInfo.php",{
		user_id: $.cookie("user_id"),
		user_level: $.cookie("user_level")
	},function (data, status){
		$.getScript("admin/json/orderManage/order.json",function (data){
			data = JSON.parse(data);
			if(data[0]['user_id'] == $.cookie('user_id')){
				$("#allorder").empty();
				var ordercontent = '';
				var todayorder = '';
				var unfinishedorder = '';
				$.each(data, function (index, orderinfo){
					//insert into page
					var strtemp = orderinfo['order_date'];
					ordercontent += '<div class="panel panel-warning">';
					ordercontent += 	'<div class="panel-heading">';
					ordercontent +=			'<div class="row">';
					ordercontent +=				'<div class="col-xs-3"><strong>日期: </strong>' + strtemp.substr(0,10) + '</div>';
					ordercontent +=				'<div class="col-xs-3"><strong>订单号: </strong>' + orderinfo['order_id'] + '</div>';
					//ordercontent +=				'<div class="col-xs-offset-5 col-xs-1"><a href="#"><i class="fa fa-trash-o fa-lg"></i></a></div>';
					ordercontent +=			'</div>';
					ordercontent +=		'</div>';
					ordercontent +=		'<div class="panel-body">';
					ordercontent +=			'<div class="row">';
					ordercontent +=				'<div class="col-xs-6" id="'+orderinfo['order_id']+'">';
					//ordercontent +=					'<div class="row">';
					//ordercontent +=						'<div class="col-xs-6"></div>';				//product
					//ordercontent +=						'<div class="col-xs-2 text-center"></div>';	//price
					//ordercontent +=						'<div class="col-xs-2 text-center"></div>';	//amount
					//ordercontent +=						'<div class="col-xs-2 text-center"></div>';	//total
					//ordercontent +=					'</div>';
					ordercontent +=				'</div>';
					ordercontent +=				'<div class="col-xs-2 text-center">'+orderinfo['total']+'</div>';			//pay

					if(orderinfo['paystate'] == 'N'){
						ordercontent +=			'<div class="col-xs-2 text-center">未付款</div>';			//state
					}
					else {
						ordercontent +=			'<div class="col-xs-2 text-center">已付款</div>';			//state
					}
					if(orderinfo['sendstate'] == 'N'){
						ordercontent +=			'<div class="col-xs-2 text-center"><p>等待发货</p>';			//state
					}
					else {
						ordercontent +=			'<div class="col-xs-2 text-center"><p>已发货</p>';			//state
					}

					if(orderinfo['paystate'] == 'N'){
						ordercontent +=				'<button type="button" class="btn btn-xs cancelorder">取消订单</button><br/><button type="button" class="btn btn-xs btn-danger payoff">立即付款</button></div>';			//operation
					}
					else {
						ordercontent +=				'<a href="#">查看订单详情</a></div>';			//operation
					}
					ordercontent +=			'</div>';
					ordercontent +=		'</div>';
					ordercontent +=		'<div class="panel-footer">';
					ordercontent +=			'<div class="row">';
					ordercontent +=				'<div class="col-xs-3"><strong>收件人: </strong>'+orderinfo['reciver']+'</div>';
					ordercontent +=				'<div class="col-xs-3"><strong>联系电话: </strong>'+orderinfo['reci_phone']+'</div>';
					ordercontent +=			'</div>';
					ordercontent +=			'<div class="row">';
					ordercontent +=				'<div class="col-xs-3"><strong>收件地址: </strong>'+orderinfo['addr']+'</div>';
					ordercontent +=			'</div>';
					ordercontent +=			'<div class="row">';
					ordercontent +=				'<div class="col-xs-3"><strong>备注: </strong>'+orderinfo['user_info']+'</div>';
					ordercontent +=			'</div>';
					ordercontent +=		'</div>';
					ordercontent +=	'</div>';
				});
				$("#allorder").append(ordercontent);
				//$.getScript("js/order/getOrderDetailInfo.js");
			}
		});
	});
});