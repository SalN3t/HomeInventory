<?php
include_once 'assets/includes/functions.php';
include_once 'assets/includes/db_connect.php';

removeItem($_GET['delete_id'],$conn);

header('location: index.html');


?>
