<?php 
include 'connection.php';
$Data=!empty($_POST['Data'])?$_POST['Data']:'';
//$ItemZone=295;

if (!empty($Data)){

 $obj = json_decode($Data);
 $OrderID=$obj->OrderID;
 $ZoneCode=$obj->ZoneCode;

 $query="SELECT * FROM rates WHERE Zone=$ZoneCode";
 $result=mysqli_query($con2,$query);
 if (mysqli_num_rows($result)>0)
 {
   echo '<option value="">Select</option><br>';
   while ($arr=mysqli_fetch_assoc($result))
   {

    echo "<option value='".$arr['ItemID']."'>".$arr['Description']."</option><br>";
 }
}
}
?>

