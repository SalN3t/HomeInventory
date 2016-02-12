// Upload Fucntions

// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        function fileSelected() {

                var count = document.getElementById('myFile').files.length;
                document.getElementById('details').innerHTML = "";

                for (var index = 0; index < count; index++)
                {
                        var file = document.getElementById('myFile').files[index];
                        var fileSize = 0;
                        if (file.size > 1024 * 1024)
                                fileSize = (Math.round(file.size * 100 / (1024 * 1024)) / 100)
                                                .toString()
                                                + 'MB';
                        else
                                fileSize = (Math.round(file.size * 100 / 1024) / 100)
                                                .toString()
                                                + 'KB';

                        document.getElementById('details').innerHTML += 'Name: '
                                        + file.name + '<br>Size: ' + fileSize + '<br>Type: '
                                        + file.type;
                        document.getElementById('details').innerHTML += '<p>';
                }
        }
      //------------------------

        function uploadProgress(evt) {
                if (evt.lengthComputable) {
                        var percentComplete = Math.round(evt.loaded * 100 / evt.total);
                        document.getElementById('progress').innerHTML = percentComplete
                                        .toString()
                                        + '%';
                }
                else {
                        document.getElementById('progress').innerHTML = 'unable to compute';
                }
       }

        function uploadComplete(evt) {
                /* This event is raised when the server send back a response */
                alert(evt.target.responseText);
        }

        function uploadFailed(evt) {
                alert("There was an error attempting to upload the file.");
        }

        function uploadCanceled(evt) {
                alert("The upload has been canceled by the user or the browser dropped the connection.");
	}
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
// ~~~~~~~~~~ Start
// ~~~~~~~~~~ Read selected option and select them in edit.php

function readit(){


//document.getElementById('demo1').innerHTML = 'IN';

var selected_catagory = document.getElementById('s_catagory').value;
var selected_location = document.getElementById('s_location').value;

switch(selected_catagory){

case "Automative":
document.getElementById("c_automative").selected="true";

break;
case "Books-and-Notes":
document.getElementById("c_books-and-notes").selected="true";

break;
case "Cellphone-and-Accessories":
document.getElementById("c_cellphone-and-accessories").selected="true";

break;
case "Clothing":
document.getElementById("c_clothing").selected="true";

break;
case "Computer-and-Accessories":
document.getElementById("c_computer-and-accessories").selected="true";

break;
case "Kitchen":
document.getElementById("c_kitchen").selected="true";

break;
case "Bedding":
document.getElementById("c_bedding").selected="true";
break;
case "Electronics":
document.getElementById("c_electronics").selected="true";

break;
case "Other...":
document.getElementById("c_other...").selected="true";

break;

}
switch(selected_location){
case "Bedroom":
 document.getElementById("l_bedroom").selected="true";

break;
case "Kitchen":
 document.getElementById("l_kitchen").selected="true";
break;
case "Bathroom":
 document.getElementById("l_bathroom").selected="true";

break;
case "Closet":
 document.getElementById("l_closet").selected="true";

break;
case "Basement":
 document.getElementById("l_basement").selected="true";

break;
case "Other...":
 document.getElementById("l_other...").selected="true";
break;
}
}
//~~~~~~~~~~~ END 
	
//~~~~~~~~~~~ Start
//~~~~~~~~~~~~~ Checking Inner Values in edit.php 

        function checkInnerValues() {

                var check = true;
                var name = document.getElementById("new_name").value;
                var catagory = document.getElementById("new_catagory").value;
                var quantity = document.getElementById("new_quantity").value;
                var location = document.getElementById("new_location").value;

                if (name == "") {
                        document.getElementById("Dot_name").style.color = "RED";
                        check = false;
                } else {
                        document.getElementById("Dot_name").style.color = "white";
                }
                if (catagory == "...") {
                        document.getElementById("Dot_catagory").style.color = "RED";
                        check = false;
                } else {
                        document.getElementById("Dot_catagory").style.color = "white";
                }
                if (quantity == "") {
                        document.getElementById("Dot_quantity").style.color = "RED";
                        check = false;
                } else {
                        document.getElementById("Dot_quantity").style.color = "white";
                }
                if (location == "...") {
                        document.getElementById("Dot_location").style.color = "RED";
                        check = false;
                } else {
                        document.getElementById("Dot_location").style.color = "white";
                }

                return check;
        }
//~~~~~~~~~~~ END

