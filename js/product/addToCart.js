//-------------------------------------------------------------
//for product.html
// add to shoppingcart
//-------------------------------------------------------------
$(function(){
	// check if is logged in
	$("#addtocart").click(function(){
		if($.cookie("username") && $.cookie("userlevel") && $.cookie("username") != "" && ($.cookie("userlevel")== 0 || $.cookie("userlevel") == 1)){
			// add a badge after the shopping cart
		}
		else {
			alert("请先登录!");
		}
	});
});