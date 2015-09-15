//-------------------------------------------------------------
//for product_management.html
//getScript by productAdd.js
//-------------------------------------------------------------
$(function(){
	$("#colorcollapse button").click(function (event){
		var button = $(event.target);
		var button_id = button.data("whatever");
		var colorname = button.text();
		//gain input content
		var inputcontent = $("#newproductcolor").val();
		var newinputcontent = inputcontent;

		if (inputcontent.length == 0) {
			newinputcontent = colorname;
		}
		else { 
			if (inputcontent.indexOf(colorname) == -1) {
				//add colorname into input
				newinputcontent = inputcontent + ',' + colorname;
			}
			else {//has the color, need to delete
				if(inputcontent.indexOf(',' + colorname) != -1) {
					//delete
					var splitcontent = inputcontent.split(',' + colorname);
					newinputcontent = splitcontent.join("");
				}
				else {
					if (inputcontent.indexOf(colorname + ',') != -1) {
						//delete
						var splitcontent = inputcontent.split(colorname + ',');
						newinputcontent = splitcontent.join("");
					}
					else {
						if () {
							//delete
							var splitcontent = inputcontent.split(colorname);
							newinputcontent = splitcontent.join("");
						}
					}
				}
			}
		}
		$("#newproductcolor").val(newinputcontent);
	});
});
