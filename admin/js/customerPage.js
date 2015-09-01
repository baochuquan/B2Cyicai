//-------------------------------------------------------------
//for customer_management.html
//to show the users' info of different pages
//-------------------------------------------------------------
$(function(){
	$('#pagination a').click(function(){
		var $target = $(this);
		$target.parent().siblings().removeClass("active");
		$target.parent().addClass("active");

		var $start = parseInt("10", $(this).text());
		$start = ($start - 1) * 20;
		$.post("admin/php/customer_page.php", { start: $start }, function (data, textStatus){
			$("#userdisplaytable").append(data);
		});
		//var pagenum = parseInt("10", $(this).children()text());
		//alert("NUM: ");
	});
});	
