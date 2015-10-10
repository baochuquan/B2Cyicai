//-------------------------------------------------------------
//for myaccount.html
// to select and set a default address
// .getScript by showAddress.js
//-------------------------------------------------------------
$(document).ready(function(){
	$("#setdefaultaddr").click(function(){
		//alert("button");
		$.post("php/address/set_default_addr.php", { user_id: $.cookie()['user_id'], addr_id: $("input[name='optionsRadios']:checked").val() }, function (data, status){
			//alert("DATA: "+data);
			if(data == "Success"){
				alert("设置成功!");
				window.location.assign('myaccount.html');
			}
			else {
				alert("设置失败!");
				window.location.assign('myaccount.html');
			}	
		});
	});
});