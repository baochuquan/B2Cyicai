//-------------------------------------------------------------
//for product_management.html
//to set the selected img to be cover
//-------------------------------------------------------------
$(function(){
	$("#coverselect").click(function (){
		alert("coverset");

		if($("input[name='coverimg']:checked").parent().parent().parent().hasClass("new")) {
			// get array for img name
			alert("in if");
			var $imgname = new Array();
			$('#inputimg .new img').each(function(){
				$imgname.push($(this).attr("title"));
			});
			alert($imgname[0]);
			$.post("admin/php/editProduct/set_cover.php", { type: "new", product_id: $("#productid").val(), img_name:$imgname, checked: $("input[name='coverimg']:checked").val() }, function (data, status){
				alert("DATA: "+data);
				if(data == "Success"){
					alert("封面设置成功!");
					// move new to old
					$("#inputimg .new div").clone(true).prependTo("#inputimg .old");
					//window.location.assign('.html');
				}
				else {
					alert("封面设置失败!");
					//window.location.assign('myaccount.html');
				}	
			});
		}
		else {
			alert("else");
			$.post("admin/php/editProduct/set_cover.php", { type: "old", product_id: $("#productid").val(), checked: $("input[name='coverimg']:checked").val() }, function (data, status){
				alert("DATA: "+data);
				if(data == "Success"){
					alert("封面设置成功!");
					//window.location.assign('.html');
				}
				else {
					alert("封面设置失败!");
					//window.location.assign('myaccount.html');
				}	
			});
		}
	});
});