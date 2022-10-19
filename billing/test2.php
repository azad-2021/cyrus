<?php 

$BankDir='G:/InvoiceDemo/Baroda U.P. Bank';
$ZoneDir=$BankDir.'/Etawah';
$BranchDir=$ZoneDir.'/Airwa';
if (file_exists($BankDir)) {

  
  if (file_exists($ZoneDir)) {

    if (file_exists($BranchDir)) {

      echo 1;
    }else{
      mkdir($BranchDir);
    }

  }else{
    mkdir($ZoneDir);
  }




}else{
  mkdir($BankDir);
}