//-------------------------------------------------------------
//for customer_management.html
//getScript by customerAmount.js
//to show the users' info of different pages
//-------------------------------------------------------------
$(function(){
	//default display the first page
	$("#allusers .1page").parent().addClass("active");
	//alert("POST:"+ $(".tab-content").children("[class*=active]").attr("id"));
	$.post("admin/php/customer_page.php", { start: 0, id: "allusers"},
		function (data, textStatus){
			$("div[id=allusers] .userdisplaytable").append(data);
	});
	
	if($("#allusers .previoustag").next().hasClass("active")) {
		//alert("YES");
		$("#allusers .previoustag").addClass("disabled");
	}
	if($("#allusers .nexttag").prev().hasClass("active")) {
		$("#allusers .nexttag").addClass("disabled");
	}


	//if user click the pagenum
	$('#allusers .pagination a').click(function(){
		//delete the table content if there exist table item
		$("#allusers .userdisplaytable tr").remove();	
		var $target = $(this);
		$target.parent().siblings().removeClass("active");
		$target.parent().addClass("active");

		var $start = Number($(this).text());
		$start = ($start - 1) * 20;
		$.post("admin/php/customer_page.php", { start: $start, id: "allusers" }, 
			function (data, textStatus){
				$("div[id=allusers] .userdisplaytable").append(data);
		});
		//deal with pagination "pre" & "next"		
		if($("#allusers .previoustag").next().hasClass("active")) {
			$("#allusers .previoustag").addClass("disabled");
		}
		if($("#allusers .nexttag").prev().hasClass("active")) {
			$("#allusers .nexttag").addClass("disabled");
		}
	});
	//for manuactivate.js
	$.getScript("admin/js/manuactivate.js");
});	
