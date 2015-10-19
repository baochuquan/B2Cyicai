//-------------------------------------------------------------
//for product.html
// to check the amount 
//-------------------------------------------------------------
$(function(){
	$("#orderamount #amount").blur(function(){
		if( $(this).val() == "" || /^\+?[1-9][0-9]*$/.test($(this).val()) == false) {
			$(this).val(1);
		}
	});
	$("#orderamount #min").click(function(){
		var num = $("#orderamount #amount").val()-1 > 1 ?  $("#orderamount #amount").val()-1 : 1;
		$("#orderamount #amount").val(num);
	});
	$("#orderamount #add").click(function(){
		var num = parseInt($("#orderamount #amount").val())+1;
		$("#orderamount #amount").val(num);
	});
});