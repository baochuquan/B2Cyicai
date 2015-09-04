//-------------------------------------------------------------
//for customer_management.html
//to calculate the user amount and show all the users' info
//-------------------------------------------------------------
$(function(){
	var PAGE = 20;

	$.post("admin/php/customer_amount.php", { id1: "allusers", id2: "successusers", id3: "unsuccessusers" }, function (data, textStatus){
		var amountarray = new Array();
		amountarray = $.trim(data).split(" ");
		//alert("NUM0:"+ amountarray[0] + " NUM1:" + amountarray[1] + " NUM2:"+amountarray[2]);
		
		var amount = Math.ceil(amountarray[0]/PAGE);
		var content = "<strong>" + amountarray[0] + "</strong>";
		$("div[id=allusers] .customeramount").append(content);
		//add pages
		var $target = $("div[id=allusers] .previoustag");
		for(var i = 1; i <= amount; i++){
			var content = '<li class="tableitem"><a href="#" class="' + i + 'page">' + i + '</a></li>'
			$target.after(content);
			$target = $target.next();
		}
		$.getScript("admin/js/customerPage.js");		
		
		amount = Math.ceil(amountarray[1]/PAGE);
		content = "<strong>" + amountarray[1] + "</strong>";
		$("div[id=successusers] .customeramount").append(content);
		//add pages
		$target = $("div[id=successusers] .previoustag");
		for(var i = 1; i <= amount; i++){
			var content = '<li class="tableitem"><a href="#" class="' + i + 'page">' + i + '</a></li>'
			$target.after(content);
			$target = $target.next();
		}
		$.getScript("admin/js/customerPageSucc.js");
		
		amount = Math.ceil(amountarray[2]/PAGE);
		content = "<strong>" + amountarray[2] + "</strong>";
		$("div[id=unsuccessusers] .customeramount").append(content);
		//add pages
		$target = $("div[id=unsuccessusers] .previoustag");
		for(var i = 1; i <= amount; i++){
			var content = '<li class="tableitem"><a href="#" class="' + i + 'page">' + i + '</a></li>'
			$target.after(content);
			$target = $target.next();
		}
		$.getScript("admin/js/customerPageUnsu.js");
	});
});
/*
	$("li[role=presentation]").each(function(index, element) {
		var $idstring = $(this).children().attr("aria-controls");
		//alert("NUM: "+$idstring);	
		$.post("admin/php/customer_amount.php", { id: $idstring }, function (data, textStatus){
			var amount = Math.ceil(parseInt("10", data)/PAGE);
			var amountcontent = "<strong>" + data + "</strong>";
			$("div[id=" + $idstring + "] .totalcustomeramount").append(amountcontent);
			
			//add pages 
			var $target = $("div[id=" + $idstring + "] .previoustag");
			for(var i = 1; i <= amount; i++){
				var content = '<li class="tableitem"><a href="#" class="' + i + 'page">' + i + '</a></li>'
				$target.after(content);
				$target = $target.next();
			}
			//alert("DATA: " + data + "\nNUM: "+$idstring);
			//$.getScript("admin/js/customerPage.js");		
		});


	});
*/
