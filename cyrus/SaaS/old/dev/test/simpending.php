
<?php

include('connection.php'); 
include 'session.php';
$username = $_SESSION['user'];
$query ="SELECT DISTINCT `OperatorID` FROM `orders` WHERE Status='0' and SimProvider='Cyrus' ORDER BY OrderID DESC";
$results = mysqli_query($con, $query);

$query2 ="SELECT * FROM `orders` WHERE Status='0' and SimProvider='Cyrus' ORDER BY OrderID";
$result2 = mysqli_query($con, $query2);  
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
    <link rel="icon" href="cyrus logo.png" type="image/icon type">
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">  
    <link rel="stylesheet" type="text/css" href="datatable/jquery.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css"> 
    <link rel="stylesheet" type="text/css" href="css/style.css"> 
    <link href='https://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
</head>  
<body>   
    
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #E0E1DE;" id="nav">
      <div class="container-fluid" align="center">
        <a class="navbar-brand" href="index.html"><img src="cyrus logo.png" alt="cyrus.com" width="50" height="60">Cyrus Electronics</a>
        <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-md-center" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="simtable.php">Home</a>
          </li>
          <li class="nav-item">
          </li>
          <li class="nav-item">
            <a class="nav-link active" target="blank" href="simpending.php?">Pending Orders</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" target="blank" href="sim.php?">Release Sim</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" target="blank" href="viewsim.php?">Active Sim Cards</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
        </li>
    </ul>
</div>
</div>
</nav>
<div class="container">
    <br><br>   
    
    <h3 align="center">Total Pending Orders for Prepaid Sim Card</h3>   
    <div class="table-responsive">  
        <table class="table table-hover table-sm border">
            <thead> 
                <tr> 
                    <th scope="col">Total Pending Orders</th> 
                    <th scope="col">Operators</th>
                    <th scope="col">Sim Type</th>
                </tr>                     
            </thead>                 
            <tbody> 


                <?php

                $LastOperatorID='';
                while ($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){   

                    $OperatorID=$row["OperatorID"];
                    if ($LastOperatorID==$OperatorID) {

                        $OperatorID=0;
                    }

                    if (is_null($OperatorID)==false) {

                        $query3 ="SELECT * FROM `orders` WHERE `SimProvider`='Cyrus' and Status='0' and OperatorID=$OperatorID and SimType='Prepaid'";
                        $result3 = mysqli_query($con, $query3);
                        $TotalOrders=0;
                        while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC)){
                            $TotalOrders++;
                        }

                        $query ="SELECT * FROM `operators` WHERE OperatorID=$OperatorID";
                        $resultOperator = mysqli_query($con, $query);
                        $row2=mysqli_fetch_array($resultOperator,MYSQLI_ASSOC);

                        if (empty($row2)==false) {

                            $Operator=$row2["Operator"];
                        }

                        $LastOperatorID=$OperatorID;

                        if ($TotalOrders>0) {

                            echo '  
                            <tr>
                            <td>'.$TotalOrders.'</td> 
                            <td>'.$Operator.'</td>
                            <td>Prepaid</td>
                            ';
                        }
                    }
                } 

                ?> 
            </tbody>
        </table> 
        <br><br><br><br><br>

        <?php 

        $query ="SELECT DISTINCT * FROM `orders` WHERE `SimProvider`='Cyrus' ORDER BY OrderID DESC";
        $results = mysqli_query($con, $query);

        $query2 ="SELECT * FROM `orders` WHERE `SimProvider`='Cyrus' ORDER BY OrderID";
        $result2 = mysqli_query($con, $query2);  
        ?> 


        <h3 align="center">Total Pending Orders of Postpaid Sim Cards</h3>  
        <br/>
        <table class="table table-hover table-sm border">
            <thead> 
                <tr> 
                    <th>Total Pending Orders</th> 
                    <th>Operators</th>
                    <th>Sim Type</th>
                </tr>                     
            </thead>                 
            <tbody> 
                <?php

                $LastOperatorID='';
                while ($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){  

                    $OperatorID=$row["OperatorID"];
                    if ($LastOperatorID==$OperatorID) {

                        $OperatorID=0;
                    }

                    if (is_null($OperatorID)==false) {

                        $query3 ="SELECT * FROM `orders` WHERE `SimProvider`='Cyrus' and Status='0' and OperatorID=$OperatorID and SimType='Postpaid'";
                        $result3 = mysqli_query($con, $query3);
                        $TotalOrders=0;
                        while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC)){
                            $TotalOrders++;
                        }

                        $query ="SELECT * FROM `operators` WHERE OperatorID=$OperatorID";
                        $resultOperator = mysqli_query($con, $query);
                        $row2=mysqli_fetch_array($resultOperator,MYSQLI_ASSOC);

                        if (empty($row2)==false) {

                            $Operator=$row2["Operator"];
                        }

                        $LastOperatorID=$OperatorID;

                        if ($TotalOrders>0) {

                            echo '  
                            <tr>
                            <td>'.$TotalOrders.'</td> 
                            <td>'.$Operator.'</td>
                            <td>Postpaid</td>
                            ';
                            break;

                        }
                    }
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