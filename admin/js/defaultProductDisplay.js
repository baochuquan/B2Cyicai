//-------------------------------------------------------------
//for product_management.html
//to calculate all the products amount when default
//-------------------------------------------------------------
$(function(){
	$.post("admin/php/product_default_display.php", function (data, textStatus) {
		//alert("DATA" + data);
		var $target = $(".productsdisplaytable");
		$target.append(data);
	});
});