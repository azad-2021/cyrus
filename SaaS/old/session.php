<?php 
session_start();
$_SESSION['user'];
$_SESSION['id'];
if (!isset($_SESSION['user'])) {
	header('location:/cyrus/index.php');
}


?>