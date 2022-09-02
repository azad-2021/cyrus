<?php 
include 'connection.php';
$query = "SELECT * FROM cyrusbackend.orders
join demandbase on orders.OrderID=demandbase.OrderID
join branchdetails on orders.BranchCode=branchdetails.BranchCode
WHERE demandbase.StatusID=2 and branchdetails.BankCode=22 and ZoneRegionCode=667 and orders.Discription like 'Installation of 4 ch. NVR with 4 cameras%'";
$result = $con->query($query);
$c=1;
while($row = mysqli_fetch_array($result)){

	
	print $c.' >> '.$row['OrderID']."<br>";
	$c++;
	$OrderID=$row['OrderID'];
	/*
Ludhiyana Zone
$sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
VALUES ('$OrderID', '1665', '14911', '1')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

$sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
VALUES ('$OrderID', '1666', '14912', '1')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

$sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
VALUES ('$OrderID', '1667', '14913', '1')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

$sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
VALUES ('$OrderID', '565', '14914', '1')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

$sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
VALUES ('$OrderID', '1263', '14915', '1')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

$sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
VALUES ('$OrderID', '853', '14916', '1')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

$sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
VALUES ('$OrderID', '692', '14917', '1')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

$sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
VALUES ('$OrderID', '963', '14919', '1')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

$sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
VALUES ('$OrderID', '412', '14920', '1')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

$sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
VALUES ('$OrderID', '689', '14918', '1')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}


//Ghaziabad Zone
$sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
VALUES ('$OrderID', '1665', '14879', '1')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

$sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
VALUES ('$OrderID', '1666', '14880', '1')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

$sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
VALUES ('$OrderID', '1667', '14881', '1')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

$sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
VALUES ('$OrderID', '565', '14882', '1')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

$sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
VALUES ('$OrderID', '1263', '2969', '1')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

$sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
VALUES ('$OrderID', '853', '14884', '1')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

$sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
VALUES ('$OrderID', '692', '14885', '1')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

$sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
VALUES ('$OrderID', '963', '14887', '1')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

$sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
VALUES ('$OrderID', '412', '14888', '1')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

$sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
VALUES ('$OrderID', '689', '14886', '1')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

//Dehradun Zone

$sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
VALUES ('$OrderID', '1665', '14867', '1')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

$sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
VALUES ('$OrderID', '1666', '14868', '1')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

$sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
VALUES ('$OrderID', '1667', '14869', '1')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

$sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
VALUES ('$OrderID', '565', '14870', '1')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

$sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
VALUES ('$OrderID', '241', '2781', '1')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

$sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
VALUES ('$OrderID', '853', '14872', '1')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

$sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
VALUES ('$OrderID', '692', '14873', '1')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

$sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
VALUES ('$OrderID', '963', '14875', '1')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

$sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
VALUES ('$OrderID', '1626', '2794', '1')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

$sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
VALUES ('$OrderID', '689', '14874', '1')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

*/


$sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
VALUES ('$OrderID', '1665', '14853', '1')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

$sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
VALUES ('$OrderID', '1666', '14854', '1')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

$sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
VALUES ('$OrderID', '1667', '14855', '1')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

$sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
VALUES ('$OrderID', '565', '14856', '1')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

$sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
VALUES ('$OrderID', '1263', '14857', '1')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

$sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
VALUES ('$OrderID', '853', '14858', '1')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

$sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
VALUES ('$OrderID', '692', '14859', '1')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

$sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
VALUES ('$OrderID', '963', '14861', '1')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

$sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
VALUES ('$OrderID', '1626', '14862', '1')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

$sql = "INSERT INTO demandextended (OrderID, ItemID, RateID, ItemQty)
VALUES ('$OrderID', '689', '14860', '1')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}




	
}

?>