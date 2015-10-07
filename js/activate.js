//-------------------------------------------------------------	
//for activate.html
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

	$.get("php/activate.php", { x:$.getUrlPara("x"), y:$.getUrlPara("y")}, 
		function (data, textStatus){
			//alert("x: "+$.getUrlPara("x")+ "\ny:"+$.getUrlPara("y")+ "\nDATA: "+ data);
			switch(data)
			{
				case "Success":
					$("#activatesuccesstitle small").text("邮箱验证成功");
					$("#activatesuccesstitle").after('<div class="text-center"><span class="center icon fa fa-check fa-4x"></span></div><p class="text-center"><small>感谢您的注册！您的账户已激活.<small></p><p id="timedown" class="text-center"></p>');
					var t1 = setTimeout("$('#timedown').text('3秒后自动跳转到首页.')",0);
					var t2 = setTimeout("$('#timedown').text('2秒后自动跳转到首页.')",1000);
					var t3 = setTimeout("$('#timedown').text('1秒后自动跳转到首页.')",2000);
					var t4 = setTimeout("window.location.assign('index.html')",3000);
					break;
				case "Failed":
					$("#activatesuccesstitle small").text("邮箱验证失败");
					$("#activatesuccesstitle").after('<div class="text-center"><span class="center icon fa fa-times fa-4x"></span></div><p class="text-center"><small>感谢您的注册！您的账户已激活.<small></p><p id="timedown" class="text-center"></p>');
					var t1 = setTimeout("$('#timedown').text('3秒后自动跳转到首页.')",0);
					var t2 = setTimeout("$('#timedown').text('2秒后自动跳转到首页.')",1000);
					var t3 = setTimeout("$('#timedown').text('1秒后自动跳转到首页.')",2000);
					var t4 = setTimeout("window.location.assign('index.html')",3000);
					break;
			}
	});

});
