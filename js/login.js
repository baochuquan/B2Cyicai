//-------------------------------------------------------------	
//for login.html
//-------------------------------------------------------------
$(document).ready(function(){
	$("#loginform :input").blur(function(){
		var $parent = $(this).parent();
		$parent.parent().removeClass("has-success");
		$parent.parent().find(".alert").remove();
		$parent.find(".fa-check").remove();

		//validate usermail
		if( $(this).is('#usermail') ){
			if( this.value == "" || /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test($(this).val()) == false) {
				var errorMsg = "请输入正确的Email地址.";
				$parent.after('<div class="col-xs-4 alert alert-danger" role="alert"><span class="fa fa-exclamation-triangle" aria-hidden="true"></span><span>' + errorMsg + '</span></div>');
			}
			else {
				$parent.parent().addClass("has-success");
				$parent.append('<span class="fa fa-check form-control-feedback" aria-hidden="true"></span><span class="sr-only"></span>');
			}
		}
		//validate password
		if( $(this).is('#pass') ){
			if(!($(this).val().trim().length > 0)){	
				var errorMsg = "请输入密码.";
				$parent.after('<div class="col-xs-4 alert alert-danger" role="alert"><span class="fa fa-exclamation-triangle" aria-hidden="true"></span><span>' + errorMsg + '</span></div>');
			}
		}
	});
});

//validate all the input of register before submit
$(function(){
	//validate before submit
	$('#loginsubmit').click(function(){
		$("#loginform :input").trigger('blur');
		var numError = $('form .alert').length;
		if(numError){
			return false;
		}
		$.post("php/login.php", {
			usermail:$("#usermail").val(),
			pass:$("#pass").val()
			},
			function(data,textStatus){
				//alert("DATA: "+data);
				switch(data)
				{
					case 'Success':
						window.location.assign('index.html');
						break;
					case 'Unmatch':
						var $target = $("#loginform #pass").parent();
						$target.parent().removeClass("has-success");
						$target.parent().find(".alert").remove();
						$target.find(".fa-check").remove();
						var errorMsg = "邮箱与密码不匹配,请确认账户已激活.";
						$target.after('<div class="col-xs-4 alert alert-danger" role="alert"><span class="fa fa-exclamation-triangle" aria-hidden="true"></span><span>' + errorMsg + '</span></div>');
						break;
					case 'Error':
						$("#loginform").hide();
						$("#logintitle small").text("登录失败");
						$("#logintitle").after('<div class="text-center"><span class="icon fa fa-times fa-4x"></span></div>');	
						var t1 = setTimeout("$('#timedown').text('3秒后自动跳转到首页.')",0000);
						var t2 = setTimeout("$('#timedown').text('2秒后自动跳转到首页.')",1000);
						var t3 = setTimeout("$('#timedown').text('1秒后自动跳转到首页.')",2000);
						var t4 = setTimeout("window.location.assign('index.html')",3000);
						break;
				}
			});
	});
});