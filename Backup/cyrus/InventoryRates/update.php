<?php 
include ('connection.php');
date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));
$Enabled=!empty($_POST['Enabled'])?$_POST['Enabled']:'';

if (!empty($Enabled))
{   
    if ($Enabled==2) {
        $Enabled=0;
    }
    $RateID=!empty($_POST['RateID'])?$_POST['RateID']:'';

    $sql="UPDATE cyrusbilling.rates set Enable=$Enabled, UpdateON='$Date' WHERE RateID=$RateID";
    if ($con2->query($sql) === TRUE) {
    } else {
        $myfile = fopen("error.txt", "w") or die("Unable to open file!");
        fwrite($myfile, $con2->error);
        fclose($myfile);
        echo "Error: " . $sql . "<br>" . $con2->error;
    }

}


$ItemIDC=!empty($_POST['ItemIDC'])?$_POST['ItemIDC']:'';

if (!empty($ItemIDC))
{   

    $RateIDC=!empty($_POST['RateIDC'])?$_POST['RateIDC']:'';

    $sql="UPDATE cyrusbilling.rates set ItemID=$ItemIDC, UpdateON='$Date' WHERE RateID=$RateIDC";
    if ($con2->query($sql) === TRUE) {
    } else {
        $myfile = fopen("error.txt", "w") or die("Unable to open file!");
        fwrite($myfile, $con2->error);
        fclose($myfile);
        echo "Error: " . $sql . "<br>" . $con2->error;
    }

}


$Desc=!empty($_POST['Desc'])?$_POST['Desc']:'';

if (!empty($Desc))
{   

    $RateID=!empty($_POST['RateID'])?$_POST['RateID']:'';

    $sql="UPDATE cyrusbilling.rates set Description='$Desc', UpdateON='$Date' WHERE RateID=$RateID";
    if ($con2->query($sql) === TRUE) {
    } else {
        $myfile = fopen("error.txt", "w") or die("Unable to open file!");
        fwrite($myfile, $con2->error);
        fclose($myfile);
        echo "Error: " . $sql . "<br>" . $con2->error;
    }

}



$RateC=!empty($_POST['RateC'])?$_POST['RateC']:'';

if (!empty($RateC))
{   

    $RateIDRC=!empty($_POST['RateIDRC'])?$_POST['RateIDRC']:'';

    $sql="UPDATE cyrusbilling.rates set Rate=$RateC, UpdateON='$Date' WHERE RateID=$RateIDRC";
    if ($con2->query($sql) === TRUE) {
    } else {
        $myfile = fopen("error.txt", "w") or die("Unable to open file!");
        fwrite($myfile, $con2->error);
        fclose($myfile);
        echo "Error: " . $sql . "<br>" . $con2->error;
    }

}

?>