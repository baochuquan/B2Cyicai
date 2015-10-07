//-------------------------------------------------------------
//for index.html
// to add show all the products' cover
//-------------------------------------------------------------
$(document).ready(function() {
	$.post("php/get_all_products.php",function (dataa, status){
		//alert("heeh");
		$.getScript("json/products.json",function (data){

			data = JSON.parse(data);
					
			$("#productscontainer").empty();
			var content = '';
			$.each( data, function (index, productinfo){
				content += '<div class="hreview thumbnail col-xs-12 col-sm-6 col-md-4 col-lg-3 pl10 pr10"><div class="product-wrapper"><a href="product.html?product_id=' + productinfo['product_id'] + '"><img src=img/productImg/' + productinfo['img_name'] + ' alt="' + productinfo['img_name'] + '"></a><div class="caption"><h5><a href="product.html?product_id=' + productinfo['product_id'] + '">' + productinfo['product_name'] + '</a></h5><p>' + productinfo['decription'] + '</p><p><a href="product.html?product_id=' + productinfo['product_id'] + '" class="btn btn-primary btn-xs" role="button">详细...</a></p></div></div></div>'
			});
			$("#productscontainer").append(content);

			// load plugin masonry.js from waterfall style button
			$.getScript("js/masonry.js");
		});
	});
});