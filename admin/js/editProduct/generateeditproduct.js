//-------------------------------------------------------------
//for product_edit.html?product_id=?
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

	$.post("admin/php/editProduct/get_each_product.php", { product_id:$.getUrlPara("product_id") }, function (dataa, textStatus){
		
		// get editbase.json
		$.getScript("admin/json/editbase.json",function (data){
			data = JSON.parse(data);
			var $namecontent 	= data[0]['product_name'];
			var $description 	= data[0]['decription'];
			var $preprice 		= data[0]['pre_price'];
			var $curprice 		= data[0]['cur_price'];
			var $product_id 	= data[0]['product_id'];
			$("#newproductname").val($namecontent);
			$("#newproductinfo").val($description);
			$("#newproductpreprice").val($preprice);
			$("#newproductcurprice").val($curprice);
			$("#productid").val($product_id);
		});

		//get editcolor.json
		$.getScript("admin/json/editcolor.json",function (data){
			data = JSON.parse(data);

			var $colorcontent = '';
			$.each(data, function (index, colorinfo){
				if(index == 0){
					$colorcontent += colorinfo['color_name'];
				}
				else {
					$colorcontent += "/" + colorinfo['color_name'];
				}
			});
			$("#newproductcolor").val($colorcontent);
		});

		//get edittag.json
		$.getScript("admin/json/edittag.json",function (data){
			data = JSON.parse(data);

			var $tagcontent = '';
			$.each(data, function (index, taginfo){
				if(index == 0){
					$tagcontent += taginfo['tag_name'];
				}
				else {
					$tagcontent += "/" + taginfo['tag_name'];
				}
			});
			$("#newproducttag").val($tagcontent);
		});

		//get editparameter.json
		$.getScript("admin/json/editparameter.json",function (data){
			data = JSON.parse(data);	
			var style 			= data[0]['style'];
			var material 		= data[0]['material'];
			var sleeve_style 	= data[0]['sleeve_style'];
			var type_version 	= data[0]['type_version'];
			var component 		= data[0]['component'];
			var collar 			= data[0]['collar'];
			$("#para-style").val(style);
			$("#para-mater").val(material);
			$("#para-sleev").val(sleeve_style);
			$("#para-typev").val(type_version);	
			$("#para-compo").val(component);
			$("#para-colla").val(collar);
		});

		//get editdetail.json
		$.getScript("admin/json/editdetail.json",function (data){
			data = JSON.parse(data);
			
			$.each(data, function (index, detailinfo){
				switch(detailinfo['size_name']){
					case 'S':
						$(".S").addClass("show");
						$(".S").addClass("yes");
						$("#CheckboxS").attr("checked","selected");
						break;
					case 'M':
						$(".M").addClass("show");
						$(".M").addClass("yes");
						$("#CheckboxM").attr("checked","checked");
						break;
					case 'L':
						$(".L").addClass("show");
						$(".L").addClass("yes");
						$("#CheckboxL").attr("checked","checked");
						break;
					case 'XL':
						$(".XL").addClass("show");
						$(".XL").addClass("yes");
						$("#CheckboxXL").attr("checked","checked");
						break;
					case 'XXL':
						$(".XXL").addClass("show");
						$(".XXL").addClass("yes");
						$("#CheckboxXXL").attr("checked","checked");
						break;
					case 'XXXL':
						$(".XXXL").addClass("show");
						$(".XXXL").addClass("yes");
						$("#CheckboxXXXL").attr("checked","checked");	
						break;
				}
			});
			if(data[0]['sex'] == "M")
				$("#feature1 option").eq(0).attr("selected","selected");
			else 
				$("#feature1 option").eq(1).attr("selected","selected");
			if(data[0]['type'] == "Y"){
				$("#feature2 option").eq(0).attr("selected","selected");
				$(".down").removeClass("show");
			}
			else {
				$("#feature2 option").eq(1).attr("selected","selected");
				$(".up").removeClass("show");
			}
			$.each(data, function (index, detailinfo){
				if(data[0]['type'] == "Y"){
					$(".size-group.show").eq(index).find(":input").eq(0).val(detailinfo['shoulder']);
					$(".size-group.show").eq(index).find(":input").eq(1).val(detailinfo['breast']);
					$(".size-group.show").eq(index).find(":input").eq(2).val(detailinfo['sleeve']);
					$(".size-group.show").eq(index).find(":input").eq(3).val(detailinfo['cloth_len']);
					$(".size-group.show").eq(index).find(":input").eq(4).val(detailinfo['waist']);
					$(".size-group.show").eq(index).find(":input").eq(5).val(detailinfo['collar']);
				}
				else{
					$(".size-group.show").eq(index).find(":input").eq(0).val(detailinfo['waist']);
					$(".size-group.show").eq(index).find(":input").eq(1).val(detailinfo['buttocks']);
					$(".size-group.show").eq(index).find(":input").eq(2).val(detailinfo['leg']);
					$(".size-group.show").eq(index).find(":input").eq(3).val(detailinfo['shank']);
					$(".size-group.show").eq(index).find(":input").eq(4).val(detailinfo['trous_len']);
				}
			});	
		});
		//get editimg.json
		$.getScript("admin/json/editimg.json",function (data){
			data = JSON.parse(data);
			var imgcontent = '';
			$.each(data, function (index, imginfo){
				var temp  = '';
				temp = (imginfo['cover'] == 'Y') ? 'checked': '';
				imgcontent += '<div class="radio"><label><input type="radio" name="coverimg" value="'+ imginfo['img_name'] +'" ' + temp + '><img src="img/productImg/' + imginfo['img_name'] + '" alt="' + imginfo['img_name'] + '" title="' + imginfo['img_name'] + '" class="img-thumbnail"></label></div>';
			});
			$("#inputimg .old").html(imgcontent);

			imgcontent = imgcontent.replace(/coverimg/g, "deleteimg");
			imgcontent = imgcontent.replace(/checked/g, "");
			$("#outputimg .old").html(imgcontent);

			$.getScript("admin/js/editProduct/setcover.js");
		});
	});
});