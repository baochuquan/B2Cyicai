//-------------------------------------------------------------
//for shoppingcart.html
//to manage user's own shoppingcart
//-------------------------------------------------------------
$(function(){
	$.post("php/product/getcartinfo.php",{
		user_id: $.cookie("user_id")
	},
	function (data, index){
		$.getScript("json/shoppingcart/cartcontent.json",function (data){
			data = JSON.parse(data);
			if(data[0]['user_id'] == $.cookie('user_id')){
				$(".emptycart").addClass("hidden");
				$(".notemptycart").removeClass("hidden");

				
				/*
				$("#productcolor").empty();
				var colorcontent = '';
				$.each(data, function (index, colorinfo){
					if(index == 0){
						colorcontent += '<label class="radio-inline"><input type="radio" name="inlineRadioOptions" value="'+ colorinfo['color_id'] +'" checked="checked">'+ colorinfo['color_name'] +'</label>';
					}
					else {
						colorcontent += '<label class="radio-inline"><input type="radio" name="inlineRadioOptions" value="'+ colorinfo['color_id'] +'">'+ colorinfo['color_name'] +'</label>';
					}
				});
				$("#productcolor").append(colorcontent);
				*/
			}
		});
	});
});	