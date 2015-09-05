//-------------------------------------------------------------
//for customerPageUnsu.js $ customerPageSucc.js
//getScript by customerPageUnsu.js & cusomterPageSucc.js
//to delete users
//bug: excute 2 times --unsolved
//-------------------------------------------------------------
$(function(){
	var useremail;
	$(".manudelete").on("show.bs.modal", function (event){
		var button = $(event.relatedTarget);
		var content = button.data('whatever');
		var modal = $(this);
		modal.find('.modaluseremail').text(content);
		useremail = content;
		//alert("EMAIL: "+useremail);
	});	
	$("#confirmdelete").click(function(){	
		//alert("DATA: "+useremail);
		$.post("admin/php/manudelete.php", { usermail: useremail }, function (data, textStatus){
			if(data == "Success") {
				alert("激活成功!");
				window.location.reload();
			}
		});
	});
});