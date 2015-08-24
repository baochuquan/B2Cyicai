$( document ).ready(function() {
	$('.carousel').carousel({
    	interval: 3000
	});
	
	$(function(){
    	var t = $("#text_box");
    	$("#add").click(function(){        
     	   t.val(parseInt(t.val())+1)
    	});
    	$("#min").click(function(){
			if(t.val() <= 0){
				t.val(0);
			}
			else {
    	    	t.val(parseInt(t.val())-1)
			}
    	});
	});
});
//-------------------------------------------------------------
//for register.php
//-------------------------------------------------------------
$(function(){
	$('#registerform :input').blur(function(){
		var $parent = $(this).parent();
		$parent.parent().removeClass("has-success");
		$parent.parent().find(".alert").remove();
		$parent.find(".fa-check").remove();
		
		//validate username
		if( $(this).is('#username') ){
			if( this.value == "" || this.value.length < 6 ) {
				var errorMsg = "请输入至少6位的用户名.";
				$parent.after('<div class="col-xs-4 alert alert-danger" role="alert"><span class="fa fa-exclamation-triangle" aria-hidden="true"></span><span>' + errorMsg + '</span></div>');
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
				$parent.after('<div class="col-xs-4 alert alert-danger" role="alert"><span class="fa fa-exclamation-triangle" aria-hidden="true"></span><span>' + errorMsg + '</span></div>');
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
				$parent.after('<div class="col-xs-4 alert alert-danger" role="alert"><span class="fa fa-exclamation-triangle" aria-hidden="true"></span><span>' + errorMsg + '</span></div>');
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
				$parent.after('<div class="col-xs-4 alert alert-danger" role="alert"><span class="fa fa-exclamation-triangle" aria-hidden="true"></span><span>' + errorMsg + '</span></div>');
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
	});
});
