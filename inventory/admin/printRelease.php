<?php      

include('connection.php');  
$EmployeeID = $_POST['EmployeeCode'];  
$Date = $_POST['Sdate']; 
//echo $EmployeeID;
date_default_timezone_set('Asia/Kolkata');
$timestamp =date('y-m-d H:i:s');
$PrintDate = date('D-M-Y',strtotime($timestamp));
//echo $EmployeeID;
$query="SELECT * FROM employees WHERE EmployeeCode=$EmployeeID";
$result=mysqli_query($con,$query);
if (mysqli_num_rows($result)>0){
 $a=mysqli_fetch_assoc($result);
}

?>


<!DOCTYPE html>  
<html>  
<head>   
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="author" content="Anant Singh Suryavanshi">
  <title>Print</title>
  <link rel="icon" href="cyrus logo.png" type="image/icon type">
  <!-- Bootstrap core CSS -->
  <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

  <style type="text/css">
    body{
      font-size: 17px;
    }
    td, th{
      text-align: center;
      font-weight: 650;
    }
  </style>
</head>  
<body> 

  <div class="container">
    <h6 align="center" style="margin:2px;">Employee Name: <?php echo $a["Employee Name"]." "; ?></h6>
    <h6 align="center" style="margin:5px;">Delevery Date: <?php echo $Date; ?></h6>
    <h6 align="center" style="margin:5px;">Print Date: <?php echo $PrintDate; ?></h6>
    <?php 

    $query1="SELECT demandbase.OrderID, BankName, ZoneRegionName, BranchName FROM cyrusbackend.demandbase 
    join orders on demandbase.OrderID=orders.OrderID
    join branchdetails on orders.BranchCode=branchdetails.BranchCode
    WHERE demandbase.StatusID=4 and demandbase.DeliveryDate='$Date' and EmployeeCode=$EmployeeID order by demandbase.orderID;";

    $result1=mysqli_query($con,$query1);
    while($row1 = mysqli_fetch_array($result1)){
      $OrderID=$row1["OrderID"];
      ?>
      <h6 align="center" style="margin:5px;">Issued Materials against Order : <?php echo $row1["OrderID"]."&nbsp;&nbsp;&nbsp; ". $row1["BankName"]."&nbsp;&nbsp;&nbsp; ".$row1["ZoneRegionName"]." &nbsp;&nbsp;&nbsp;".$row1["BranchName"]; ?></h6>
      <table id="" class="container table-hover table-bordered border-primary display responsive nowrap" style="width:100%; margin-bottom: 50px;">
       <thead>
        <tr>        
          <th>Item Name</th>
          <th>Quantity</th>        
        </tr>
      </thead>
      <tbody >
        <?php 
        $OrderID=$row1["OrderID"];
        $query="SELECT ItemName, ItemQty FROM cyrusbackend.demandextended
        join demandbase on demandextended.OrderID=demandbase.OrderID
        join item on demandextended.ItemID=item.ItemID
        WHERE demandbase.StatusID=4 and demandbase.DeliveryDate='$Date' and demandbase.OrderID=$OrderID and demandextended.ItemQty!=0";

        $result=mysqli_query($con,$query);
        while($row = mysqli_fetch_array($result)){

          ?>

          <tr>
            <td><?php echo $row["ItemName"]; ?></td> 
            <td><?php echo $row["ItemQty"]; ?></td>              
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>

</body>
</html>
<?php 
}
$con->close();
$con2->close();
?>
