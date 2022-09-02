<?php

include('connection.php'); 
include 'session.php';
$card = base64_decode($_GET['card']);

echo $card;

$fileImg='jobcard/'.$card.'.jpg';
$fileImg2='jobcard/'.$card.'.jpeg';
$filePdf='jobcard/'.$card.'.pdf';
//echo $fileImg;
if(file_exists($fileImg)){
    echo 'exist';
    header("location:$fileImg");
}elseif (file_exists($filePdf)) {
    // code...
    header("location:$filePdf");
}elseif(file_exists($fileImg2)){
    echo 'exist';
    header("location:$fileImg2");
}

  $con2 -> close();
  $con3 -> close();
  $con4 -> close();

?>

 