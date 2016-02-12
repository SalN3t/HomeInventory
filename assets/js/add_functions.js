//~~~~~~~~~~~ Start
//~~~~~~~~~~~~~ Checking Inner Values in edit.php

        function checkInnerValues() {

                var check = true;
                var name = document.getElementById("name").value;
                var catagory = document.getElementById("catagory").value;
                var quantity = document.getElementById("quantity").value;
                var location = document.getElementById("location").value;

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


