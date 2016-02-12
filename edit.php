<?php
include_once 'assets/includes/functions.php';
include_once 'assets/includes/db_connect.php';


        $i_id   = $_GET["Id"];
        $i_name = $_GET["Name"];
        $i_catagory = $_GET["Catagory"];
        $i_quantity = $_GET["Quantity"];
        $i_location = $_GET["Location"];
        $i_comments = $_GET["Comments"];
        $i_picture  = $_GET["Picture"];

?>
<?php
if($_FILES['myFile']['name'] != "" ){

echo $_POST['old_picture']."\n";

removePicture($_POST['old_picture']);

$new_file_name = upload_File();
editItem($_POST['old_id'], $new_file_name, $conn);

header("location: index.html");

}else if(isset($_POST['new_name'])){

editItem($_POST['old_id'], $_POST['old_picture'], $conn);

header("location: index.html");
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

<title>Edit</title>

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

<script src="assets/js/edit_functions.js"></script>


<style>
table, th, td {
        border-collapse: collapse;
        padding: 8px;
}
</style>


</head>

<body data-spy="scroll" data-offset="0" data-target="#nav"
        style="background-color: #2f2f2f" onLoad="readit()">

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
                                                class="col-lg-offset-4">Edit Record</div>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        
                                        <!--  ~~~~~START~~~~ -->

					<input type="hidden" id="s_id" value=<?php echo $i_id ?>>
					<input type="hidden" id="s_catagory" value=<?php echo $i_catagory; ?>>
					<input type="hidden" id="s_location" value=<?php echo $i_location; ?>>
					<input type="hidden" id="s_picture" value=<?php echo $i_picture;   ?>>


							<form class="modal-dialog" action="edit.php" method="POST" enctype="multipart/form-data">

							Name: <font id="Dot_name">*</font>
							<input class="form-control" id="new_name" name="new_name" type="text" value=<?php echo $i_name; ?> > <br>

								<!--- Catagory select --->
							Catagory:<font id="Dot_catagory">*</font>
							<select class="form-control" id="new_catagory" name="new_catagory" >
                        				<option>...</option>
                       					<option id="c_automativ">Automative</option>
                        				<option id="c_books-and-notes">Books-and-Notes</option>
                      					<option id="c_cellphone-and-accessories">Cellphone-and-Accessories</option>
                        				<option id="c_clothing">Clothing</option>
                        				<option id="c_computer-and-accessories">Computer-and-Accessories</option>
                        				<option id="c_kitchen">Kitchen</option>
                        				<option id="c_bedding">Bedding</option>
                        				<option id="c_electronics">Electronics</option>
                        				<option id="c_other...">Other...</option>
                					</select> 
								<!--- End --> <br>

							Quantity:<font id="Dot_quantity">*</font> 
							<input class="form-control" id="new_quantity" name="new_quantity" type="text" 
               						onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode <= 8'
                 					value=<?php echo $i_quantity; ?> > <br>
								<!-- location select --->
							Location: <font  id="Dot_location">*</font> 
							<select class="form-control" id="new_location" name="new_location" >
                       					<option>...</option>
                        				<option id="l_bedroom">Bedroom</option>
                        				<option id="l_kitchen">Kitchen</option>
                        				<option id="l_bathroom">Bathroom</option>
                        				<option id="l_closet">Closet</option>
                        				<option id="l_basement">Basement</option>
                        				<option id="l_other...">Other...</option>
                							</select> 


								<!--- End --><br>

							Comments:
							<textarea class="form-control" id="new_comments" name="new_comments" maxlength="150" placeholder="max 150 character"
                					value=<?php echo $i_comments; ?>></textarea> <br>

							Picture:  <br>
							<a href="uploads/<?php echo $i_picture; ?>"><img src="uploads/thumbs/<?php echo $i_picture; ?>" ></img></a> <br>

							New Image:
							<input type="file" name="myFile" id="myFile" onchange="fileSelected();" accept="image/*" capture="camera">

							<br>
							<p id="details"></p>
							<br>

							<div id="demo1"> </div>
							<p id="demo2"></p>

							<input type="hidden" id="old_id" name="old_id" value="<?php echo $i_id ?>">
							<input type="hidden" id="old_picture" name="old_picture" value="<?php echo $i_picture ?>">
							<input class ="form-control btn btn-danger" type="submit" value="Submit" name="submit" id="submit" onClick=" return checkInnerValues();" />
							</form>

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


