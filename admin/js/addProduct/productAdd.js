//-------------------------------------------------------------
//for product_management.html
//to add new product.html
//-------------------------------------------------------------
$(function(){			
	//hide S,M,L,X,XXL,XXXL forms
	$(".size-group").hide();

	$(".checkbox").click(function(){
		switch($(this).val()){
			case "S":
				$(".size-group.S").removeClass("show");
				$(".size-group.S").removeClass("yes");
				if($(this).is(':checked')){
					$(".size-group.S").addClass("yes");
					if($("#feature2").val() == "Y")
						$("#S-sizegroup-up").addClass("show");
					else 
						$("#S-sizegroup-down").addClass("show");
				}										
				break;
			case "M":
				$(".size-group.M").removeClass("show");
				$(".size-group.M").removeClass("yes");
				if($(this).is(':checked')){
					$(".size-group.M").addClass("yes");
					if($("#feature2").val() == "Y")
						$("#M-sizegroup-up").addClass("show");
					else 
						$("#M-sizegroup-down").addClass("show");
				}	
				break;
			case "L":
				$(".size-group.L").removeClass("show");
				$(".size-group.L").removeClass("yes");
				if($(this).is(':checked')){
					$(".size-group.L").addClass("yes");
					if($("#feature2").val() == "Y")
						$("#L-sizegroup-up").addClass("show");
					else 
						$("#L-sizegroup-down").addClass("show");
				}	
				break;
			case "XL":
				$(".size-group.XL").removeClass("show");
				$(".size-group.XL").removeClass("yes");
				if($(this).is(':checked')){
					$(".size-group.XL").addClass("yes");
					if($("#feature2").val() == "Y")
						$("#XL-sizegroup-up").addClass("show");
					else 
						$("#XL-sizegroup-down").addClass("show");
				}	
				break;
			case "XXL":
				$(".size-group.XXL").removeClass("show");
				$(".size-group.XXL").removeClass("yes");
				if($(this).is(':checked')){
					$(".size-group.XXL").addClass("yes");
					if($("#feature2").val() == "Y")
						$("#XXL-sizegroup-up").addClass("show");
					else 
						$("#XXL-sizegroup-down").addClass("show");
				}	
				break;
			case "XXXL":
				$(".size-group.XXXL").removeClass("show");
				$(".size-group.XXXL").removeClass("yes");
				if($(this).is(':checked')){
					$(".size-group.XXXL").addClass("yes");
					if($("#feature2").val() == "Y")
						$("#XXXL-sizegroup-up").addClass("show");
					else 
						$("#XXXL-sizegroup-down").addClass("show");
				}	
				break;
			default:
				break;
		}
		$.getScript("admin/js/addProduct/validateSizeDetail.js");
	});

	$("#feature2").change(function(){
		var $dot = $(".size-group");
		for(var i=0, len=$dot.length; i < len; i++){
			if($($dot[i]).hasClass("yes")){
				if($("#feature2").val() == 'Y'){
					if($($dot[i]).hasClass("up")){
						$($dot[i]).addClass("show");
					}
					else
						$($dot[i]).removeClass("show");
				}
				else {
					if($($dot[i]).hasClass("up")){
						$($dot[i]).removeClass("show");
					}
					else
						$($dot[i]).addClass("show");
				}
			}
		}
		$.getScript("admin/js/addProduct/validateSizeDetail.js");
	});

	//hide & show color, size, tags collapse
	$("#colorcollapse").hide();
	$("#tagcollapse").hide();

	$('#addproductform :input').focus(function(){
		// if color is focus
		if($(this).is('#newproductcolor')) {
			$("#colorcollapse").show();
			$("#tagcollapse").hide();

			$.post("admin/php/addProduct/getColor.php", function (dataa, status){
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
					$.getScript("admin/js/addProduct/colorButtonAdd.js");
				});
			});
		}
		// if tag is foucus
		if($(this).is('#newproducttag')) {
			$("#colorcollapse").hide();
			$("#tagcollapse").show();

			$.post("admin/php/addProduct/getTag.php", function (dataa, status){	
				
				$.getScript("admin/json/tag.json", function (data){
					data = JSON.parse(data);
					$($("#tagcollapse").children()[0]).empty();
					var content = '';
					$.each( data, function (index, taginfo){
						content += '<button type="button" data-whatever="' + taginfo['tag_id'] + '" class="btn btn-default btn-xs">' + taginfo['tag_name'] + '</button>';
					});
					$($("#tagcollapse").children()[0]).append(content);
					// when click the size button
					$.getScript("admin/js/addProduct/tagButtonAdd.js");
				});
			});
		}
	});

	$('#addproductform :input').blur(function(){
		var $parent = $(this).parent();			//divs
		$parent.parent().parent().removeClass("has-success");
		$parent.parent().parent().find(".alert").remove();
		$parent.parent().find(".fa-check").remove();

		//validate new product name
		if($(this).is('#newproductname')) {
			if( this.value == "" ) {
				var errorMsg = "请输入产品名称.";
				$parent.after('<div class="col-xs-2 alert alert-danger" role="alert"><span class="fa fa-exclamation-triangle" aria-hidden="true"></span><span>' + errorMsg + '</span></div>');
			}
			else {
				$parent.parent().addClass("has-success");
				$parent.append('<span class="fa fa-check form-control-feedback" aria-hidden="true"></span><span class="sr-only"></span>');
			}
		}
		//validate new product pre price
		if($(this).is('#newproductpreprice') || $(this).is('#newproductcurprice')) {	
		//	$parent.parent().parent().removeClass("has-success");
		//	$parent.parent().parent().find(".alert").remove();
		//	$parent.parent().find(".fa-check").remove();	
			
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
		// tag
		if($(this).is('#newproductinfo')) {
			if( this.value == "" ) {
				var errorMsg = "请输入关于本产品简单描述.";
				$parent.after('<div class="col-xs-2 alert alert-danger" role="alert"><span class="fa fa-exclamation-triangle" aria-hidden="true"></span><span>' + errorMsg + '</span></div>');
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
			url:'admin/php/addProduct/upload_image.php',
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
			alert("有必填项目未填写");
			return false;
		}

		// if no img uploaded
		if($('#inputimg img').length == 0) {
			alert("请选择图片上传");
			return false;
		}
		// get array for img name
		var $imgname = new Array();
		$('#inputimg img').each(function(){
			$imgname.push($(this).attr("title"));
		});
		//alert("imgname: "+$imgname[0]+$imgname[1]);
	
		
		//for detail
		var $sizedetail = [];
		for(var i = 0; i < $(".checkbox:checked").length; i++){
			var $temp = $($(".checkbox:checked")[i]).val();
			$temp =".size-group.show." + $temp + " :input";
			if($("#feature2").val() == 'Y'){//cloth
				$sizedetail.push({ shoulder:$($($temp)[0]).val(), breast:$($($temp)[1]).val(), sleeve:$($($temp)[2]).val(), cloth_len:$($($temp)[3]).val(), waist:$($($temp)[4]).val(), collar:$($($temp)[5]).val(), size_name:$($(".checkbox:checked")[i]).val(), sex:$("#feature1").val(), type:$("#feature2").val() });
			}
			else {
				$sizedetail.push({ waist:$($($temp)[0]).val(), buttocks:$($($temp)[1]).val(), leg:$($($temp)[2]).val(), shank:$($($temp)[3]).val(), trous_len:$($($temp)[4]).val(), size_name:$($(".checkbox:checked")[i]).val(), sex:$("#feature1").val(), type:$("#feature2").val()});	
			}		
		}
		$.post("admin/php/addProduct/add_product.php", {
				newproductname:$('#newproductname').val(),
				newproductpreprice:$('#newproductpreprice').val(),
				newproductcurprice:$('#newproductcurprice').val(),
				newproductimg:$imgname,

				type:$("#feature2").val(), 
				newproductsizedetail:$sizedetail,
				style:$($("#productparameter :input")[0]).val(),
				material:$($("#productparameter :input")[1]).val(),
				component:$($("#productparameter :input")[2]).val(),
				sleeve_style:$($("#productparameter :input")[3]).val(),
				type_version:$($("#productparameter :input")[4]).val(),
				collar:$($("#productparameter :input")[5]).val(),

				newproductcolor:$('#newproductcolor').val(),
				//newproductsize:$('#newproductsize').val(),
				newproducttag:$('#newproducttag').val(),
				newproductinfo:$('#newproductinfo').val()
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