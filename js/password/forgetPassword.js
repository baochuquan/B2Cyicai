//-------------------------------------------------------------
//for forgetpassword.html
//if users forget password
//-------------------------------------------------------------
$(document).ready(function(){
	$("#forgetpasswordform :input").blur(function(){
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
	});
});
//validate all the input of register before submit
$(function(){
	//validate before submit
	$('#forgetpasswordsubmit').click(function(){
		$("#forgetpasswordform :input").trigger('blur');
		var numError = $('form .alert').length;
		if(numError){
			return false;
		}	
		//ajax to check the email if it is registered
		$.post("php/password/forget_password.php", {usermail: $("#usermail").val()},
			function (data, textStatus){
				switch(data)
				{
					case "Unexist":
						var $target = $("#forgetpasswordform #usermail").parent();
						$target.parent().removeClass("has-success");
						$target.parent().find(".alert").remove();
						$target.find(".fa-check").remove();
						var errorMsg = "该邮箱未注册.";
						$target.after('<div class="col-xs-4 alert alert-danger" role="alert"><span class="fa fa-exclamation-triangle" aria-hidden="true"></span><span>' + errorMsg + '</span></div>');
						break;
					case "Success":
						$("#forgetpasswordform").hide();
						$("#forgetpasswordtitle small").hide();
						$("#forgetpasswordtitle").after('<p class="text-center"><small>系统已经将临时登录密码发送至您的邮箱，您可以通过该密码登陆衣彩账户，登录后您可以自行修改密码。<small></p><p id="timedown" class="text-center"></p><div class="text-center"><span class="center icon fa fa-check fa-4x"></span></div>');
						var t1 = setTimeout("$('#timedown').text('3秒后自动跳转到首页.')",0);
						var t2 = setTimeout("$('#timedown').text('2秒后自动跳转到首页.')",1000);
						var t3 = setTimeout("$('#timedown').text('1秒后自动跳转到首页.')",2000);
						var t4 = setTimeout("window.location.assign('index.html')",3000);
						break;
					case "Error":
						$("#forgetpasswordform").hide();
						$("#forgetpasswordtitle small").text("出错了...");
						$("#forgetpasswordtitle").after('<div class="text-center"><span class="icon fa fa-times fa-4x"></span></div>');	
						var t1 = setTimeout("$('#timedown').text('3秒后自动跳转到首页.')",0000);
						var t2 = setTimeout("$('#timedown').text('2秒后自动跳转到首页.')",1000);
						var t3 = setTimeout("$('#timedown').text('1秒后自动跳转到首页.')",2000);
						var t4 = setTimeout("window.location.assign('index.html')",3000);
						break;
				}
			}
		);
	});
});

