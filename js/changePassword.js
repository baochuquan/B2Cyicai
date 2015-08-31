//-------------------------------------------------------------	
//for change_password.html
//-------------------------------------------------------------
$(document).ready(function(){
	$("#changepasswordform :input").blur(function(){
		var $parent = $(this).parent();
		$parent.parent().removeClass("has-success");
		$parent.parent().find(".alert").remove();
		$parent.find(".fa-check").remove();

		//validate password1
		if( $(this).is('#pass1') ){
			if($(this).val().trim().length > 0){
				$parent.parent().addClass("has-success");
				$parent.append('<span class="fa fa-check form-control-feedback" aria-hidden="true"></span><span class="sr-only"></span>');
			}	
			else {
				var errorMsg = "请输入新密码.";
				$parent.after('<div class="col-xs-4 alert alert-danger" role="alert"><span class="fa fa-exclamation-triangle" aria-hidden="true"></span><span>' + errorMsg + '</span></div>');
			}
		}
		//validate password2
		if( $(this).is('#pass2') ){
			var pwd1 = $('#pass1').val().trim();
			var pwd2 = $('#pass2').val().trim();
			if(pwd1 == pwd2 && $('#pass2').val().trim().length > 0) {
				$parent.parent().addClass("has-success");
				$parent.append('<span class="fa fa-check form-control-feedback" aria-hidden="true"></span><span class="sr-only"></span>');
			}
			else {
				var errorMsg = "两次密码不一致.";
				$parent.after('<div class="col-xs-4 alert alert-danger" role="alert"><span class="fa fa-exclamation-triangle" aria-hidden="true"></span><span>' + errorMsg + '</span></div>');
			}
		}
	});
});

//validate all the input of register before submit
$(function(){
	//validate before submit
	$('#changepasswordsubmit').click(function(){
		$("#changepasswordform :input").trigger('blur');
		var numError = $('form .alert').length;
		if(numError){
			return false;
		}
		$.post("php/change_password.php",{ password1:$("#pass1").val() }, 
			function (data,textStatus){
				switch(data)
				{
					case "Success":
						$("#changepasswordform").hide();
						$("#changepasswordtitle small").text("密码修改成功");
						$("#changepasswordtitle").after('<div class="text-center"><span class="center icon fa fa-check fa-4x"></span></div><p class="text-center"><small>感谢您的注册！激活码已经发送至您的邮箱。请点击邮件中的链接以激活您的账户。<small></p><p id="timedown" class="text-center"></p>');
						var t1 = setTimeout("$('#timedown').text('3秒后自动跳转到首页.')",0);
						var t2 = setTimeout("$('#timedown').text('2秒后自动跳转到首页.')",1000);
						var t3 = setTimeout("$('#timedown').text('1秒后自动跳转到首页.')",2000);
						var t4 = setTimeout("window.location.assign('index.html')",3000);
						break;
					case "Failed":
						$("#changepasswordform").hide();
						$("#changepasswordtitle small").text("出错了...");
						$("#changepasswordtitle").after('<div class="text-center"><span class="icon fa fa-times fa-4x"></span></div>');	
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


