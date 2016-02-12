<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


$conn = new mysqli("localhost", "root", "toor", "Home");

$result = $conn->query("SELECT id,name, catagory, quantity, picture_index, location, comments FROM inventory");

$outp = "[";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "[") {$outp .= ",";}
    $outp .= '{"Id":"'  . $rs["id"] . '",';
    $outp .= '"Name":"'  . $rs["name"] . '",';
    $outp .= '"Catagory":"'   . $rs["catagory"]        . '",';
    $outp .= '"Quantity":"'   . $rs["quantity"]        . '",';
    $outp .= '"Picture":"'   . $rs["picture_index"]        . '",';
    $outp .= '"Location":"'   . $rs["location"]        . '",';
    $outp .= '"Comments":"'. $rs["comments"]     . '"}';
}
$outp .="]";

$conn->close();

echo($outp);
?>
