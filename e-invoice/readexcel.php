<?php 

require_once 'vendor/shuchkin/simplexlsx/src/SimpleXLSX.php';

use Shuchkin\SimpleXLSX;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);


if ($xlsx = SimpleXLSX::parse('orders.xlsx')) {
    
   $Data=$xlsx->rows();
   //print(gettype($Data));
   for ($i=0; $i <count($Data) ; $i++) { 
       print_r($Data[$i][0]);
       print('</br>');
   }
   
} else {
    echo SimpleXLSX::parseError();
}
?>