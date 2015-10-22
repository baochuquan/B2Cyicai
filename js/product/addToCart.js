//-------------------------------------------------------------
//for product.html
// getScript by generateProduct.js
// to handle when click addtocart
//-------------------------------------------------------------
$(function(){
	// check if is logged in
	$("button#addtocart").click(function(){
		if($.cookie("username") && $.cookie("userlevel") && $.cookie("username") != "" && ($.cookie("userlevel")== 0 || $.cookie("userlevel") == 1)){
			$.post("php/product/addtocart.php",{
		
				user_id: $.cookie("user_id"),
				product_id: $("#productname h3").text(),
				product_name: $("#productname strong").text(),
				curprice: $("#curprice").text(),
				orderamount: $("#orderamount :input").eq(1).val(),
				productcolor: $("#productcolor :checked").parent().text(),
				size: $("#productdetail :checked").val()
			},
			function (data, index){
				// add a badge after the shopping cart
				alert("成功加入购物车");
				$(".badge").text(parseInt($(".badge").text()) + 1);
			});
		}
		else {
			alert("请先登录!");
			window.location.assign("login.html");
		}
	});
});