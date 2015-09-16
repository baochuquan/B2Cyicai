//-------------------------------------------------------------
//for product_management.html
//getScript by productAdd.js
//-------------------------------------------------------------
$(function(){
	$("#sizecollapse button").click(function (event){
		var button = $(event.target);
		var button_id = button.data("whatever");
		var sizename = button.text();
		//gain input content
		var inputcontent = $("#newproductsize").val();
		var newinputcontent = inputcontent;

		if (inputcontent.length == 0) {
			newinputcontent = sizename;
		}
		else { 
			if (inputcontent.indexOf(sizename) == -1) {
				//add sizename into input
				newinputcontent = inputcontent + ',' + sizename;
			}
			else {//has the size, need to delete
				if(inputcontent.indexOf(',' + sizename) != -1) {
					//delete
					var splitcontent = inputcontent.split(',' + sizename);
					newinputcontent = splitcontent.join("");
				}
				else {
					if (inputcontent.indexOf(sizename + ',') != -1) {
						//delete
						var splitcontent = inputcontent.split(sizename + ',');
						newinputcontent = splitcontent.join("");
					}
					else {
						//delete
						var splitcontent = inputcontent.split(sizename);
						newinputcontent = splitcontent.join("");
					}
				}
			}
		}
		/*
		else { 
			// if not have
			if (inputcontent.indexOf(sizename) == -1) {
				//add sizename into input
				newinputcontent = inputcontent + ',' + sizename;
			}
			// if have, need to delete
			else {
				if(inputcontent.indexOf(',' + sizename + ',') != -1) {// in the middle
					//delete
					var splitcontent = inputcontent.split(',' + sizename);
					newinputcontent = splitcontent.join("");
				}
				else {
					if (inputcontent.indexOf(sizename + ',') == 0) {// in the head, but not the only one
						//delete
						var splitcontent = inputcontent.split(sizename + ',');
						newinputcontent = splitcontent.join("");
					}
					else {
						if (inputcontent.indexOf(',' + sizename) == inputcontent.length - sizename.length - 1) {// in the end
							//delete
							var splitcontent = inputcontent.split(',' + sizename);
							newinputcontent = splitcontent.join("");
						}
						else {
							if (inputcontent.indexOf(sizename) == 0 && inputcontent.length == sizename.length) {// in the head & is the only one
								//delete
								var splitcontent = inputcontent.split(sizename);
								newinputcontent = splitcontent.join("");
							};
						}
					}
				}
			}
		}*/
		$("#newproductsize").val(newinputcontent);
	});
});
