//-------------------------------------------------------------
//for customer_management.html
//getScript by customerAmount.js
//to show the users' info of different pages
//-------------------------------------------------------------
$(function(){
	//default display the first page
	$("#successusers .1page").parent().addClass("active");
	//alert("POST:"+ $(".tab-content").children("[class*=active]").attr("id"));
	$.post("admin/php/customerManage/customer_page_succ.php", { start: 0, id: "successusers"},
		function (data, textStatus){
			$("div[id=successusers] .userdisplaytable").append(data);
	});
	
	if($("#successusers .previoustag").next().hasClass("active")) {
		$("#successusers .previoustag").addClass("disabled");
	}
	if($("#successusers .nexttag").prev().hasClass("active")) {
		$("#successusers .nexttag").addClass("disabled");
	}


	//if user click the pagenum
	$('#successusers .pagination a').click(function(){
		//delete the table content if there exist table item
		$("#successusers .userdisplaytable tr").remove();	
		var $target = $(this);
		$target.parent().siblings().removeClass("active");
		$target.parent().addClass("active");

		var $start = Number($(this).text());
		$start = ($start - 1) * 20;
		$.post("admin/php/customerManage/customer_page_succ.php", { start: $start, id: "successusers" }, 
			function (data, textStatus){
				$("div[id=successusers] .userdisplaytable").append(data);
		});
		//deal with pagination "pre" & "next"		
		if($("#successusers .previoustag").next().hasClass("active")) {
			$("#successusers .previoustag").addClass("disabled");
		}
		if($("#successusers .nexttag").prev().hasClass("active")) {
			$("#successusers .nexttag").addClass("disabled");
		}
	});
	//for manuactivate.js s
	$.getScript("admin/js/customerManage/manudelete.js");	
});	
