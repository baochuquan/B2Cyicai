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
		$("#newproductsize").val(newinputcontent);
	});
});
