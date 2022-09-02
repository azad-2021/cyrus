<?php 
include"connection.php";

$query="SELECT * FROM cyrusbackend.`reference table` 
join jobcardmain on `reference table`.`Card Number`=jobcardmain.`Card Number` 
WHERE `reference table`.VisitDate>'2021-09-27' and GadgetID=0";
$result = $con->query($query);
while($row=mysqli_fetch_assoc($result)){

	$Jobcard=$row['Card Number'];
	$query="SELECT * FROM cyrusbackend.approval WHERE JobCardNo='$Jobcard'";
	$result2 = $con->query($query);
	$row2=mysqli_fetch_assoc($result2);
	$GadgetID=$row2['GadgetID'];

	$sql = "UPDATE jobcardmain SET GadgetID=$GadgetID WHERE `Card Number`='$Jobcard'";

	if ($con->query($sql) === TRUE) {
		echo "New record created successfully<br>";
	} else {
		echo "Error: " . $sql . "<br>" . $con->error;
	}

}


?>