//-------------------------------------------------------------
//for every html documnet
//check the state of uesrs
//-------------------------------------------------------------
$(function(){
	var COOKIE_NAME = 'username';
	var COOKIE_LEVEL = 'userlevel';
	if($.cookie(COOKIE_NAME) != ""){
		var content = '<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="icon fa fa-user fa-lg"></i> ';
		content += $.cookie(COOKIE_NAME);
		content += '<span class="caret"></span></a>';
		content += '<ul class="dropdown-menu"><li><a href="change_password.html">修改密码</a></li><li><a href="myaccount.html">账户设置</a></li><li><a href="#">已买到宝贝</a></li>'
		if ($.cookie(COOKIE_LEVEL) == 1) {
			content +=  '<li role="separator" class="divider"></li><li><a href="order_management.html">订单管理</a></li><li><a href="product_management.html">产品管理</a></li><li><a href="customer_management.html">客户管理</a></li><li role="separator" class="divider"></li>'
		}
		content += '<li><a id="logoutlink" href="#">退出账户</a></li></ul></li>'
		content += '<li><a href="#" title="view cart"><i class="icon fa fa-shopping-cart fa-lg"></i> 购物车</a></li>'
		$("#cookiedeal li").hide();
		$("#cookiedeal").append(content);
	}
});