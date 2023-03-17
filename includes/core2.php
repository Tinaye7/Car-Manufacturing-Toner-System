<?php 

session_start();

require_once './php_action/dbconnection.php';

// echo $_SESSION['userId'];

if(!$_SESSION['userId']) {
	header('location:'.$store_url);	
} 



?>