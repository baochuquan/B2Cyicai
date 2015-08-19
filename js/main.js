$( document ).ready(function() {
	$('.carousel').carousel({
    	interval: 2000
	});
	
	$(function(){
    	var t = $("#text_box");
    	$("#add").click(function(){        
     	   t.val(parseInt(t.val())+1)
    	});
    	$("#min").click(function(){
    	    t.val(parseInt(t.val())-1)
    	});
	});
});
