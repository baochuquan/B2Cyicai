//-------------------------------------------------------------
//for product_management.html
//to add new product.html
//-------------------------------------------------------------
$(function(){
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

	});
});