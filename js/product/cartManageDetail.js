//-------------------------------------------------------------
//for shoppingcart.html
//getScript by cartManage.js
//to manage user's own shoppingcart
//-------------------------------------------------------------
$(function(){
	// manage the checkbox
	$(".selectall :input").bind("click",function(){
		if($(this).is(":checked")){
			$(".notemptycart .panel-body .checkbox :input").prop("checked",'true');
			$(".selectall :input").prop("checked",'true');
			$("#checkout").removeClass("disabled");
			// update totalquantity & totalprice
			var totalnum = 0;
			var totalprice = 0;
			for(var i=0; i<$(".notemptycart .panel-body .checkbox :input").length-1; i++){
				totalnum += parseInt($(".notemptycart .panel-body .checkbox :input").eq(i).parent().parent().parent().parent().children().eq(5).find(":input").eq(1).val());
				totalprice += parseInt($(".notemptycart .panel-body .checkbox :input").eq(i).parent().parent().parent().parent().children().eq(6).text());
			}
			$("#totalquantity").text(totalnum);
			$("#totalprice").text(totalprice);
			$("#actualtotalprice").text(totalprice+20);
		}
		else {
			$(".notemptycart .panel-body .checkbox :input").removeAttr("checked");
			$(".selectall :input").removeAttr("checked");
			$("#checkout").addClass("disabled");
			// update totalquantity & totalprice
			$("#totalquantity").text("0");
			$("#totalprice").text("0");
			$("#actualtotalprice").text('0');
		}
	});

	// to control the amount
	$(".orderamount .amount").blur(function(){
		if( $(this).val() == "" || /^\+?[1-9][0-9]*$/.test($(this).val()) == false) {
			$(this).val(1);
		}
		// update 小计
		var num = $(this).val();
		var price = $(this).parent().parent().prev().text();
		$(this).parent().parent().next().text(parseInt(price) * num);

		// update total 
		if($(this).parent().parent().parent().children().eq(0).find(":input").prop(":checked")){
			// update totalquantity & totalprice
			var totalnum = 0;
			var totalprice = 0;
			for(var i=0; i<$(".notemptycart .panel-body .checkbox :input").length-1; i++){
				if($(".notemptycart .panel-body .checkbox :input").eq(i).prop(":checked")){
					totalnum += parseInt($(".notemptycart .panel-body .checkbox :input").eq(i).parent().parent().parent().parent().children().eq(5).find(":input").eq(1).val());
					totalprice += parseInt($(".notemptycart .panel-body .checkbox :input").eq(i).parent().parent().parent().parent().children().eq(6).text());
				}
			}
			$("#totalquantity").text(totalnum);
			$("#totalprice").text(totalprice);
			$("#actualtotalprice").text(totalprice+20);
		}
	});
	$(".orderamount .min").click(function(){
		var num = $(this).next().val()-1 > 1 ?  $(this).next().val()-1 : 1;
		$(this).next().val(num);
		// update 小计
		var price = $(this).parent().parent().prev().text();
		$(this).parent().parent().next().text(parseInt(price) * num);

		// update total
		if($(this).parent().parent().parent().children().eq(0).find(":input").prop(":checked")){
			// update totalquantity & totalprice
			var totalnum = 0;
			var totalprice = 0;
			for(var i=0; i<$(".notemptycart .panel-body .checkbox :input").length-1; i++){
				if($(".notemptycart .panel-body .checkbox :input").eq(i).prop(":checked")){
					totalnum += parseInt($(".notemptycart .panel-body .checkbox :input").eq(i).parent().parent().parent().parent().children().eq(5).find(":input").eq(1).val());
					totalprice += parseInt($(".notemptycart .panel-body .checkbox :input").eq(i).parent().parent().parent().parent().children().eq(6).text());
				}
			}
			$("#totalquantity").text(totalnum);
			$("#totalprice").text(totalprice);
			$("#actualtotalprice").text(totalprice+20);
		}
	});
	$(".orderamount .add").click(function(){
		var num = parseInt($(this).prev().val())+1;
		$(this).prev().val(num);
		// update 小计
		var price = $(this).parent().parent().prev().text();
		$(this).parent().parent().next().text(parseInt(price) * num);

		// update total
		if($(this).parent().parent().parent().children().eq(0).find(":input").prop(":checked")){
			// update totalquantity & totalprice
			var totalnum = 0;
			var totalprice = 0;
			for(var i=0; i<$(".notemptycart .panel-body .checkbox :input").length-1; i++){
				if($(".notemptycart .panel-body .checkbox :input").eq(i).prop(":checked")){
					totalnum += parseInt($(".notemptycart .panel-body .checkbox :input").eq(i).parent().parent().parent().parent().children().eq(5).find(":input").eq(1).val());
					totalprice += parseInt($(".notemptycart .panel-body .checkbox :input").eq(i).parent().parent().parent().parent().children().eq(6).text());
				}
			}
			$("#totalquantity").text(totalnum);
			$("#totalprice").text(totalprice);
			$("#actualtotalprice").text(totalprice+20);
		}
	});	
});