//-------------------------------------------------------------
//for myorder.html
// to show the order infomation
//-------------------------------------------------------------
$(function(){
	$.post("php/order/getOrderInfo.php",{
		user_id: $.cookie("user_id")
	},function (data, status){
		$.getScript("json/order/order.json",function (data){
			data = JSON.parse(data);
			if(data[0]['user_id'] == $.cookie('user_id')){
				$("#allorder").empty();
				var ordercontent = '';
				$.each(data, function (index, addrinfo){
					//insert into page
				});
			}
		});
	});
});