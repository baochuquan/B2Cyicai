//-------------------------------------------------------------
//for every html
//for logout
//-------------------------------------------------------------
$(document).ready(function() {
	$('#logoutlink').click(function(){	
		var COOKIE_ID = 'user_id';
		var COOKIE_NAME = 'username';
		var COOKIE_LEVEL = 'userlevel';
		$.cookie(COOKIE_ID, "", {path:"/"});
		$.cookie(COOKIE_NAME, "", {path:"/"});
		$.cookie(COOKIE_LEVEL, "", {path:"/"});
		window.location.assign('index.html');		
	});
});
