//-------------------------------------------------------------
//for customer_management.html
//to calculate the user amount and show all the users' info
//-------------------------------------------------------------
$(function(){
	
	var PAGE = 20;
	$.get("admin/php/customer_amount.php", function (data, textStatus){
		var amount = Math.ceil(parseInt("10", data)/PAGE);
		var amountcontent = "<strong>" + data + "</strong>";
		$("#totalcustomeramount").append(amountcontent);
		
		var $target = $("#previoustag");
		for(var i = 1; i <= amount; i++){
			var content = '<li><a href="#" class="">' + i + '</a></li>'
			$target.after(content);
			$target = $target.next();
		}
		$.getScript("admin/js/customerPage.js");
	});
});