//-------------------------------------------------------------
//for commitorder.html
//to get the user address & unfinished order info
//-------------------------------------------------------------
$(function(){
	$.post("php/commit/getAddress.php",{
		user_id: $.cookie('user_id')
	},
	function (data, status){
		$.getScript("json/commit/address.json",function (data){
			data = JSON.parse(data);
			if(data[0]['user_id'] != $.cookie('user_id')){
				$("#addaddress").trigger("click");
			}
			else {
				$(".haveaddress").removeClass("hidden");
				var addrcontent = '';

				$.each(data, function (index, addrinfo){
					if(addrinfo['default_addr'] == 'Y') {
						addrcontent += 	'<div class="row alert alert-danger">';
					}
					else {
						addrcontent +=	'<div class="row">';
					}
					addrcontent += 		'<div class="col-xs-2 pt10 text-center" style="color:#ff0000">';
					if(addrinfo['default_addr'] == 'Y') {
						addrcontent += '<strong><i class="fa fa-map-marker fa-lg"></i> 寄送至 </strong>';
					}
					addrcontent += 		'</div>';
					addrcontent += 		'<div class="radio col-xs-10">';
					addrcontent += 			'<label>';
					if(addrinfo['default_addr'] == 'Y'){
						addrcontent += 				'<input type="radio" name="optionsRadios" value="'+ addrinfo['addr_id'] +'" checked>';
					}
					else {
						addrcontent += 				'<input type="radio" name="optionsRadios" value="'+ addrinfo['addr_id'] +'">';
					}
					addrcontent +=				'<span class="addr">'+addrinfo['addr'] + '</span>（<span class="reciver">' +addrinfo['reciver']+ '</span>）<span class="text-muted reci-phone">' + addrinfo['reci_phone'] +'</span>';
					addrcontent +=			'</label>';
					addrcontent +=		'</div>';
					addrcontent +=	'</div>';
				});

				$(".haveaddress .addressinfo").append(addrcontent);
				// addtional operation
				$.getScript("js/commit/addrOperation.js");
				
				// check addrinfo before commit order
				if($(".haveaddress .addressinfo").children().length == 0){
					$("#commitorder").addClass("disabled");
				}
				else {
					$("#commitorder").removeClass("disabled");
				}

				// deal when click commit order
				$.getScript("js/commit/commitOrder.js");
			}
		});
	});

	$.post("php/commit/getOrder.php",{
		user_id: $.cookie('user_id')
	},
	function (dataa, status){

		$.getScript("json/commit/cartinfo.json",function (data){
			data = JSON.parse(data);
			if(data[0]['user_id'] == $.cookie('user_id')){

				var cartcontent = '';
				var totalprice = 0;
				var totalnum = 0;

				$.each(data, function (index, cartinfo){
					cartcontent += '<div class="alert alert-warning mb20 order-content-name" role="alert" id="'+cartinfo['oc_id']+'">';
					cartcontent += 		'<div class="row">';
					cartcontent += 			'<div class="col-xs-3">';
					cartcontent +=				'<div class="margin-bottom-none margin-top-none">';
					cartcontent +=					'<a href="product.html?product_id='+cartinfo['product_id']+'" target="_blank">';
					cartcontent +=						'<img src="img/productImg/'+cartinfo['img_name']+'" alt="img/productImg/'+cartinfo['img_name']+'" width="100px" height="100px" class="img-thumbnail" >';
					cartcontent +=					'</a>';
					cartcontent +=				'</div>';
					cartcontent +=			'</div>';
					cartcontent +=			'<div class="col-xs-3 pt30">';
					cartcontent +=				'<a href="product.html?product_id='+cartinfo['product_id']+'" target="_blank">'+cartinfo['product_name']+'</a>';
					cartcontent +=			'</div>';
					cartcontent +=			'<div class="col-xs-1 text-center pt30">'+cartinfo['color']+'</div>';
					cartcontent +=			'<div class="col-xs-1 text-center pt30">'+cartinfo['size']+'</div>';
					cartcontent +=			'<div class="col-xs-1 text-center pt30">'+cartinfo['price']+'</div>';
					cartcontent +=			'<div class="col-xs-2 text-center pt30">'+cartinfo['quantity']+'</div>';
					cartcontent +=			'<div class="col-xs-1 text-center pt30">'+parseInt(cartinfo['quantity']) * parseInt(cartinfo['price'])+'</div>';
					cartcontent +=		'</div>';
					cartcontent +=	'</div>';
					totalprice += parseInt(cartinfo['quantity']) * parseInt(cartinfo['price']);
					totalnum += parseInt(cartinfo['quantity']);
				});
				$(".confirmorder .panel-body").prepend(cartcontent);
				$("#totalquantity").text(totalnum);
				$("#totalprice").text(totalprice);
				$("#actualtotalprice").text(totalprice+20);

				$(".confirmorder .panel-body .hidden").removeClass("hidden");
			}
		});
	});
	
});