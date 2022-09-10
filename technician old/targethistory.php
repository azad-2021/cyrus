<script type = "text/javascript" >  
  function preventBack() { window.history.forward(); }  
  setTimeout("preventBack()", 0);  
  window.onunload = function () { null };  
</script> 




<?php 
//$UID = $_GET['eid'];
//$name = $_GET['name'];
include 'session.php';
include 'connection.php';
$name=$_SESSION['user'];
$UID=$_SESSION['empid'];
$Password=$_SESSION['pass'];
//echo $password;
include 'sheet.php';

date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

$con = $con2;
$con3 = $con3;




$sqlE ="SELECT * FROM employees where EmployeeCode=$UID";
$resultsE = $con->query($sqlE);
$rowE=mysqli_fetch_array($resultsE,MYSQLI_ASSOC);
$Target=$rowE["TargetAmounts"];


$sqlB ="SELECT sum(TotalBilledValue) FROM cyrusbilling.billbook
join cyrusbackend.branchdetails on billbook.BranchCode=branchdetails.BranchCode
where EmployeeCode=$UID and Cancelled=0 and month(BillDate)=(month(current_date())-1) and year(BillDate)=year(current_date()) and BankCode not in (17,29,30,33,43,46,49,50,52)";
$resultsB = $con->query($sqlB);
$rowB=mysqli_fetch_array($resultsB,MYSQLI_ASSOC);
$BilledAmount1=$rowB["sum(TotalBilledValue)"];

$sqlB ="SELECT sum(TotalBilledValue) FROM cyrusbilling.billbook
join cyrusbackend.branchdetails on billbook.BranchCode=branchdetails.BranchCode
where EmployeeCode=$UID and Cancelled=0 and month(BillDate)=(month(current_date())-2) and year(BillDate)=year(current_date()) and BankCode not in (17,29,30,33,43,46,49,50,52)";
$resultsB = $con->query($sqlB);
$rowB=mysqli_fetch_array($resultsB,MYSQLI_ASSOC);
$BilledAmount2=$rowB["sum(TotalBilledValue)"];

$sqlB ="SELECT sum(TotalBilledValue) FROM cyrusbilling.billbook
join cyrusbackend.branchdetails on billbook.BranchCode=branchdetails.BranchCode
where EmployeeCode=$UID and Cancelled=0 and month(BillDate)=(month(current_date())-3) and year(BillDate)=year(current_date()) and BankCode not in (17,29,30,33,43,46,49,50,52)";
$resultsB = $con->query($sqlB);
$rowB=mysqli_fetch_array($resultsB,MYSQLI_ASSOC);
$BilledAmount3=$rowB["sum(TotalBilledValue)"];

if ($Target>0) {

    $PendingTarget1=$Target-$BilledAmount1;
    $PendingTarget2=$Target-$BilledAmount2;
    $PendingTarget3=$Target-$BilledAmount3;


    if ($PendingTarget1<0) {
        $PendingTarget1=0;
    }

    if ($PendingTarget2<0) {
        $PendingTarget2=0;
    }

    if ($PendingTarget3<0) {
        $PendingTarget3=0;
    }
}
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $name; ?></title>
    <!-- Bootstrap core CSS -->
    <link rel="icon" href="cyrus logo.png" type="image/icon type">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="datatable/jquery.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">

    <link rel="stylesheet" type="text/css" href="css/style.css"> 
    <link href='https://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        function preventBack() { window.history.forward(); }
        setTimeout("preventBack()", 0);
        window.onunload = function () { null };
    </script>
    <style type="text/css">
    .border {
        border:5px solid Black;
        padding:5px;
    }
    table, th, td {
      border:1px solid black;
  }
</style>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
<script src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>


    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #E0E1DE;" id="nav">
      <div class="container-fluid" align="center">
        <a class="navbar-brand" href=""><img src="cyrus logo.png" alt="cyrus.com" width="50" height="60">Cyrus Electronics</a>
        <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown" align="center">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="home.php">Home</a>
          </li>

          <?php 
          if ($Password !='cyrus@123'){
            print '<li class="nav-item"><a class="nav-link" aria-current="page" href=';
            echo $sheet ;
            print ' > Expences </a></li>';
        }
        ?>
        <li class="nav-item">
            <a class="nav-link" href="changepass.php">Change Password</a>        
            <li class="nav-item">
                <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
            </li>
        </li>
    </ul>
</div>
</div>
</nav>
<br>
<div class="container" style="resize: both;">
    <h4 align="center">Billing Target History</h4>
    <div class="row">

        <div class="col-lg-4">
            <h5 align="center" style="margin:10px"><?php echo date('M', strtotime("-3 month"));?></h5>
            <div id="piechart4" align="center"></div>
        </div>
        <div class="col-lg-4">
            <h5 align="center" style="margin:10px"><?php echo date('M', strtotime("-2 month"));?></h5>
            <div id="piechart3" align="center"></div>
        </div>
        <div class="col-lg-4">
            <h5 align="center" style="margin:10px"><?php echo date('M', strtotime("-1 month"));?></h5>
            <div id="piechart2" align="center"></div>
        </div>
    </div>
</div>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript">

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart2);
    google.charts.setOnLoadCallback(drawChart3);
    google.charts.setOnLoadCallback(drawChart4);

    function drawChart2() {
      var data = google.visualization.arrayToDataTable([
          ['Pending', 'Achieved'],
          ['Pending : '+ <?php echo $PendingTarget1?>, <?php echo $PendingTarget1?>],
          ['Billed : '+<?php echo $BilledAmount1?>, <?php echo $BilledAmount1?>]
          ]);

      var options = {
        legend: 'none',
        colors: ['red', 'green', ],
        fontSize: 15,
        chartArea: {
            left: "10%",
            top: "20%",
            bottom: "10%",
            height: "90%",
            width: "90%",
        }
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart2'));
    chart.draw(data, options);
}

function drawChart3() {
  var data = google.visualization.arrayToDataTable([
      ['Pending', 'Achieved'],
      ['Pending : '+ <?php echo $PendingTarget2?>, <?php echo $PendingTarget2?>],
      ['Billed : '+<?php echo $BilledAmount2?>, <?php echo $BilledAmount2?>]
      ]);

  var options = {
    legend: 'none',
    colors: ['red', 'green', ],
    fontSize: 15,
    chartArea: {
        left: "10%",
        top: "20%",
        bottom: "10%",
        height: "90%",
        width: "90%",

    }
};

var chart = new google.visualization.PieChart(document.getElementById('piechart3'));
chart.draw(data, options);
}

function drawChart4() {
  var data = google.visualization.arrayToDataTable([
      ['Pending', 'Achieved'],
      ['Pending : '+ <?php echo $PendingTarget3?>, <?php echo $PendingTarget3?>],
      ['Billed : '+<?php echo $BilledAmount3?>, <?php echo $BilledAmount3?>]
      ]);

  var options = {
    colors: ['red', 'green', ],
    fontSize: 15,
    legend: 'none',
    chartArea: {
        left: "10%",
        top: "20%",
        bottom: "10%",
        height: "90%",
        width: "90%",

    }
};

var chart = new google.visualization.PieChart(document.getElementById('piechart4'));
chart.draw(data, options);
}
</script>
</body>
</html>

<?php 
$con->close();
$con2->close();
?>