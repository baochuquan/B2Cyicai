//-------------------------------------------------------------
//getScript by manuproductedit.js
//to edit products
//-------------------------------------------------------------
$(function(){
	var $productname;
	var $productpreprice;
	var $productcurprice;
	var $productcolor;
	var $productsize;
	var $producttag;
	$(".producteditsave").click(function (event){
		//alert("Cancel");
		var $thistr = $(this).parent().parent().parent();
		var $productid = $($thistr.children()[0]).text();
		var $oldbutton = '<button type="button" class="btn btn-success manueditproduct" data-whatever="' + $productid + '">编辑</button>';

		$productname = $($thistr.children()[1]).children(":input").val();
		$productpreprice = $($thistr.children()[2]).children(":input").val();
		$productcurprice = $($thistr.children()[3]).children(":input").val();
		$productcolor = $($thistr.children()[5]).children(":input").val();
		$productsize = $($thistr.children()[6]).children(":input").val();
		$producttag = $($thistr.children()[7]).children(":input").val();

		$($thistr.children()[1]).html('<a href="#">' + $productname + '</a>');
		$($thistr.children()[2]).html($productpreprice);
		$($thistr.children()[3]).html($productcurprice);
		$($thistr.children()[5]).html($productcolor);
		$($thistr.children()[6]).html($productsize);
		$($thistr.children()[7]).html($producttag);
		$($thistr.children()[8]).html($oldbutton);

		$.getScript("admin/js/manueditproduct.js");

		//for save data into database
		var colorarray = new Array();
		var sizearray = new Array();
		var tagarray = new Array();
		colorarray = $productcolor.trim().split(",");
		sizearray = $productsize.trim().split(",");
		producttag = $producttag.trim().split(",");

		for (var i = colorarray.length - 1; i >= 0; i--) {
			if (colorarray[i] == '') {
				colorarray.splice(i, 1);
			}
		};
		for (var i = sizearray.length - 1; i >= 0; i--) {
			if (sizearray[i] == '') {
				sizearray.splice(i, 1);
			}
		};
		for (var i = producttag.length - 1; i >= 0; i--) {
			if (producttag[i] == '') {
				producttag.splice(i, 1);
			}
		};

		$.post("admin/php/product_edit.php",
			 { 	productid: 			$productid, 
			 	productname: 		$productname, 
			 	productpreprice: 	parseFloat($productpreprice), 
			 	productcurprice: 	parseFloat($productcurprice), 
			 	productcolor: 		colorarray, 
			 	productsize: 		sizearray,
			 	producttag: 		tagarray
			 }, function (data, textStatus){
			 	alert("STRING: "+colorarray[2]);
		});
	});
});