
//-------------------------------------------------------------
//for index.html
//-------------------------------------------------------------
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//for carousel time
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

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//for navbar userstate 
$(function(){
	var COOKIE_NAME = 'username';
 	var COOKIE_LEVEL = 'userlevel';
	if ($.cookie(COOKIE_NAME)) {
		//show username, dropdown, and shopping cart
		$("#cookiedeal li").hide();
		var content = '<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="icon fa fa-user fa-lg"></i>' + $.cookie(COOKIE_NAME) + '<span class="caret"></span></a><ul class="dropdown-menu">	<li><a href="change_password.html">修改密码</a></li><li><a href="#">账户设置</a></li><li><a href="#">已买到宝贝</a></li>';
		if ($.cookie(COOKIE_LEVEL) == 1) {
			content += '<li role="separator" class="divider"></li><li><a href="order_management.php">订单管理</a></li><li><a href="product_management.php">产品管理</a></li><li><a href="customer_management.php">客户管理</a></li><li role="separator" class="divider"></li><li><a href="logout.php">退出账户</a></li>';
		}
		content += '</ul></li><li><a href="#" title="view cart"><i class="icon fa fa-shopping-cart fa-lg"></i> 购物车</a></li>';
	 	$("#cookiedeal").html(content);
	};
});


//-------------------------------------------------------------
//for register.html
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
