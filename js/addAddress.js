//-------------------------------------------------------------
//for myaccount.html
// to add address
//-------------------------------------------------------------
$(document).ready(function() {
	$("#addaddressform :input").blur(function(){
		var $parent = $(this).parent();			//divs
		$parent.parent().removeClass("has-success");
		$parent.parent().find(".alert").remove();
		$parent.find(".fa-check").remove();
		
		//validate receviername
		if( $(this).is('#receivername') ){
			if( this.value == "" ) {
				var errorMsg = "请输入收件人姓名.";
				$parent.after('<div class="col-xs-3 alert alert-danger" role="alert"><span class="fa fa-exclamation-triangle" aria-hidden="true"></span><span>' + errorMsg + '</span></div>');
			}
			else {
				$parent.parent().addClass("has-success");
				$parent.append('<span class="fa fa-check form-control-feedback" aria-hidden="true"></span><span class="sr-only"></span>');
			}
		}
		//validate receviername
		if( $(this).is('#receiverphone') ){
			if( this.value == "" || /^\d{11}$/.test($(this).val()) == false) {
				var errorMsg = "请输入正确的联系方式.";
				$parent.after('<div class="col-xs-4 alert alert-danger" role="alert"><span class="fa fa-exclamation-triangle" aria-hidden="true"></span><span>' + errorMsg + '</span></div>');
			}
			else {
				$parent.parent().addClass("has-success");
				$parent.append('<span class="fa fa-check form-control-feedback" aria-hidden="true"></span><span class="sr-only"></span>');
			}
		}
		//validate recevieraddr
		if( $(this).is('#receiveraddr') ){
			if( this.value == "" ) {
				var errorMsg = "请输入收件地址.";
				$parent.after('<div class="col-xs-3 alert alert-danger" role="alert"><span class="fa fa-exclamation-triangle" aria-hidden="true"></span><span>' + errorMsg + '</span></div>');
			}
			else {
				$parent.parent().addClass("has-success");
				$parent.append('<span class="fa fa-check form-control-feedback" aria-hidden="true"></span><span class="sr-only"></span>');
			}
		}

	});
});

$(function(){
	//validate before submit
	$('#addaddresssubmit').click(function(){
		$("#receivername,#receiverphone,#receiveraddr").trigger('blur');
		var numError = $('form .alert').length;
		if(numError){
			return false;
		}
		var $checkvalue = $("#setdefault").is(":checked") ? 'Y' : 'N';
		$.post("php/add_address.php",{
				user_id: $.cookie()['user_id'],
				receivername: $("#receivername").val(),
				receiverphone: $("#receiverphone").val(),
				receiveraddr: $("#receiveraddr").val(),
				setdefault: $checkvalue,
			},function (data, status){
				//alert("DATA: "+data);
				if(data == "Success"){
					$("#addaddressform").hide();
					$("#addaddrtitle").text("添加成功");
					$(".modal-body").append('<div class="text-center"><span class="center icon fa fa-check fa-4x" style="color:#99ff66"></span></div><p id="timedown" class="text-center"></p>');
					var t1 = setTimeout("$('#timedown').text('3秒后自动跳转.')",0);
					var t2 = setTimeout("$('#timedown').text('2秒后自动跳转.')",1000);
					var t3 = setTimeout("$('#timedown').text('1秒后自动跳转.')",2000);
					var t4 = setTimeout("window.location.assign('myaccount.html')",3000);
				}
				else {
					$("#addaddressform").hide();
					$("#addaddrtitle").text("添加失败");
					$(".modal-body").append('<div class="text-center"><span class="center icon fa fa-times fa-4x" style="color:#ff6633"></span></div><p id="timedown" class="text-center"></p>');
					var t1 = setTimeout("$('#timedown').text('3秒后自动跳转.')",0);
					var t2 = setTimeout("$('#timedown').text('2秒后自动跳转.')",1000);
					var t3 = setTimeout("$('#timedown').text('1秒后自动跳转.')",2000);
					var t4 = setTimeout("window.location.assign('myaccount.html')",3000);
				}				
		});
	});
});


