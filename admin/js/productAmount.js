//-------------------------------------------------------------
//for product_management.html
//to show the amount of all the products when default
//-------------------------------------------------------------
$(function(){
	var $target = $(".productsamount");
	//default query all the product
	$.post("admin/php/product_amount.php", { querytype: "all" }, function (data, textStatus) {	
		var $content = "产品总数量: " + data;
		$target.text($content);
	});
	//when query all the products
	$("#allquery").click(function(){
		$.post("admin/php/product_amount.php", { querytype: "all" }, function (data, textStatus) {
			var $content = "产品总数量: " + data;
			$target.text($content);
		});
	});
	//when query products by product name;
	$("#namequery").click(function(){
		var $value = $("#productname").val();
		$.post("admin/php/product_amount.php", { querytype: "name", keyword: $value }, function (data, textStatus) {
			var $content = '"' + $value + '"' + "相关结果数量: " + data;
			$target.text($content);
		});
	});
	//when query products by product tags;
	$("#tagquery").click(function(){
		var $value = $("#tagname").val();
		$.post("admin/php/product_amount.php", { querytype: "tag", keyword: $value }, function (data, textStatus) {
			var $content = '"' + $value + '"' + "相关结果数量: " + data;
			$target.text($content);
		});
	});
	//when query products by product price;
	$("#pricequery").click(function(){
		var $value = $("#priceregion").val();
		//alert("PRICE:"+$region);
		$.post("admin/php/product_amount.php", { querytype: "price", keyword: $value }, function (data, textStatus) {
			var $content = "相关结果数量: " + data;
			$target.text($content);
		});
	});
});