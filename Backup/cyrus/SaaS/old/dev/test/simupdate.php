<?php

include('connection.php'); 
include 'session.php';
$username = $_GET['user'];
$query ="SELECT * FROM `sirius_simcard_details` WHERE Phone IS NOT NULL  ORDER BY ID DESC";
$results = mysqli_query($con, $query);  
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
   <title><?php echo $username; ?></title>
   <!-- Bootstrap core CSS -->
   <link href="bootstrap/css/bootstrap.css" rel="stylesheet">  
   <link rel="stylesheet" type="text/css" href="datatable/jquery.dataTables.min.css"/>
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">  
</head>  
<body>  
 <br /><br />  
 <div class="container">
    <br>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #eeeeee;">
      <a class="navbar-brand" href="simtable.php?user=<?php echo $username; ?>"><?php echo $username; ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item">
            <a class="nav-link" target="blank" href="simupdate.php?user=<?php echo $username; ?>"><strong>Update</strong></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php"><strong>Logout</strong></a>
        </li>
    </ul>
</div>
</nav>
<br><br>  
<h3 align="center">Submitted Data by Sim Provider</h3>  
<br />  
<div class="table-responsive">  
   <table class="table-hover table-sm border" id="example" class="display nowrap"> 
      <thead> 
          <tr>
              <th>Bank</th> 
              <th>Zone</th> 
              <th>Branch</th> 
              <th>Gadget</th> 
              <th>Executive</th>
              <th>Remark Executive</th>
              <th>Mobile No</th> 
              <th>Sim NO</th> 
              <th>Sim Type</th> 
              <th>Operator</th> 
              <th>Sim Provider</th>
              <th>Remark Sim Provider</th>
              <th>Sim Issue date</th>
              <th>Recharge Date</th>
              <th>Reactivation Date</th>
              <th>Plan Expiry Phase 1</th>
              <th>Plan Expiry Phase 2</th>
              <th>Action</th>
          </tr>                     
      </thead>                 
      <tbody> 
          <?php  
          while ($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){  
             echo '  
             <tr> 
             <td>'.$row["Bank"].'</td>
             <td>'.$row["Zone"].'</td>  
             <td>'.$row["Branch"].'</td>  
             <td>'.$row["Gadget"].'</td>  
             <td>'.$row["Executive"].'</td>
             <td>'.$row["RemarkOrders"].'</td> 
             <td>'.$row["Phone"].'</td>   
             <td>'.$row["SimNo"].'</td>  
             <td>'.$row["TypeOfSim"].'</td>  
             <td>'.$row["Operator"].'</td>
             <td>'.$row["SimProvider"].'</td>
             <td>'.$row["RemarkSimProvider"].'</td>
             <td>'.$row["SimIssueDate"].'</td>
             <td>'.$row["RechargeDate"].'</td>
             <td>'.$row["ReactivationDate"].'</td>
             <td>'.$row["PlanExpP1"].'</td>
             <td>'.$row["PlanExpP2"].'</td>
             <td><a target="blank" href=\sim/simedit.php?id='.$row["ID"]."&user=".$username.'>Edit</a></td> 
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