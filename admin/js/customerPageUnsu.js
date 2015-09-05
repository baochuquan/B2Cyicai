//-------------------------------------------------------------
//for customer_management.html
//getScript by customerAmount.js
//to show the users' info of different pages
//-------------------------------------------------------------
$(function(){
	//default display the first page
	$("#unsuccessusers .1page").parent().addClass("active");
	//alert("POST:"+ $(".tab-content").children("[class*=active]").attr("id"));
	$.post("admin/php/customer_page_unsu.php", { start: 0, id: "unsuccessusers"},
		function (data, textStatus){
			$("div[id=unsuccessusers] .userdisplaytable").append(data);
	});
	
	if($("#unsuccessusers .previoustag").next().hasClass("active")) {
		$("#unsuccessusers .previoustag").addClass("disabled");
	}
	if($("#unsuccessusers .nexttag").prev().hasClass("active")) {
		$("#unsuccessusers .nexttag").addClass("disabled");
	}


	//if user click the pagenum
	$('#unsuccessusers .pagination a').click(function(){
		//delete the table content if there exist table item
		$("#unsuccessusers .userdisplaytable tr").remove();	
		var $target = $(this);
		$target.parent().siblings().removeClass("active");
		$target.parent().addClass("active");

		var $start = Number($(this).text());
		$start = ($start - 1) * 20;
		$.post("admin/php/customer_page_unsu.php", { start: $start, id: "unsuccessusers" }, 
			function (data, textStatus){
				$("div[id=unsuccessusers] .userdisplaytable").append(data);

		});
		//deal with pagination "pre" & "next"		
		if($("#unsuccessusers .previoustag").next().hasClass("active")) {
			$("#unsuccessusers .previoustag").addClass("disabled");
		}
		if($("#unsuccessusers .nexttag").prev().hasClass("active")) {
			$("#unsuccessusers .nexttag").addClass("disabled");
		}
	});

	//for manuactivate.js s
	$.getScript("admin/js/manuactivate.js");
	//for manudelete.js s
	$.getScript("admin/js/manudelete.js");
});	
