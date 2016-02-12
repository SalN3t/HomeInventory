<?php

include_once 'assets/includes/functions.php';
include_once 'assets/includes/db_connect.php';

?>

<?php
$nn ="";

if($_FILES['myFile']['name'] != ""){

$nn = upload_file();

}


if(isset($_POST['name'])){
addItem($nn,$conn);
echo "<script> alert('Successfully Added!'); </script>";
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="assets/ico/favicon.png">

<title>ADD</title>

<!-- Bootstrap core CSS -->
<link href="assets/css/bootstrap.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="assets/css/main.css" rel="stylesheet">

<link rel="stylesheet" href="assets/css/font-awesome.min.css">

<link
        href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic'
        rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700'
        rel='stylesheet' type='text/css'>

<script src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/smoothscroll.js"></script>
<script src="assets/js/Chart.js"></script>

<script src="assets/js/add_functions.js"></script>

<style>
table, th, td {
        border-collapse: collapse;
        padding: 8px;
}
</style>



</head>

<body data-spy="scroll" data-offset="0" data-target="#nav"
        style="background-color: #2f2f2f">

        <div id="section-topbar">
                <div id="topbar-inner" >
                        <div class="container" >
                                <div class="row">
                                        <div class="dropdown">
                                                <ul id="nav" class="nav">
                                                        <li class="menu-item"><a class="smoothScroll" href="index.html"
                                                                title="Main Page"><i class="icon-file"></i></a></li>
                                                </ul>
                                                <!--/ uL#nav -->
                                        </div>
                                        <!-- /.dropdown -->

                                        <div class="clear"></div>
                                </div>
                                <!--/.row -->
                        </div>
                        <!--/.container -->

                        <div class="clear"></div>
                </div>
                <!--/ #topbar-inner -->
        </div>
        <!--/ #section-topbar -->

        <div id="intro" style="background-color: #2f2f2f">
                <br>
                <br>
                <br>
                <br>
                <div class="container">
                        <div class="row">

                                <div class="col-lg-2 col-lg-offset-1">
                                        <h5></h5>
                                </div>
                                <div class="col-lg-6">
                                        <div style="color: white; font-weight: bold; font-size: 26px"
                                                class="col-lg-offset-4">Add Record</div>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <!--  ~~~~~START~~~~ -->

                                        <form class="modal-dialog" method="post" action="add.php" enctype="multipart/form-data" onSubmit="return checkInnerValues()" >

                                                Name:<font id="Dot_name">*</font>
							 <input class="form-control" type="text" id="name" name="name"
                                                        placeholder="item name">
                                                        <br>

                                                Catagory: <font id="Dot_catagory">*</font>

							 <select class="form-control" id="catagory" name="catagory" >
                                                        <option>...</option>
                                                        <option>Automative</option>
                                                        <option>Books-and-Notes</option>
                                                        <option>Cellphone-and-Accessories</option>
                                                        <option>Clothing</option>
                                                        <option>Computer-and-Accessories</option>
                                                        <option>Kitchen</option>
                                                        <option>Bedding</option>
                                                        <option>Electronics</option>
                                                        <option>Other...</option>
                                                </select>


                                                <br>
                                                Quantity: <font id="Dot_quantity">*</font>
							<input class="form-control" type="text" id="quantity" name="quantity" placeholder="only numbers"
                                                        onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode <= 8' >
                                                        <br>

                                                Location: <font id="Dot_location">*</font>
 
							<select class="form-control" id="location" name="location">
                                                        <option>...</option>
                                                        <option>Bedroom</option>
                                                        <option>Kitchen</option>
                                                        <option>Bathroom</option>
                                                        <option>Closet</option>
                                                        <option>Basement</option>
                                                        <option>Other...</option>
	                                                </select>


                                                <br>

                                                Comments:<textarea class="form-control" id="comments" name="comments" maxlength="150"
                                                        placeholder="max 150 character"></textarea>
                                                <br>
                                                <input type="file" id="myFile"  onchange="fileSelected();" name="myFile" accept="image/*" capture="camera"> <br>
						<br>
                                                <p id="details"></p>
                                                <br>


                                                <input class="form-control  btn btn-danger" type="submit" value="submit"
                                                        name="submit"><br>

                                        </form>
                                        <br>

                                        <!--   ~~~~~END~~~~ -->

                                </div>
                                <div class="col-lg-3">

                                </div>

                        </div>
                        <!--/.row -->
                </div>
                <!--/.container -->
        </div>
        <!--/ #intro -->




        <!-- Bootstrap core JavaScript
    ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="assets/js/bootstrap.js"></script>
</body>
</html>


