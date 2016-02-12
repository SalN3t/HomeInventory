<?php
include_once 'csl_config.php';

// Create connection
$conn = new mysqli(HOST, USER, PASSWORD, DATABASE);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
