//-------------------------------------------------------------
//for product_management.html
//to add new product.html
//-------------------------------------------------------------
$(function(){			

	//hide & show color, size, tags collapse
	$("#colorcollapse").hide();
	$("#sizecollapse").hide();
	$("#tagcollapse").hide();
	$('#addproductform :input').focus(function(){
		// if color is focus
		if($(this).is('#newproductcolor')) {
			$("#colorcollapse").show();
			$("#sizecollapse").hide();
			$("#tagcollapse").hide();

			$.post("admin/php/getColor.php", function (dataa, status){
				//alert("Rec: "+dataa);				
				$.getScript("admin/json/color.json", function (data){
					data = JSON.parse(data);
					$($("#colorcollapse").children()[0]).empty();
					//var content = '<button type="button" id="shishi" class="btn btn-default btn-xs">黄色</button>';
					var content = '';
					$.each( data, function (index, colorinfo){
						content += '<button type="button" data-whatever="' + colorinfo['color_id'] + '" class="btn btn-default btn-xs">' + colorinfo['color_name'] + '</button>';
					});
					$($("#colorcollapse").children()[0]).append(content);
					// when click the color button
					$.getScript("admin/js/colorButtonAdd.js");
				});
			});
		}
		// if size is focus
		if($(this).is('#newproductsize')) {
			$("#colorcollapse").hide();
			$("#sizecollapse").show();
			$("#tagcollapse").hide();

			$.post("admin/php/getSize.php", function (dataa, status){	
				
				$.getScript("admin/json/size.json", function (data){
					data = JSON.parse(data);
					$($("#sizecollapse").children()[0]).empty();
					var content = '';
					$.each( data, function (index, sizeinfo){
						content += '<button type="button" data-whatever="' + sizeinfo['size_id'] + '" class="btn btn-default btn-xs">' + sizeinfo['size_name'] + '</button>';
					});
					$($("#sizecollapse").children()[0]).append(content);
					// when click the size button
					$.getScript("admin/js/sizeButtonAdd.js");
				});
			});
		}
		// if tag is foucus
		if($(this).is('#newproducttag')) {
			$("#colorcollapse").hide();
			$("#sizecollapse").hide();
			$("#tagcollapse").show();

			$.post("admin/php/getTag.php", function (dataa, status){	
				
				$.getScript("admin/json/tag.json", function (data){
					data = JSON.parse(data);
					$($("#tagcollapse").children()[0]).empty();
					var content = '';
					$.each( data, function (index, taginfo){
						content += '<button type="button" data-whatever="' + taginfo['tag_id'] + '" class="btn btn-default btn-xs">' + taginfo['tag_name'] + '</button>';
					});
					$($("#tagcollapse").children()[0]).append(content);
					// when click the size button
					$.getScript("admin/js/tagButtonAdd.js");
				});
			});
		}
	});



	$('#addproductform :input').blur(function(){
		var $parent = $(this).parent();			//divs
		$parent.parent().removeClass("has-success");
		$parent.parent().find(".alert").remove();
		$parent.find(".fa-check").remove();

		//validate new product name
		if($(this).is('#newproductname')) {
			if( this.value == "" ) {
				var errorMsg = "请输入产品名称.";
				$parent.after('<div class="col-xs-4 alert alert-danger" role="alert"><span class="fa fa-exclamation-triangle" aria-hidden="true"></span><span>' + errorMsg + '</span></div>');
			}
			else {
				$parent.parent().addClass("has-success");
				$parent.append('<span class="fa fa-check form-control-feedback" aria-hidden="true"></span><span class="sr-only"></span>');
			}
		}
		//validate new product pre price
		if($(this).is('#newproductpreprice') || $(this).is('#newproductcurprice')) {	
			$parent.parent().parent().removeClass("has-success");
			$parent.parent().parent().find(".alert").remove();
			$parent.parent().find(".fa-check").remove();	
			
			if( this.value == "" || /^\d+(\.\d+)?$/.test($(this).val()) == false) {
				var errorMsg = "请输入正确的价格格式.";
				$parent.parent().after('<div class="col-xs-2 alert alert-danger" role="alert"><span class="fa fa-exclamation-triangle" aria-hidden="true"></span><span>' + errorMsg + '</span></div>');
			}
			else {
				$parent.parent().parent().addClass("has-success");
				$parent.parent().append('<span class="fa fa-check form-control-feedback" aria-hidden="true"></span><span class="sr-only"></span>');
			}
		}
		// color
		// size
		// tag
		if($(this).is('#newproductinfo')) {
			if( this.value == "" ) {
				var errorMsg = "请输入关于本产品简单描述.";
				$parent.after('<div class="col-xs-4 alert alert-danger" role="alert"><span class="fa fa-exclamation-triangle" aria-hidden="true"></span><span>' + errorMsg + '</span></div>');
			}
			else {
				$parent.parent().addClass("has-success");
				$parent.append('<span class="fa fa-check form-control-feedback" aria-hidden="true"></span><span class="sr-only"></span>');
			}
		}
	});

	// for upload mutil picture
	$("#newproductimg").change(function(){
		var data = new FormData();
		$.each($('#newproductimg')[0].files, function(i, file){
			data.append('upload'+i, file);//serialize
		});	
		$.ajax({
			url:'admin/php/upload_image.php',
			type:'POST',
			data:data,
			cache:false,
			contentType:false,
			processData:false,
			success:function(data) {
				data = $(data).html();
				if($("#inputimg").children('img').length == 0)
					$("#inputimg").append(data.replace(/&lt;/g,'<').replace(/&gt;/g,'>'));
				else
					$("#inputimg").children('img').eq(0).before(data.replace(/&lt;/g,'<').replace(/&gt;/g,'>'));
			},
			error:function(){
				alert('上传出错.');
			}
		});
	});

	//validate before submit
	$('#allsubmit').click(function(){
		$("#allsubmit :input").trigger('blur');
		var $test = $("#addproductform").serialize();
		var $test1 = $("#newproductname").val();
		var numError = $('form .alert').length;
		if(numError){
			alert("尚有填写的项目");
			return false;
		}
		// if no img uploaded
		if($('#inputimg').children('img').length == 0) {
			alert("请选择图片上传");
			return false;
		}
		// get array for img name
		var $imgname = new Array();
		$('#inputimg img').each(function(){
			$imgname.push($(this).attr("title"));
		});
		//alert("imgname: "+$imgname[0]+$imgname[1]);
		/*alert("newproductname: " + $('#newproductname').val()+
				"--newproductpreprice: " + $('#newproductpreprice').val()+
				"--newproductcurprice: " + $('#newproductcurprice').val()+
				"--newproductcolor: " + $('#newproductcolor').val()+
				"--newproductsize: " + $('#newproductsize').val()+
				"--newproducttag: " + $('#newproducttag').val()+
				"--newproductinfo: " + $('#newproductinfo').val());
*/
		
		$.post("admin/php/add_product.php", {
				newproductname:$('#newproductname').val(),
				newproductpreprice:$('#newproductpreprice').val(),
				newproductcurprice:$('#newproductcurprice').val(),
				newproductcolor:$('#newproductcolor').val(),
				newproductsize:$('#newproductsize').val(),
				newproducttag:$('#newproducttag').val(),
				newproductinfo:$('#newproductinfo').val(),
				newproductimg:$imgname
			}, 
			function (data, status){
				if(data == 'Success'){
					$("#addproductform").hide();
					$("#addproducttitle small").text("添加成功");
					$("#addproducttitle").after('<div class="text-center"><span class="center icon fa fa-check fa-4x" style="color:#99ff66"></span></div><p id="timedown" class="text-center"></p>');
					var t1 = setTimeout("$('#timedown').text('3秒后自动跳转到首页.')",0);
					var t2 = setTimeout("$('#timedown').text('2秒后自动跳转到首页.')",1000);
					var t3 = setTimeout("$('#timedown').text('1秒后自动跳转到首页.')",2000);
					var t4 = setTimeout("window.location.assign('index.html')",3000);
				}
				else {
					$("#addproductform").hide();
					$("#addproducttitle small").text("添加失败");
					$("#addproducttitle").after('<div class="text-center"><span class="icon fa fa-times fa-4x" style="color:#ff6633"></span></div><p id="timedown" class="text-center"></p>');	
					var t1 = setTimeout("$('#timedown').text('3秒后自动跳转到首页.')",0000);
					var t2 = setTimeout("$('#timedown').text('2秒后自动跳转到首页.')",1000);
					var t3 = setTimeout("$('#timedown').text('1秒后自动跳转到首页.')",2000);
					var t4 = setTimeout("window.location.assign('index.html')",3000);			
				}
			}
		);
	});
});