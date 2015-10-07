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

	$.post("php/get_each_product.php", { product_id:$.getUrlPara("product_id") }, function (dataa, textStatus){
		// get productbase.json
		
		$.getScript("json/productbase.json",function (data){
			data = JSON.parse(data);
			
			$("#productname").empty();
			$("#productdescription").empty();
			$("#preprice").empty();
			$("#curprice").empty();
			var namecontent = '';	
			var description = '';
			var preprice = '';
			var curprice = '';
			$.each(data, function (index, baseinfo){
				namecontent = '<h4>' + baseinfo['product_name'] + '</h4>';
				description = '<p>' + baseinfo['decription'] + '</p>';
				preprice = '￥' + baseinfo['pre_price']
				curprice = '<strong>￥' + baseinfo['cur_price'] + '</strong>';;
			});
			$("#productname").append(namecontent);
			$("#productdescription").append(description);
			$("#preprice").append(preprice);
			$("#curprice").append(curprice);
		});

		//get productcolor.json
		$.getScript("json/productcolor.json",function (data){
			data = JSON.parse(data);

			$("productcolor").empty();
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
		});

		//get productsize.json
		/*
		$.getScript("json/productsize.json",function (data){
			data = JSON.parse(data);

			$("productsize").empty();
			var sizecontent = '';
			$.each(data, function (index, sizeinfo){
				if(index == 0){
					sizecontent += '<label class="radio-inline"><input type="radio" name="inlineRadioOptions" value="'+ sizeinfo['size_id'] +'" checked="checked">'+ sizeinfo['size_name'] +'</label>';
				}
				else {
					sizecontent += '<label class="radio-inline"><input type="radio" name="inlineRadioOptions" value="'+ sizeinfo['size_id'] +'">'+ sizeinfo['size_name'] +'</label>';
				}
			});
			$("#productsize").append(sizecontent);
		});
*/
	});
});