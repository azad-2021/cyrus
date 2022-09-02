<?php

include('connection.php'); 
include 'session.php';
$card = $_GET['card'];

$fileImg='technician/jobcard/'.$card.'.jpg';
$filePdf='technician/jobcard/'.$card.'.pdf';
//echo $fileImg;
if(file_exists($fileImg)){
    echo 'exist';
    header("location:$fileImg");
}elseif (file_exists($filePdf)) {
    // code...
    header("location:$filePdf");
}
?>

 