//-------------------------------------------------------------
//for product_management.html
//to set the selected img to be cover
//-------------------------------------------------------------
$(function(){
	$("#deleteselect").click(function (){
		// img is new
		if($("input[name='deleteimg']:checked").parent().parent().parent().hasClass("new")) {
			alert("图片删除成功!");

			var $tmp = $("#outputimg .new :checked").val();
			$tmp = "#inputimg .new [value='" + $tmp + "']";
			$($tmp).parent().parent().remove();
			$("#outputimg .new :checked").parent().parent().remove();
		}

		// img is old
		if($("input[name='deleteimg']:checked").parent().parent().parent().hasClass("old")) {
			$.post("admin/php/editProduct/delete_img.php", { product_id: $("#productid").val(), checked: $("input[name='deleteimg']:checked").val() }, function (index, data){
				if(data == "success"){
					alert("图片删除成功!");

					// move from output & input .old
					var $tmp = $("#outputimg .old :checked").val();
					$tmp = "#inputimg .old [value='" + $tmp + "']";
					$($tmp).parent().parent().remove();

					$("#outputimg .old :checked").parent().parent().remove();
					//window.location.assign('.html');
				}
				else {
					alert("图片删除失败!");
					//window.location.assign('myaccount.html');
				}	
			});
		}
	});
});