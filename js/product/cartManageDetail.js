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
		var $num = $(this).val();
		var price = $(this).parent().parent().prev().text();
		$(this).parent().parent().next().text(parseInt(price) * $num);

		// update totalquantity & totalprice 
		if($(this).parent().parent().parent().children().eq(0).find(":input").prop("checked")){
			var totalnum = 0;
			var totalprice = 0;
			for(var i=0; i<$(".notemptycart .panel-body .checkbox :input").length-1; i++){
				if($(".notemptycart .panel-body .checkbox :input").eq(i).prop("checked")){
					totalnum += parseInt($(".notemptycart .panel-body .checkbox :input").eq(i).parent().parent().parent().parent().children().eq(5).find(":input").eq(1).val());
					totalprice += parseInt($(".notemptycart .panel-body .checkbox :input").eq(i).parent().parent().parent().parent().children().eq(6).text());
				}
			}
			$("#totalquantity").text(totalnum);
			$("#totalprice").text(totalprice);
			$("#actualtotalprice").text(totalprice+20);
		}
		// update the amount in the database
		var $oc_id = $(this).parent().parent().parent().parent().attr("id");
		$.post("php/product/cartAmountUpdate.php",{
				user_id: $.cookie("user_id"),
				oc_id: $oc_id,
				num: $num
			},
			function (data, status){
				if(data != "Success")
					alert("系统出错");
		});
	});

	$(".orderamount .min").click(function(){
		var $num = $(this).next().val()-1 > 1 ?  $(this).next().val()-1 : 1;
		$(this).next().val($num);
		// update 小计
		var price = $(this).parent().parent().prev().text();
		$(this).parent().parent().next().text(parseInt(price) * $num);

		// update totalquantity & totalprice
		if($(this).parent().parent().parent().children().eq(0).find(":input").prop("checked")){
			var totalnum = 0;
			var totalprice = 0;
			for(var i=0; i<$(".notemptycart .panel-body .checkbox :input").length-1; i++){
				if($(".notemptycart .panel-body .checkbox :input").eq(i).prop("checked")){
					totalnum += parseInt($(".notemptycart .panel-body .checkbox :input").eq(i).parent().parent().parent().parent().children().eq(5).find(":input").eq(1).val());
					totalprice += parseInt($(".notemptycart .panel-body .checkbox :input").eq(i).parent().parent().parent().parent().children().eq(6).text());
				}
			}
			$("#totalquantity").text(totalnum);
			$("#totalprice").text(totalprice);
			$("#actualtotalprice").text(totalprice+20);
		}
		// update the amount in the database
		var $oc_id = $(this).parent().parent().parent().parent().attr("id");
		$.post("php/product/cartAmountUpdate.php",{
				user_id: $.cookie("user_id"),
				oc_id: $oc_id,
				num: $num
			},
			function (data, status){
				if(data != "Success")
					alert("系统出错");
		});
	});

	$(".orderamount .add").click(function(){
		var $num = parseInt($(this).prev().val())+1;
		$(this).prev().val($num);
		// update 小计
		var price = $(this).parent().parent().prev().text();
		$(this).parent().parent().next().text(parseInt(price) * $num);

		// update totalquantity & totalprice
		if($(this).parent().parent().parent().children().eq(0).find(":input").prop("checked")){
			var totalnum = 0;
			var totalprice = 0;
			for(var i=0; i<$(".notemptycart .panel-body .checkbox :input").length-1; i++){
				if($(".notemptycart .panel-body .checkbox :input").eq(i).prop("checked")){
					totalnum += parseInt($(".notemptycart .panel-body .checkbox :input").eq(i).parent().parent().parent().parent().children().eq(5).find(":input").eq(1).val());
					totalprice += parseInt($(".notemptycart .panel-body .checkbox :input").eq(i).parent().parent().parent().parent().children().eq(6).text());
				}
			}
			$("#totalquantity").text(totalnum);
			$("#totalprice").text(totalprice);
			$("#actualtotalprice").text(totalprice+20);
		}
		// update the amount in the database
		var $oc_id = $(this).parent().parent().parent().parent().attr("id");
		$.post("php/product/cartAmountUpdate.php",{
				user_id: $.cookie("user_id"),
				oc_id: $oc_id,
				num: $num
			},
			function (data, status){
				if(data != "Success")
					alert("系统出错");
		});
	});	

	// recalculate when checkbox are clicked
	$(".notemptycart .panel-body .checkbox :input").click(function(){
		if(!$(this).hasClass("all")){	//except the last on: select all
			if(!$(this).prop("checked")){//if unchecked
				$(".selectall :input").removeAttr("checked");
				// update totalquantity & totalprice
				var totalnum = 0;
				var totalprice = 0;
				for(var i=0; i<$(".notemptycart .panel-body .checkbox :input").length-1; i++){
					if($(".notemptycart .panel-body .checkbox :input").eq(i).prop("checked")){
						totalnum += parseInt($(".notemptycart .panel-body .checkbox :input").eq(i).parent().parent().parent().parent().children().eq(5).find(":input").eq(1).val());
						totalprice += parseInt($(".notemptycart .panel-body .checkbox :input").eq(i).parent().parent().parent().parent().children().eq(6).text());
					}
				}
				$("#totalquantity").text(totalnum);
				$("#totalprice").text(totalprice);
				$("#actualtotalprice").text(totalprice+20);
			}
			else {
				//to determine if should make select checked
				var checkflag = 1;
				for(var i=0; i<$(".notemptycart .panel-body .checkbox :input").length-1; i++){
					if(!$(".notemptycart .panel-body .checkbox :input").eq(i).prop("checked")){
						checkflag = 0;
						break
					}
				}
				if(checkflag){
					$(".selectall :input").prop("checked",'true');
					// update totalquantity & totalprice
					if($(this).prop("checked")){
						var totalnum = 0;
						var totalprice = 0;
						for(var i=0; i<$(".notemptycart .panel-body .checkbox :input").length-1; i++){
							if($(".notemptycart .panel-body .checkbox :input").eq(i).prop("checked")){
								totalnum += parseInt($(".notemptycart .panel-body .checkbox :input").eq(i).parent().parent().parent().parent().children().eq(5).find(":input").eq(1).val());
								totalprice += parseInt($(".notemptycart .panel-body .checkbox :input").eq(i).parent().parent().parent().parent().children().eq(6).text());
							}
						}
						$("#totalquantity").text(totalnum);
						$("#totalprice").text(totalprice);
						$("#actualtotalprice").text(totalprice+20);
					}
				}
			}
		}
	});
	// delete 
	$(".delete").click(function(){
		//update the totalquantity & totalprice
		if(confirm("您确定要从购物车删除该项目吗?")){
			var $oc_id = $(this).parent().parent().parent().attr("id");
			if($(this).parent().parent().children().eq(0).find(":input").prop("checked")){
				var onenum = $(this).parent().parent().children().eq(5).find(".amount").val();
				var oneprice = parseInt($(this).parent().parent().children().eq(6).text());
				
				var totalnum = parseInt($("#totalquantity").text());
				var totalprice = parseInt($("#totalprice").text());
				var actualtotalprice = parseInt($("#actualtotalprice").text());

				$("#totalquantity").text(totalnum-onenum);
				$("#totalprice").text(totalprice-oneprice);
				$("#actualtotalprice").text(actualtotalprice-oneprice);

				//delete 
				$(this).parent().parent().parent().remove();
			}
			else{
				//delete 
				$(this).parent().parent().parent().remove();
				//update if select all or not
				var checkflag = 1;
				for(var i=0; i<$(".notemptycart .panel-body .checkbox :input").length-1; i++){
					if(!$(".notemptycart .panel-body .checkbox :input").eq(i).prop("checked")){
						checkflag = 0;
						break
					}
				}
				if(checkflag){
					$(".selectall :input").prop("checked",'true');
				}
			}
			// update data base
			$.post("php/product/removeFromCart.php",{
					user_id:$.cookie("user_id"),
					oc_id:$oc_id
				},function (data, status){
					if(data != 'Success')
						alert("删除出错");
			});
		}
	});


	//commit order
	$("#checkout").click(function(){
		//for checked checkbox item
		var $checkeditem = [];
		for(var i = 0; i < $(".notemptycart .panel-body .checkbox :input").length-1; i++){
			var $temp = $(".notemptycart .panel-body .checkbox :input");
			if($($temp).eq(i).prop("checked")){
				var $oc_id = $($temp).eq(i).parent().parent().parent().parent().parent().attr("id");
				$checkeditem.push({ oc_id: $oc_id });
			}		
		}
		$.post("php/product/checkout.php", {
			checkeditem: $checkeditem,
			user_id: $.cookie("user_id")
		},function (data,status){
			alert(data);
			// redirect to 
		});
	});
});