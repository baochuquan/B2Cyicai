//-------------------------------------------------------------
//for product.html?product_id=?
// to show the detail information of each product
//-------------------------------------------------------------
$(document).ready(function(){
	//-------------------------------------------------------------
	//decode the encode of urlencode(PHP)
	//-------------------------------------------------------------
	
	(function($) {
		$.URLdecode = function (str) {
		    var ret = "";
		    for(var i=0;i<str.length;i++) {
		        var chr = str.charAt(i);
		        if(chr == "+") {	// + present space
		            ret += " ";
		        }else if(chr == "%") {
		            var asc = str.substring(i+1,i+3);
		            if(parseInt("0x"+asc)>0x7f) {	//ascii not exist
		                ret += decodeURI("%"+ str.substring(i+1,i+9));
		                i += 8;
		            }else {
		                ret += String.fromCharCode(parseInt("0x"+asc));
		                i += 2;
		            }
		        }else {
		            ret += chr;
		        }
		    }
		    return ret;
		}
	})(jQuery);
	//-------------------------------------------------------------
	//get the para of an exact name from a url
	//-------------------------------------------------------------
	(function($) {
		$.getUrlPara = function (name) {
			var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
			var r = window.location.search.substr(1).match(reg);
			if (r != null) {
				return $.URLdecode(r[2]);
			}
			return null;
		}
	})(jQuery);
	var PRODUCT_ID = $.getUrlPara("product_id");

	$.post("php/get_each_product.php", { product_id:PRODUCT_ID }, function (dataa, textStatus){
		// get productbase.json
		
		$.getScript("json/productbase.json",function (data){
			data = JSON.parse(data);
			
			if(data[0]['product_id'] == PRODUCT_ID){
				$("#productname").empty();
				$("#productdescription").empty();
				$("#preprice").empty();
				$("#curprice").empty();
				var namecontent = '';	
				var description = '';
				var preprice = '';
				var curprice = '';
				$.each(data, function (index, baseinfo){
					namecontent = '<h4><strong>' + baseinfo['product_name'] + '</strong></h4>';
					description = '<p>' + baseinfo['decription'] + '</p>';
					preprice = '￥' + baseinfo['pre_price']
					curprice = '<strong>￥' + baseinfo['cur_price'] + '</strong>';;
				});
				$("#productname").append(namecontent);
				$("#productdescription").append(description);
				$("#preprice").append(preprice);
				$("#curprice").append(curprice);
			}
		});

		//get productcolor.json
		$.getScript("json/productcolor.json",function (data){
			data = JSON.parse(data);

			if(data[0]['product_id'] == PRODUCT_ID){
				$("#productcolor").empty();
				var colorcontent = '';
				$.each(data, function (index, colorinfo){
					if(index == 0){
						colorcontent += '<label class="radio-inline"><input type="radio" name="inlineRadioOptions" value="'+ colorinfo['color_id'] +'" checked="checked">'+ colorinfo['color_name'] +'</label>';
					}
					else {
						colorcontent += '<label class="radio-inline"><input type="radio" name="inlineRadioOptions" value="'+ colorinfo['color_id'] +'">'+ colorinfo['color_name'] +'</label>';
					}
				});
				$("#productcolor").append(colorcontent);
			}
			else {
				//重定向
			}
		});

		//get producttag.json
		$.getScript("json/producttag.json",function (data){
			data = JSON.parse(data);

			if(data[0]['product_id'] == PRODUCT_ID){
				$("#producttag").empty();
				var tagcontent = '';
				$.each(data, function (index, taginfo){
					if(index == 0){
						tagcontent += taginfo['tag_name'];
					}
					else {
						tagcontent += '/'+ taginfo['tag_name'];
					}
				});
				$("#producttag").append(tagcontent);
			}
			else {
				//重定向
			}
		});

		//get productparameter.json
		$.getScript("json/productparameter.json",function (data){
			data = JSON.parse(data);

			if(data[0]['product_id'] == PRODUCT_ID){
				$("#productparameter span").empty();
				
				$("#productparameter span.style").text(data[0]['style']);
				$("#productparameter span.material").text(data[0]['material']);
				$("#productparameter span.component").text(data[0]['component']);
				$("#productparameter span.sleeve_style").text(data[0]['sleeve_style']);
				$("#productparameter span.type_version").text(data[0]['type_version']);
				$("#productparameter span.collar").text(data[0]['collar']);
			}
		});

		//get productdetail.json
		
		$.getScript("json/productdetail.json",function (data){
			data = JSON.parse(data);

			if(data[0]['product_id'] == PRODUCT_ID){
				
				$("#productdetail").empty();

				var detailcontent = '';
				$.each(data, function (index, detailinfo){
					if(index == 0){
						detailcontent += '<div class="radio"><label><input type="radio" name="optionsRadios" value="'+detailinfo['size_name']+'" checked>';
					}
					else {
						detailcontent += '<div class="radio"><label><input type="radio" name="optionsRadios" value="'+detailinfo['size_name']+'">';
					}
					// cloth
					if (detailinfo['type'] == 'Y') {
						detailcontent +='<div><span class="pr20"><strong>尺码:'+detailinfo['size_name']+'</strong></span><span class="pr20"><strong></strong></span></div>';

						detailcontent +='<div class="row"><div class="col-xs-6 pl5 pr5"><span class="text-muted pr5"><small>肩宽:'+detailinfo['shoulder']+'</small></span></div>';
						detailcontent +='<div class="col-xs-6 pl5 pr5"><span class="text-muted pr5"><small>袖长:'+detailinfo['sleeve']+'</small></span></div></div>';

						detailcontent +='<div class="row"><div class="col-xs-6 pl5 pr5"><span class="text-muted pr5"><small>衣长:'+detailinfo['cloth_len']+'</small></span></div>';
						detailcontent +='<div class="col-xs-6 pl5 pr5"><span class="text-muted pr5"><small>胸围:'+detailinfo['breast']+'</small></span></div></div>';

						detailcontent +='<div class="row"><div class="col-xs-6 pl5 pr5"><span class="text-muted pr5"><small>腰围:'+detailinfo['waist']+'</small></span></div>';
						detailcontent +='<div class="col-xs-6 pl5 pr5"><span class="text-muted pr5"><small>领围:'+detailinfo['collar']+'</small></span></div></div></label></div>';
					}
					// trousers
					if (detailinfo['type'] == 'N') {
						detailcontent +='<div><span class="pr20"><strong>尺码:'+detailinfo['size_name']+'</strong></span><span class="pr20"><strong>尺码:身高</strong></span></div>';

						detailcontent +='<div class="row"><div class="col-xs-6 pl5 pr5"><small class="text-muted pr5">腰围:'+detailinfo['waist']+'</small></div>';
						detailcontent +='<div class="col-xs-6 pl5 pr5"><small class="text-muted pr5">臀围:'+detailinfo['buttocks']+'</small></div></div>';

						detailcontent +='<div class="row"><div class="col-xs-6 pl5 pr5"><small class="text-muted pr5">小腿围:'+detailinfo['shank']+'</small></div>';
						detailcontent +='<div class="col-xs-6 pl5 pr5"><small class="text-muted pr5">大腿围:'+detailinfo['leg']+'</small></div></div>';
						detailcontent +='<div class="row"><div class="col-xs-12 pl5 pr5"><small class="text-muted pr5">裤长:'+detailinfo['trous_len']+'</small></div></div></label></div>';
					}
				});
				$("#productdetail").append(detailcontent);	
			}
		});

		//get productimg.json
		$.getScript("json/productimg.json", function (data){
			data = JSON.parse(data);
			if(data[0]['product_id'] == PRODUCT_ID){
				$("#homepage-feature ol").empty();
				$("#homepage-feature").children().eq(1).empty();
				$.each(data, function (index, imginfo){

					if(index == 0){
						var content = '<li data-target="#homepage-feature" data-slide-to="' + index + '" class="active"></li>';
						$("#homepage-feature ol").append(content);

						content = '<div class="item active"><img src="img/productImg/'+imginfo['img_name']+'"></div>';
						$("#homepage-feature").children().eq(1).append(content);
					}
					else {
						var content = '<li data-target="#homepage-feature" data-slide-to="' + index + '"></li>';
						$("#homepage-feature ol").append(content);

						content = '<div class="item"><img src="img/productImg/'+imginfo['img_name']+'"></div>';
						$("#homepage-feature").children().eq(1).append(content);
					}
				});
			}
		});
	});
});