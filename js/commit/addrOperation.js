//-------------------------------------------------------------
// for commitorder.html
// get script by getCommitinfo.js
// to manage user operation
//-------------------------------------------------------------
$(function(){
	$(".haveaddress .addressinfo :input").click(function(){
		$(".haveaddress .addressinfo strong").parent().empty();
		$(".haveaddress .addressinfo .alert").removeClass("alert-danger").removeClass("alert");

		var $this = $(".haveaddress .addressinfo :input:checked");
		$($this).parent().parent().parent().children().eq(0).html('<strong><i class="fa fa-map-marker fa-lg"></i> 寄送至 </strong>');
		$($this).parent().parent().parent().addClass("alert").addClass("alert-danger");
	});
});