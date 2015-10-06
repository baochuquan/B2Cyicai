//-------------------------------------------------------------
//for myaccount.html
// to add address
//-------------------------------------------------------------
$(document).ready(function(){
	$.post("php/get_addr.php", { user_id: $.cookie()['user_id'] }, function (dataa, status){
		$.getScript("json/address.json",function (data){
			data = JSON.parse(data);
					
			$("#defaultaddress").empty();
			$("#alladdress").empty();
			var content1 = '';	
			var content2 = '<p>暂未设置</p>';
			$.each( data, function (index, addrinfo){
				if(addrinfo['default_addr'] == "Y"){
					content1 += '<div class="radio"><label><input type="radio" name="optionsRadios" id="optionsRadios' + index + '" value="' + addrinfo['addr_id'] + '" checked="checked"><div> 地址: ' + addrinfo['addr'] + '</div><div> 收件人: ' + addrinfo['reciver'] + '</div><div> 联系方式: ' + addrinfo['reci_phone'] + '</div></label></div>';
					content2 = '<p><div> 地址: ' + addrinfo['addr'] + '</div><div> 收件人: ' + addrinfo['reciver'] + '</div><div> 联系方式: ' + addrinfo['reci_phone'] + '</div></p>';
				}
				else {
					content1 += '<div class="radio"><label><input type="radio" name="optionsRadios" id="optionsRadios' + index + '" value="' + addrinfo['addr_id'] + '"><div> 地址: ' + addrinfo['addr'] + '</div><div> 收件人: ' + addrinfo['reciver'] + '</div><div> 联系方式: ' + addrinfo['reci_phone'] + '</div></label></div>';
				}
			});
			content1 += '<button type="button" class="btn btn-primary" id="setdefaultaddr">设置为默认地址</button>';
			$("#alladdress").append(content1);
			$("#defaultaddress").append(content2);

			// when click the "设置默认地址" button
			$.getScript("js/setDefaultAddr.js");
		});
	});
});
