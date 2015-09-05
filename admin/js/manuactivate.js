//-------------------------------------------------------------
//for customerPageUnsu.js
//getScript by customerPageUnsu.js
//to activate users
//bug: excute 2 times --unsolved
//-------------------------------------------------------------
$(function(){
	var useremail;
	$(".manuactivate").on("show.bs.modal", function (event){
		var button = $(event.relatedTarget);
		var content = button.data('whatever');
		var modal = $(this);
		modal.find('.modaluseremail').text(content);
		useremail = content;
		//alert("EMAIL: "+useremail);
	});	
	$("#confirmactivate").click(function(){	
		//alert("DATA: "+useremail);
		$.post("admin/php/manuactivate.php", { usermail: useremail }, function (data, textStatus){
			if(data == "Success") {
				alert("激活成功!");
				window.location.reload();
			}
		});
	});
});