//-------------------------------------------------------------
//getScript by productDisplay.js
//to edit products
//-------------------------------------------------------------
$(function(){
	//when click button "edit"
	$(".manueditproduct").click(function (event){
		var $thistr = $(this).parent().parent();
		var $newbutton = '<div class="btn-group" role="group">';
		$newbutton += '<button type="button" class="btn btn-default producteditcancel">取消</button>';
		$newbutton += '<button type="button" class="btn btn-primary producteditsave">保存</button>';
		$newbutton += '</div>';		

		var $productid = $($thistr.children()[0]).text();
		var $productname = $($thistr.children()[1]).text();
		var $productpreprice = $($thistr.children()[2]).text();
		var $productcurprice = $($thistr.children()[3]).text();
		var $productcolor = $($thistr.children()[5]).text();
		var $productsize = $($thistr.children()[6]).text();
		var $producttag = $($thistr.children()[7]).text();

		$($thistr.children()[1]).html('<input type="text" class="form-control" value="' + $productname + '">');
		$($thistr.children()[2]).html('<input type="text" class="form-control" value="' + $productpreprice + '">');
		$($thistr.children()[3]).html('<input type="text" class="form-control" value="' + $productcurprice + '">');
		$($thistr.children()[5]).html('<input type="text" class="form-control" value="' + $productcolor + '">');
		$($thistr.children()[6]).html('<input type="text" class="form-control" value="' + $productsize + '">');
		$($thistr.children()[7]).html('<input type="text" class="form-control" value="' + $producttag + '">');
		$($thistr.children()[8]).html($newbutton);

		//when click button "cancel"
		$(".producteditcancel").click(function (event){
			var $oldbutton = '<button type="button" class="btn btn-success manueditproduct" data-whatever="' + $productid + '">编辑</button>';
				
			$($thistr.children()[1]).html('<a href="#">' + $productname + '</a>');
			$($thistr.children()[2]).html($productpreprice);
			$($thistr.children()[3]).html($productcurprice);
			$($thistr.children()[5]).html($productcolor);
			$($thistr.children()[6]).html($productsize);
			$($thistr.children()[7]).html($producttag);
			$($thistr.children()[8]).html($oldbutton);
			$.getScript("admin/js/manueditproduct.js");
		});

		//when click button "save"
		$.getScript("admin/js/productEditSave.js");
	});
});