//-------------------------------------------------------------
//for product_management.html
//getScript by productAdd.js
//-------------------------------------------------------------
$(function(){
	$("#tagcollapse button").click(function (event){
		var button = $(event.target);
		var button_id = button.data("whatever");
		var tagname = button.text();
		//gain input content
		var inputcontent = $("#newproducttag").val();
		var newinputcontent = inputcontent;

		if (inputcontent.length == 0) {
			newinputcontent = tagname;
		}
		else { 
			if (inputcontent.indexOf(tagname) == -1) {
				//add tagname into input
				newinputcontent = inputcontent + ',' + tagname;
			}
			else {//has the tag, need to delete
				if(inputcontent.indexOf(',' + tagname) != -1) {
					//delete
					var splitcontent = inputcontent.split(',' + tagname);
					newinputcontent = splitcontent.join("");
				}
				else {
					if (inputcontent.indexOf(tagname + ',') != -1) {
						//delete
						var splitcontent = inputcontent.split(tagname + ',');
						newinputcontent = splitcontent.join("");
					}
					else {
						//delete
						var splitcontent = inputcontent.split(tagname);
						newinputcontent = splitcontent.join("");
					}
				}
			}
		}
		$("#newproducttag").val(newinputcontent);
	});
});