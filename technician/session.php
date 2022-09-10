<?php 
session_start();
$_SESSION['Tuser'];

if (!isset($_SESSION['Tuser'])) {
	header('location:/cyrus/technician/login.php');
}


?>