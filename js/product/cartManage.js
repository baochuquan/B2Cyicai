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
					cartcontent += '<div class="alert alert-warning mb20" role="alert" id="'+cartinfo['oc_id']+'">';
					cartcontent += 		'<div class="row">';
					cartcontent += 			'<div class="col-xs-3">';
					cartcontent +=				'<div class="checkbox margin-bottom-none margin-top-none">';
					cartcontent +=					'<label>';
					cartcontent +=						'<input type="checkbox">';
					cartcontent +=					'</label>';
					cartcontent +=					'<a href="product.html?product_id='+cartinfo['product_id']+'" target="_blank">';
					cartcontent +=						'<img src="img/productImg/'+cartinfo['img_name']+'" alt="img/productImg/'+cartinfo['img_name']+'" width="100px" height="100px" class="img-thumbnail" >';
					cartcontent +=					'</a>';
					cartcontent +=				'</div>';
					cartcontent +=			'</div>';
					cartcontent +=			'<div class="col-xs-2 text-center pt30">';
					cartcontent +=				'<a href="product.html?product_id='+cartinfo['product_id']+'" target="_blank">'+cartinfo['product_name']+'</a>';
					cartcontent +=			'</div>';
					cartcontent +=			'<div class="col-xs-1 text-center pt30">'+cartinfo['color']+'</div>';
					cartcontent +=			'<div class="col-xs-1 text-center pt30">'+cartinfo['size']+'</div>';
					cartcontent +=			'<div class="col-xs-1 text-center pt30">'+cartinfo['price']+'</div>';
					cartcontent +=			'<div class="col-xs-2 text-center pt15">';
					cartcontent +=				'<div class="mt10 mb10 orderamount">';
					cartcontent +=					'<input class="min" type="button" value="-" />';
					cartcontent +=					'<input class="amount" type="text" value="'+cartinfo['quantity']+'" style="width:50px" />';
					cartcontent +=					'<input class="add" type="button" value="+" />';
					cartcontent +=				'</div>';
					cartcontent +=			'</div>';
					cartcontent +=			'<div class="col-xs-1 text-center pt30">'+parseInt(cartinfo['quantity']) * parseInt(cartinfo['price'])+'</div>';
					cartcontent +=			'<div class="col-xs-1 text-center pt30"><button type="button" class="btn btn-danger btn-xs delete">删除</button></div>';
					cartcontent +=		'</div>';
					cartcontent +=	'</div>';
				});
				
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