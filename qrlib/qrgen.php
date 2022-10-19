<?php

include('phpqrcode/qrlib.php');
include('connection.php');  

$query="SELECT * from cyrusbilling.`e-invoice-details` WHERE InvoiceNo='2223CEUP26253'";
$result = mysqli_query($con2,$query);
if(mysqli_num_rows($result)>0)
{

  $row=mysqli_fetch_assoc($result);
  $IRNNo = $row['IRNNo'];
  $QR=$row['QRCode'];
  QRcode::png($QR);
}

    // outputs image directly into browser, as PNG stream
