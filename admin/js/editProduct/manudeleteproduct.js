//-------------------------------------------------------------
//getScript by productDisplay.js
//to delete products
//-------------------------------------------------------------
$(function(){
	var productid;
	$(".manudeleteproduct").on("show.bs.modal", function (event){
		var button = $(event.relatedTarget);
		var content = button.data('whatever');
		var modal = $(this);
		modal.find('.modalproductid').text(content);
		productid = content;
		//alert("EMAIL: "+useremail);
	});	
	$("#confirmdelete").click(function(){	
		//alert("DATA: "+ productid);
		$.post("admin/php/editProduct/manu_delete_product.php", { product_id: productid }, function (data, textStatus){
			if(data == "Success") {
				alert("删除成功!");
				window.location.reload();			
			}
		});
	});
});