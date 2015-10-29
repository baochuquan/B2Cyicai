//-------------------------------------------------------------
//for commitorder.html
//to get the user address & unfinished order info
//-------------------------------------------------------------
$(function(){
	$.post("php/commit/getAddress.php",{
		user_id: $.cookie('user_id')
	},
	function (data, status){
		$.getScript("json/commit/address.json",function (data){
			data = JSON.parse(data);
			if(data[0]['user_id'] != $.cookie('user_id')){
				$("#addaddress").trigger("click");
			}
			else {
				$(".haveaddress").removeClass("hidden");
			}
		});
	});
});