//-------------------------------------------------------------
//for product_management.html
// to validate the format of sizedetail when blur from form
// .getScript by productAdd.js
//-------------------------------------------------------------
$(document).ready(function(){
	// validate size_detail
	$('.size-group.show :input').blur(function(){
		var $parent = $(this).parent();			//divs
		$parent.parent().parent().find(".alert").remove();

		if( this.value != "" && /^\d+(\.\d+)?$/.test($(this).val()) == false){
			var errorMsg = "尺寸参数必须是数字类型.";
			$($parent.parent().parent().children()[2]).after('<div class="col-xs-2 alert alert-danger" role="alert"><span class="fa fa-exclamation-triangle" aria-hidden="true"></span><span>' + errorMsg + '</span></div>');
		}
	});
});