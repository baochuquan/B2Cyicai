$( document ).ready(function() {
	$('.carousel').carousel({
    	interval: 3000
	});
	
	$(function(){
    	var t = $("#text_box");
    	$("#add").click(function(){        
     	   t.val(parseInt(t.val())+1)
    	});
    	$("#min").click(function(){
			if(t.val() <= 0){
				t.val(0);
			}
			else {
    	    	t.val(parseInt(t.val())-1)
			}
    	});
	});
});
