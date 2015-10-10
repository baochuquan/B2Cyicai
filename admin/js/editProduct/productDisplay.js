//-------------------------------------------------------------
//for product_management.html
//to calculate all the products amount when default
//-------------------------------------------------------------
$(function(){
	var $target = $(".productsdisplaytable");

	//default to show all the products 
	$.post("admin/php/product_display.php", { querytype: "all" }, function (data, textStatus) {
		//alert("DATA" + data);
		$target.html(data);
		$.getScript("admin/js/manudeleteproduct.js");
		$.getScript("admin/js/manueditproduct.js");
	});

	//click the allquery button to show all the products
	$("#allquery").click(function (){
		$.post("admin/php/product_display.php", { querytype: "all" }, function (data, textStatus) {
			$target.html(data);
			$.getScript("admin/js/manudeleteproduct.js");
			$.getScript("admin/js/manueditproduct.js");
		});
	});

	//when query products by product name;
	$("#namequery").click(function(){
		var $value = $("#productname").val();
		$.post("admin/php/product_display.php", { querytype: "name", keyword: $value }, function (data, textStatus){
			$target.html(data);
			$.getScript("admin/js/manudeleteproduct.js");
			$.getScript("admin/js/manueditproduct.js");
		});
	});

	//when query products by product tags;
	$("#tagquery").click(function(){
		var $value = $("#tagname").val();
		$.post("admin/php/product_display.php", { querytype: "tag", keyword: $value }, function (data, textStatus){
			$target.html(data);
			$.getScript("admin/js/manudeleteproduct.js");
			$.getScript("admin/js/manueditproduct.js");
		});	
	});

	//when query products by product price;
	$("#pricequery").click(function(){
		var $value = $("#priceregion").val();
		$.post("admin/php/product_display.php", { querytype: "price", keyword: $value }, function (data, textStatus){
			$target.html(data);
			$.getScript("admin/js/manudeleteproduct.js");
			$.getScript("admin/js/manueditproduct.js");
		});
	});
});