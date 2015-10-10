//-------------------------------------------------------------
//for register.html
//-------------------------------------------------------------
$(document).ready(function() {
	$('#registerform :input').blur(function(){
		var $parent = $(this).parent();			//divs
		$parent.parent().removeClass("has-success");
		$parent.parent().find(".alert").remove();
		$parent.find(".fa-check").remove();
		
		//validate username
		if( $(this).is('#username') ){
			if( this.value == "" || this.value.length < 6 ) {
				var errorMsg = "请输入至少6位的用户名.";
				$parent.after('<div class="col-xs-2 alert alert-danger" role="alert"><span class="fa fa-exclamation-triangle" aria-hidden="true"></span><span>' + errorMsg + '</span></div>');
			}
			else {
				$parent.parent().addClass("has-success");
				$parent.append('<span class="fa fa-check form-control-feedback" aria-hidden="true"></span><span class="sr-only"></span>');
			}
		}
		//validate usermail
		if( $(this).is('#usermail') ){
			if( this.value == "" || /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test($(this).val()) == false) {
				var errorMsg = "请输入正确的Email地址.";
				$parent.after('<div class="col-xs-2 alert alert-danger" role="alert"><span class="fa fa-exclamation-triangle" aria-hidden="true"></span><span>' + errorMsg + '</span></div>');
			}
			else {
				$parent.parent().addClass("has-success");
				$parent.append('<span class="fa fa-check form-control-feedback" aria-hidden="true"></span><span class="sr-only"></span>');
			}
		}
		//validate password1
		if( $(this).is('#password1') ){
			if($(this).val().trim().length > 0){
				$parent.parent().addClass("has-success");
				$parent.append('<span class="fa fa-check form-control-feedback" aria-hidden="true"></span><span class="sr-only"></span>');
			}	
			else {
				var errorMsg = "请输入密码.";
				$parent.after('<div class="col-xs-2 alert alert-danger" role="alert"><span class="fa fa-exclamation-triangle" aria-hidden="true"></span><span>' + errorMsg + '</span></div>');
			}
		}
		//validate password2
		if( $(this).is('#password2') ){
			var pwd1 = $('#password1').val().trim();
			var pwd2 = $('#password2').val().trim();
			if(pwd1 == pwd2 && $('#password2').val().trim().length > 0) {
				$parent.parent().addClass("has-success");
				$parent.append('<span class="fa fa-check form-control-feedback" aria-hidden="true"></span><span class="sr-only"></span>');
			}
			else {
				var errorMsg = "两次密码不一致.";
				$parent.after('<div class="col-xs-2 alert alert-danger" role="alert"><span class="fa fa-exclamation-triangle" aria-hidden="true"></span><span>' + errorMsg + '</span></div>');
			}
		}
	});
});

//validate all the input of register before submit
$(function(){
	//validate before submit
	$('#registersubmit').click(function(){
		$("#registerform :input").trigger('blur');
		var numError = $('form .alert').length;
		if(numError){
			return false;
		}		
		$.post("php/register/register.php", {
			username:$("#username").val(),
			usermail:$("#usermail").val(),
			password1:$("#password1").val()
			},
			function(data,textStatus){
				//alert("DATA: "+data);
				switch(data)
				{
					case "Success":
						$("#registerform").hide();
						$("#registertitle small").text("注册成功");
						$("#registertitle").after('<div class="text-center"><span class="center icon fa fa-check fa-4x" style="color:#99ff66"></span></div><p class="text-center"><small>感谢您的注册！激活码已经发送至您的邮箱。请点击邮件中的链接以激活您的账户。<small></p><p id="timedown" class="text-center"></p>');
						var t1 = setTimeout("$('#timedown').text('3秒后自动跳转到首页.')",0);
						var t2 = setTimeout("$('#timedown').text('2秒后自动跳转到首页.')",1000);
						var t3 = setTimeout("$('#timedown').text('1秒后自动跳转到首页.')",2000);
						var t4 = setTimeout("window.location.assign('index.html')",3000);
						break;
					case "Error":
					case "Retry":
						$("#registerform").hide();
						$("#registertitle small").text("注册失败");
						$("#registertitle").after('<div class="text-center"><span class="center icon fa fa-times fa-4x" style="color:#ff6633"></span></div>');	
						var t1 = setTimeout("$('#timedown').text('3秒后自动跳转到首页.')",0000);
						var t2 = setTimeout("$('#timedown').text('2秒后自动跳转到首页.')",1000);
						var t3 = setTimeout("$('#timedown').text('1秒后自动跳转到首页.')",2000);
						var t4 = setTimeout("window.location.assign('index.html')",3000);
						break;
					case "Reuse":
						var $target = $("#registerform #usermail").parent();
						$target.parent().removeClass("has-success");
						$target.parent().find(".alert").remove();
						$target.find(".fa-check").remove();
						var errorMsg = "该邮箱已注册.";
						$target.after('<div class="col-xs-4 alert alert-danger" role="alert"><span class="center fa fa-exclamation-triangle" style="color:#ff6633" aria-hidden="true"></span><span>' + errorMsg + '</span></div>');
						break;
				}
			});			
	});
});
