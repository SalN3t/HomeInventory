
<?php
/*
	@author: Salah Alarfaj
	@date:	Feb/10/2016
	@license: GPL

*/



include_once 'csl_config.php';



/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
*		Add Section
*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
*/

/*
	Add a New Item To The Database
		Start

	@take: Name, Catagory, Quantity, Location, Comments. From inheritance $_POST
	@param: $picture_name: the name of the picture being uploaded. Empty if none.
		$conn: a connection to database.
	@return: True: added successful.
		 False: Something went wrong.
*/

function addItem($picture_name, $conn){

	$i_name     = $_POST["name"];
	$i_catagory = $_POST["catagory"];
	$i_quantity = $_POST["quantity"];
	$i_location = $_POST["location"];
	$i_comments = $_POST["comments"];

	if($picture_name == ""){
	$i_picture = "none.jpg";
	}else{
	 $i_picture  = $picture_name;
	}

	// prepare and bind
	if( $stmt = $conn->prepare("INSERT INTO inventory (name, catagory, quantity, picture_index, location, comments)
				 VALUES (?, ?, ?, ?, ?, ?)") ){
	$stmt->bind_param("ssssss", $i_name, $i_catagory, $i_quantity, $i_picture, $i_location, $i_comments);
	$stmt->execute();
	$stmt->store_result();
	}else{
	//echo "err: ".mysql_error();
	return false;
	}
	$stmt->close();
	return true;

}
/*
			   END
		Add a New Item To The Database
*/

/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
*		Remove Section
*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
*/

/*
		Start
	    Remove an Item
	1. Get the Picture name associated with the ID.
	2. Remove the picture and the thumbnail from the server file.
	3. Remove the item record from the database.

	@param: $id: the record unique id
		$conn: database connection 
*/
function removeItem($id,$conn){
//  1. Get the Picture name associated with the ID.
	$stmt = $conn->prepare("SELECT picture_index FROM inventory WHERE id=?");
	$stmt->bind_param("s", $id);
        $stmt->execute();
	$stmt->store_result();

	 // If no record found.
	if($stmt->num_rows < 1){
		return false;
	}
	// If the record exists get variables from result.
         $stmt->bind_result($picture_name);
         $stmt->fetch();

//  2. Remove the picture and the thumbnail from the server file.

	if($picture_name != "none.jpg") removePicture($picture_name);

//  3. Remove the item record from the database.

if($stmt = $conn->prepare("Delete From inventory where id= ?")){
        $stmt->bind_param("s", $id);
        $stmt->execute();
	$stmt->store_result();
}else{
//echo "err: ".mysql_error();
return false;
}
        $stmt->close();
return true;
}

/*
	Remove the picture from the server
	@param: $picture_name: the name of the picture 

*/
function removePicture($picture_name){
        system("rm uploads/".$picture_name);
        system("rm uploads/thumbs/".$picture_name);

}
/*
                 END
	    Remove an Item
*/

/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
*			Edit Section
*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
*/

/*
	1. Get the record values
	2. Update the record

*/
function getItems($id,$conn){
if( $stmt = $conn->prepare("SELECT name, catagory, quantity, picture_index, location, comments
                            FROM inventory WHERE id=?") ){
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt->store_result();

	// Bind the result. r_* as in record_*
	$stmt->bind_result($r_name, $r_catagory, $r_quantity, $r_picture_name, $r_location, $r_comments);
	$stmt->fetch();

	$arr= array(
	'r_name'	=> $r_name,
	'r_catagory'	=> $r_catagory,
	'r_quantity'	=> $r_quantity,
	'r_picture_name'=> $r_picture_name,
	'r_location'	=> $r_location,
	'r_comments'	=> $r_comments,
	);

return $arr;
}else{
return false;
}

$stmt->close();
}

/*
	Edit Item by updating records on database.
	The values will be pased from inheriteng this class using POST
	@param:
		$id: record ID to edit.
		$picture_name: will be either same as old one or new name passed 
				the checking will be done outside of this function.
		$conn: the database connection.
	@return: true: sucessful edit.
		false: something went wrong.

*/
function editItem($id,$picture_name,$conn){

	$new_name     = $_POST["new_name"];
        $new_catagory = $_POST["new_catagory"];
        $new_quantity = $_POST["new_quantity"];
        $new_location = $_POST["new_location"];
        $new_comments = $_POST["new_comments"];
	$new_picture  = $picture_name;

        // prepare and bind
       if( $stmt = $conn->prepare("UPDATE inventory 
				SET name=?, catagory=?, quantity=?, location=?, comments=?, picture_index=?
				WHERE id=?")){
        $stmt->bind_param("sssssss", $new_name, $new_catagory, $new_quantity, $new_location, $new_comments, $new_picture, $id);
        $stmt->execute();
        $stmt->store_result();

	}else{
	//echo "err: ".mysql_error();
	return false;
	}
        $stmt->close();
	return true;

}


/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
*			Upload Section
*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
*/

/*
	@Take: $_FIlES are being passing from inheriting this class
	@Return: the name of the file uploaded

	Upload a Picture and a Thumbnail 
		    Start

*/

function upload_file(){
                // Creates the Variables needed to upload the file
                $UploadName = $_FILES['myFile']['name'];

		$findme = '.';
		$pos = strpos($UploadName,$findme);
		$ext = substr($UploadName,$pos,strlen($UploadName));

		$hash = hash('crc32',$UploadName); //Hashing the name to more unique name with the math random

                $UploadName = mt_rand(100000, 999999).$hash.$ext;
                $UploadTmp = $_FILES['myFile']['tmp_name'];
                $UploadType = $_FILES['myFile']['type'];
                $FileSize = $_FILES['myFile']['size'];

                // Removes Unwanted Spaces and characters from the files names of the files being uploaded
	        // $UploadName = preg_replace("#[^a-z0-9.]#i", "", $UploadName);
                // Upload File Size Limit

                if(($FileSize > 3879732)){ //3.7MB
                        die("Error - File to Big");
                }

                // Checks a File has been Selected and Uploads them into a Directory on your Server
                if(!$UploadTmp){
                      //  die("No File Selected, Please Upload Again");
			return "";
                }else{


                        move_uploaded_file($UploadTmp, "uploads/$UploadName");
                        make_thumb("uploads/$UploadName","uploads/thumbs/$UploadName",100);
			return $UploadName;
                }
}

function make_thumb($src, $dest, $desired_width) {

        /* read the source image */
        $source_image = imagecreatefromjpeg($src);
        $width = imagesx($source_image);
        $height = imagesy($source_image);

        /* find the "desired height" of this thumbnail, relative to the desired width  */
        $desired_height = floor($height * ($desired_width / $width));

        /* create a new, "virtual" image */
        $virtual_image = imagecreatetruecolor($desired_width, $desired_height);

        /* copy source image at a resized size */
        imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);

        /* create the physical thumbnail image to its destination */
        imagejpeg($virtual_image, $dest);
}



?>
