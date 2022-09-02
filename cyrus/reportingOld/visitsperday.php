<?php

include('connection.php'); 
include 'session.php';
$EXEID=$_SESSION['userid'];
date_default_timezone_set('Asia/Kolkata');
$SDate =date('Y-m-d');
$EDate = date('Y-m-d', strtotime($SDate. ' -7 days'));
/*
$EmployeeID=base64_decode($_GET['empid']);
$query ="SELECT * FROM `approval` Where EmployeeID='$EmployeeID' and posted='0'";

$results = mysqli_query($con, $query); 

$query2 ="SELECT * FROM `employees` Where EmployeeCode='$EmployeeID'";
$results2 = mysqli_query($con, $query2);
$row2=mysqli_fetch_array($results2);
$EmployeeName = $row2["Employee Name"]; 

*/
$query="SELECT count(ApprovalID), VisitDate FROM cyrusbackend.approval
WHERE VisitDate between '$EDate' and '$SDate'
group by VisitDate";
$results = mysqli_query($con, $query);
/*
$dataPoints = array(
    while ($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){ 

        array("y" => $row["count(ApprovalID)"], "label" => $row["VisitDate"])

    }
);*/
 
$dataPoints = array();
foreach ($results as $row) {
  $dataPoints[] = $row;
}
$results = mysqli_query($con, $query);
//print json_encode($dataPoints);
/*
$dataPoints = array(
    array("y" => 25, "label" => "Sunday"),
    array("y" => 15, "label" => "Monday"),
    array("y" => 25, "label" => "Tuesday"),
    array("y" => 5, "label" => "Wednesday"),
    array("y" => 10, "label" => "Thursday"),
    array("y" => 0, "label" => "Friday"),
    array("y" => 20, "label" => "Saturday"),
);*/
?>

<!DOCTYPE html>  
<html>  
<head>   
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <meta name="description" content="">
 <meta name="author" content="Anant Singh Suryavanshi">
 <title><?php ?></title>
 <link rel="icon" href="cyrus logo.png" type="image/icon type">
 <!-- Bootstrap core CSS -->
 <link href="bootstrap/css/bootstrap.css" rel="stylesheet">  
 <link rel="stylesheet" type="text/css" href="datatable/jquery.dataTables.min.css"/>
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css"> 
 <link rel="stylesheet" type="text/css" href="css/style.css"> 
 <link href='https://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
 <script src="bootstrap/js/bootstrap.bundle.min.js"></script> 
 <script type="text/javascript">

     window.onload = function () {

        var chart = new CanvasJS.Chart("chartContainer", {
            title: {
                text: "Visits per Week"
            },
            axisY: {
                title: "Number of Visits"
            },
            data: [{
                type: "line",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();

    }
</script>

</head>  
<body>  

    <?php 
    include 'navbar.php';
    include 'modals.php';
    ?>
    <br/>


    <div class="container"> 

        <h3 align="center">Visits Per Day</h3>  
        <div class="table-responsive">  
         <table class="table table table-hover display table-bordered border-primary" id="example"> 
          <thead> 
              <tr> <th>Date</th>
                  <th>Visits</th> 

              </tr>                     
          </thead>                 
          <tbody> 
              <?php  
              while ($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){ 

                echo ' 
                <td>'.$row["VisitDate"].'</td> 
                <td>'.$row["count(ApprovalID)"].'</td>

                </tr>  
                ';  
            }  


            ?> 

        </table>  
    </div>  
</div>  

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js
"></script>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script src="search.js"></script>

<script>

    $(document).ready(function() {
        var table = $('#example').DataTable( {
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            responsive: true
        } );
    } );

</script>


</body>
</html>

<?php 
$con -> close();
$con2 -> close();
?>