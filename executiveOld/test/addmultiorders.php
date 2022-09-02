<?php 

$host = "localhost";  
$user = "root";  
$password = '';  
$db_2 = "backend";
$db_3 = "billing";
    //$db ="sim";  

$con = mysqli_connect($host, $user, $password, $db_2);  
if(mysqli_connect_errno()) {  
	die("Failed to connect with MySQL: ". mysqli_connect_error());  
}



//include 'connection.php';

//include 'session.php';
//$User=$_SESSION['userid'];

date_default_timezone_set('Asia/Kolkata');
$timestamp =date('y-m-d H:i:s');
$Date =date('Y-m-d',strtotime($timestamp));


$OrderID=!empty($_POST['OrderID'])?$_POST['OrderID']:'';
$ItemID=!empty($_POST['ItemID'])?$_POST['ItemID']:'';
$RateID=!empty($_POST['RateID'])?$_POST['RateID']:'';
$Qty=!empty($_POST['Qty'])?$_POST['Qty']:'';


if (!empty($OrderID))
{ 

	$Order=json_decode($OrderID);
	$Item=json_decode($ItemID);
	$Rate=json_decode($RateID);
	$qty=json_decode($Qty);

	for ($i=0; $i < count($Order); $i++) { 
		for ($j=0; $j < count($Rate); $j++) { 


			$sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
			VALUES ($Order[$i], $Item[$j], $Rate[$j], $qty[$j])";

			if ($con->query($sql) === TRUE) {


			} else {
				echo "Error: " . $sql . "<br>" . $con->error;
			}

/*
        $sql2 = "UPDATE demandbase SET StatusID=2, ConfirmationDate='$Date', ConfirmedByID=$User  WHERE OrderID=$Order[$i]";

        if ($con->query($sql2) === TRUE) {


        }*/
    }


}
}