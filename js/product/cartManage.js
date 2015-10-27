//-------------------------------------------------------------
//for shoppingcart.html
//to manage user's own shoppingcart
//-------------------------------------------------------------
$(function(){
	$.post("php/product/getcartinfo.php",{
		user_id: $.cookie("user_id")
	},
	function (data, index){
		$.getScript("json/shoppingcart/cartcontent.json",function (data){
			data = JSON.parse(data);
			if(data[0]['user_id'] == $.cookie('user_id')){
				$(".emptycart").addClass("hidden");
				$(".notemptycart").removeClass("hidden");

				var cartcontent = '';
				var totalprice = 0;
				var totalnum = 0;

				$.each(data, function (index, cartinfo){
					totalprice += parseInt(cartinfo['quantity']) * parseInt(cartinfo['price']);
					totalnum += parseInt(cartinfo['quantity']);
					cartcontent += '<div class="alert alert-warning mb20" role="alert" id="'+cartinfo['oc_id']+'"><div class="row"><div class="col-xs-3"><div class="checkbox margin-bottom-none margin-top-none"><label><input type="checkbox"></label><a href="product.html?product_id='+cartinfo['product_id']+'" target="_blank"><img src="img/productImg/'+cartinfo['img_name']+'" alt="img/productImg/'+cartinfo['img_name']+'" width="100px" height="100px" class="img-thumbnail" ></a></div></div><div class="col-xs-2 text-center pt30"><a href="product.html?product_id='+cartinfo['product_id']+'" target="_blank">'+cartinfo['product_name']+'</a></div><div class="col-xs-1 text-center pt30">'+cartinfo['color']+'</div><div class="col-xs-1 text-center pt30">'+cartinfo['size']+'</div><div class="col-xs-1 text-center pt30">'+cartinfo['price']+'</div><div class="col-xs-2 text-center pt15"><div class="mt10 mb10 orderamount"><input class="min" type="button" value="-" /><input class="amount" type="text" value="'+cartinfo['quantity']+'" style="width:50px" /><input class="add" type="button" value="+" /></div></div><div class="col-xs-1 text-center pt30">'+parseInt(cartinfo['quantity']) * parseInt(cartinfo['price'])+'</div><div class="col-xs-1 text-center pt30"><button type="button" class="btn btn-danger btn-xs delete">删除</button></div></div></div>';
				});
				//cartcontent += '<div class="alert alert-warning mb20" role="alert" id="'+cartinfo['oc_id']+'"><div class="row"><div class="col-xs-3"><div class="checkbox margin-bottom-none margin-top-none" id="selectall"><label><input type="checkbox" value=""></label><a href="product.html?product_id='+cartinfo['product_id']+'" target="_blank"><img src="img/productImg/'+cartinfo['img_name']+'" alt="img/productImg/'+cartinfo['img_name']+'" width="100px" height="100px" class="img-thumbnail" ></a></div></div><div class="col-xs-4 text-center pt30"><a href="product.html?product_id='+cartinfo['product_id']+'" target="_blank">'+cartinfo['product_name']+'</a></div><div class="col-xs-1 text-center pt30">'+cartinfo['price']+'</div><div class="col-xs-2 text-center pt15"><div class="mt10 mb10" id="orderamount"><input id="min" type="button" value="-" /><input id="amount" type="text" value="'+cartinfo['quantity']+'" style="width:50px" /><input id="add" type="button" value="+" /></div></div><div class="col-xs-1 text-center pt30">'+parseInt(cartinfo['quantity']) * parseInt(cartinfo['price'])+'</div><div class="col-xs-1 text-center pt30"><button type="button" class="btn btn-danger btn-xs">删除</button></div></div></div>';
				
				$(".notemptycart .panel-body").prepend(cartcontent);
				$(".notemptycart .checkbox :input").prop("checked",'true');

				// calculate the total price & quantity
				$("#totalquantity").text(totalnum);
				$("#totalprice").text(totalprice);
				$("#actualtotalprice").text(totalprice);
			}
		});
		$.getScript("js/product/cartManageDetail.js");

	});
});	