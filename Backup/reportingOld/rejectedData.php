<?php

include('connection.php'); 
include 'session.php';
$EXEID=$_SESSION['userid'];
//$EmployeeID=base64_decode($_GET['empid']);
$query ="SELECT * FROM cyrusbackend.approval
left join orders on approval.OrderID=orders.OrderID
join branchdetails on orders.BranchCode=branchdetails.BranchCode
join employees on orders.EmployeeCode=employees.EmployeeCode
WHERE Vremark='REJECTED' and Attended=0 group by approval.OrderID";

$results = mysqli_query($con, $query); 

$query2 ="SELECT * FROM cyrusbackend.approval
left join complaints on approval.ComplaintID=complaints.ComplaintID
join branchdetails on complaints.BranchCode=branchdetails.BranchCode
join employees on complaints.EmployeeCode=employees.EmployeeCode
WHERE Vremark='REJECTED' and Attended=0 group by approval.ComplaintID";

$results2 = mysqli_query($con, $query2);


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
 <title>Rejected Orders and Complaints</title>
 <link rel="icon" href="cyrus logo.png" type="image/icon type">
 <!-- Bootstrap core CSS -->
 <link href="bootstrap/css/bootstrap.css" rel="stylesheet">  
 <link rel="stylesheet" type="text/css" href="datatable/jquery.dataTables.min.css"/>
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css"> 
 <link rel="stylesheet" type="text/css" href="css/style.css"> 
 <link href='https://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
 <script src="bootstrap/js/bootstrap.bundle.min.js"></script> 
</head>  
<body>  

    <?php 
    include 'navbar.php';
    include 'modals.php';
    ?>
    <br />


    <div class="container"> 

        <h3 align="center">Total rejected orders</h3>  
        <div class="table-responsive">  
         <table class="table table-hover table-bordered border-primary" id="example"> 
          <thead> 
              <tr> 
                <th>Employee Name</th>
                <th>Bank</th>
                <th>Zone</th>
                <th>Branch</th>
                <th>Order ID</th>
                <th>Rejection Date</th>
                <th>Jobcard No.</th>
            </tr>                     
        </thead>                 
        <tbody> 
          <?php  
          while ($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){ 



            echo '
            <td>'.$row["Employee Name"].'</td>
            <td>'.$row["BankName"].'</td>
            <td>'.$row["ZoneRegionName"].'</td> 
            <td>'.$row["BranchName"].'</td>
            <td>'.$row["OrderID"].'</td>
            <td>'.$row["VDate"].'</td>
            <td><a target="blank" href=/technician/viewRejected.php?card='.base64_encode($row["JobCardNo"]).'>'.$row["JobCardNo"].'</a></td> 
            </tr>';
        }
        ?> 
    </tbody>
</table>
</div>

<br>
<h3 align="center">Total rejected Complaints</h3>  
<div class="table-responsive">  
 <table class="table table-hover table-bordered border-primary" id="example2"> 
  <thead> 
      <tr> 
        <th>Employee Name</th>
        <th>Bank</th>
        <th>Zone</th>
        <th>Branch</th>
        <th>Complaint ID</th>
        <th>Rejection Date</th>
        <th>Jobcard</th>
    </tr>                     
</thead>                 
<tbody> 
  <?php  
  while ($row=mysqli_fetch_array($results2,MYSQLI_ASSOC)){ 



    echo '
    <td>'.$row["Employee Name"].'</td>
    <td>'.$row["BankName"].'</td>
    <td>'.$row["ZoneRegionName"].'</td> 
    <td>'.$row["BranchName"].'</td>
    <td>'.$row["ComplaintID"].'</td>
    <td>'.$row["VDate"].'</td>
    <td><a target="blank" href=/technician/view.php?card='.base64_encode($row["JobCardNo"]).'>'.$row["JobCardNo"].'</a></td>
    </tr>';
}
?> 
</tbody>
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
    $(document).ready(function() {
        var table = $('#example2').DataTable( {
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