//-------------------------------------------------------------
//for commitorder.html
// getScript by getCommitInfo.js
// to commit the order info
//-------------------------------------------------------------
$(function(){
	$("#commitorder").click(function (){
		var $oc_id = [];
		for(var i = 0; i < $(".order-content-name").length; i++){
			var $temp = $($(".order-content-name")[i]).attr("id");
			$oc_id.push({id:$temp});	
		}

		$.post("php/commit/commitOrder.php",{
			user_id: $.cookie("user_id"),
			total: $("#actualtotalprice").text(),
			user_info: $("#customermessage").val(),
			addr: $(".haveaddress .addressinfo :input:checked").parent().find(".addr").text(),
			reciver: $(".haveaddress .addressinfo :input:checked").parent().find(".reciver").text(),
			reci_phone: $(".haveaddress .addressinfo :input:checked").parent().find(".reci-phone").text(),
			oc_id: $oc_id
		},
		function (data, status){
			if(data == 'Success'){
				alert("接下来需要创建支付宝连接");
			}
		});
	});
});