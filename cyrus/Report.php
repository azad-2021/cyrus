<?php 

include 'connection.php';
$ControlerID=6;
$EmployeeID = $_GET['EmployeeCode'];
$SDate=$_GET['SDate'];
$EDate=$_GET['EDate'];

$query="SELECT `Employee Name` FROM cyrusbackend.employees WHERE EmployeeCode=$EmployeeID";
$result = $con->query($query);
$row=mysqli_fetch_assoc($result);
$Employee=$row['Employee Name'];


$query="SELECT sum(`pending Order`) As POrder, sum(`pending Complaints`) as PComplaint, sum(`pending AMC`) as PAMC FROM cyrusbackend.`cyrus regions`
join districts on `cyrus regions`.RegionCode=districts.RegionCode
join employees on districts.`Assign To`=employees.EmployeeCode
join pendingwork on districts.District=pendingwork.Address3
WHERE `Assign To`=$EmployeeID and ControlerID=$ControlerID;";
$result = $con->query($query);
$row=mysqli_fetch_assoc($result);



//print_r(json_encode($dataP));

$POrder=$row['POrder'];
$PComplaint=$row['PComplaint'];
$PAMC=$row['PAMC'];

$query="SELECT count(DISTINCT VisitDate) As Days FROM cyrusbackend.vemployeework
WHERE VisitDate BETWEEN '$SDate' AND '$EDate' and `Employee Name`='$Employee'";
$result = $con->query($query);
$row=mysqli_fetch_assoc($result);
$Days=$row['Days'];

/*
for tota visits
$query="SELECT count(DISTINCT BranchName) As Visits, VisitDate As Day FROM cyrusbackend.vemployeework
WHERE VisitDate BETWEEN '$SDate' AND '$EDate' and `Employee Name`='$Employee'
group by VisitDate Order By VisitDate";
*/

//for visits in executives area
$query="SELECT count(DISTINCT BranchName) As Visits, VisitDate As Day FROM cyrusbackend.vemployeework WHERE VisitDate BETWEEN '$SDate' AND '$EDate' and `Employee Name`='$Employee' group by VisitDate";
$result = $con->query($query);

$data = array();
$Visits=array();
while($row=mysqli_fetch_assoc($result)){
  $data[] = $row;
  $Visits[]=$row['Visits'];
}

$TotalVisits=array_sum($Visits);
$AvgVisits=number_format((float)($TotalVisits/$Days), 2, '.', '');

$query="SELECT BankName, sum(billbook.TotalBilledValue - billbook.ReceivedAmount) as `PendingPayment` FROM cyrusbackend.`cyrus regions`
join districts on `cyrus regions`.RegionCode=districts.RegionCode
join branchdetails on districts.`District`=branchdetails.Address3
join cyrusbilling.billbook on branchdetails.BranchCode=billbook.BranchCode
WHERE (billbook.TotalBilledValue - billbook.ReceivedAmount) >1 and billbook.Cancelled=0 and `Assign To`=$EmployeeID and BankName!='Cyrus'
group by BankName";
$result = $con->query($query);

$Pending = array();
while($row=mysqli_fetch_assoc($result)){
  $Pending[] = $row;
}

$query="SELECT count(ApprovalID) as Accepted, VisitDate FROM cyrusbackend.approval
WHERE VisitDate BETWEEN '$SDate' AND '$EDate' and Vremark!='REJECTED' and EmployeeID=$EmployeeID
group by VisitDate Order By VisitDate";
$result = $con->query($query);

$data3 = array();
while($row=mysqli_fetch_assoc($result)){
  $data3[] = $row;
}


$query="SELECT count(ApprovalID) as Rejected, VisitDate FROM cyrusbackend.approval
WHERE VisitDate BETWEEN '$SDate' AND '$EDate' and Vremark='REJECTED' and EmployeeID=$EmployeeID
group by VisitDate Order By VisitDate";
$result = $con->query($query);
$data4 = array();
while($row=mysqli_fetch_assoc($result)){
  $data4[] = $row;
}
//print_r($data4);

$query="SELECT  VisitDate FROM cyrusbackend.approval
WHERE VisitDate BETWEEN '$SDate' AND '$EDate' and EmployeeID=$EmployeeID and posted=1
group by VisitDate Order By VisitDate";
$result = $con->query($query);
$data5 = array();
while($row=mysqli_fetch_assoc($result)){
  $data5[] = $row;
}
//print_r(json_encode($Pending));

?>



<!DOCTYPE html>
<html lang="en"> 
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <title>Graph</title> 

</head>
<body>
  <div class="container">
<center><h3>Report of <?php echo $Employee; ?></h3><br></center>
    <div class="row">

      <div class="col-lg-12">
        <center>
        <h3 class="page-header" >Visits Per Day</h3>
        <h5>Average Visits per day : <?php echo $AvgVisits; ?><br></h5>
        <h5>Total Visits : <?php echo $TotalVisits; ?></h5>
      </center>
        <canvas id="VisitsPerDay"></canvas>

      </div>

      <div class="col-lg-6">

        <center><h3 class="page-header" >Pending Payments</h3></center>
        <canvas id="PendingPaymentBank"></canvas>

      </div>

 <!--     <div class="col-lg-6">

        <h3 class="page-header" >Total Jobcards</h3>
        <canvas id="AR"></canvas>

      </div>
-->
      <div class="col-lg-6">

        <center><h3 class="page-header" >Pending Work</h3></center>
        <canvas id="myChart"></canvas>

      </div>


      <div class="col-lg-6">

        <center><h3 class="page-header" >Accepted Jobcards</h3></center>
        <canvas id="myChart2"></canvas>
      </div>

      <div class="col-lg-6">
        <center>
        <h3 class="page-header" >Rejected Jobcards</h3>
      </center>
        <canvas id="myChart3"></canvas>
      </div>


<!--


      <div class="col-lg-12">

        <h3 class="page-header" >Analytics Reports of Rejected Jobcards</h3>
        <div>Rejected Jobcards</div>
        <canvas id="mycanvas"></canvas>

      </div>

      <div class="col-lg-12">

        <h3 class="page-header" >Analytics Reports of Accepted Jobcards</h3>
        <div>Rejected Jobcards</div>
        <canvas id="mycanvas2"></canvas>

      </div>


      <div class="row">
        <div class="col-lg-6">

          <h3 class="page-header" >Analytics Reports of Rejected Jobcards</h3>
          <div>Rejected Jobcards</div>
          <canvas  id="chartjs_bar"></canvas> 

        </div>
        <div class="col-lg-6">
          <h3 class="page-header" >Monthly Verification Report of Jayant Saxena</h3>
          <canvas  id="chartjs_bar2"></canvas> 

        </div>
        <div class="col-lg-6">

          <h3 class="page-header" >Monthly Verification Report of Sanjay Singh</h3>
          <canvas  id="chartjs_bar3"></canvas> 
        </div>
      </div>
    -->
  </div>

</div>
</body>
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script type="text/javascript">
  //var ctx = document.getElementById("chartjs_bar").getContext('2d');
  var data= <?php print_r(json_encode($data)); ?>;
  var Day = [];
  var Visits = [];
  for(var i in data) {
    Day.push(data[i].Day);
    Visits.push(data[i].Visits);
  }

  var chartdata = {
    labels: Day,
    datasets : [
    {
      label: 'Visits Per Day',
      backgroundColor: [
      "#5969ff",
      "#ff407b",
      "#25d5f2",
      "#ffc750",
      "#2ec551",
      "#7040fa",
      "#ff004e",
      "#5969ff",
      "#ff407b",
      "#25d5f2",
      "#ffc750",
      "#7040fa",
      "#5969ff",
      "#ff407b",
      "#25d5f2",
      "#ffc750",
      "#2ec551",
      "#7040fa",
      "#ff004e",
      "#5969ff",
      "#ff407b",
      "#25d5f2",
      "#ffc750",
      "#7040fa",
      "#ff004e",
      "#5969ff",
      "#ff407b",
      "#25d5f2",
      "#7040fa",
      "#ff004e",
      "#5969ff",
      "#ff407b",
      "#25d5f2",
      "#ffc750"
      ],
      borderColor: 'rgba(200, 200, 200, 0.75)',
      hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
      hoverBorderColor: 'rgba(200, 200, 200, 1)',
      data: Visits
    }
    ]
  };

  var ctx = $("#VisitsPerDay");

  var barGraph = new Chart(ctx, {
    type: 'bar',
    data: chartdata
  });

//Visits per day

var data2= <?php print_r(json_encode($Pending)); ?>;
var Bank = [];
var PendingPayments = [];
for(var i in data2) {
  Bank.push(data2[i].BankName);
  PendingPayments.push(data2[i].PendingPayment);
}

var chartdata2 = {
  labels: Bank,
  datasets : [
  {
    label: 'Pending Payments',
    backgroundColor: [
    "#5969ff",
    "#ff407b",
    "#25d5f2",
    "#ffc750",
    "#2ec551",
    "#7040fa",
    "#ff004e",
    "#5969ff",
    "#ff407b",
    "#25d5f2",
    "#ffc750",
    "#7040fa",
    "#5969ff",
    "#ff407b",
    "#25d5f2",
    "#ffc750",
    "#2ec551",
    "#7040fa",
    "#ff004e",
    "#5969ff",
    "#ff407b",
    "#25d5f2",
    "#ffc750",
    "#7040fa",
    "#ff004e",
    "#5969ff",
    "#ff407b",
    "#25d5f2",
    "#7040fa",
    "#ff004e",
    "#5969ff",
    "#ff407b",
    "#25d5f2",
    "#ffc750"
    ],
    borderColor: 'rgba(200, 200, 200, 0.75)',
    hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
    hoverBorderColor: 'rgba(200, 200, 200, 1)',
    data: PendingPayments
  }
  ]
};

var ctx2 = $("#PendingPaymentBank");

var barGraph2 = new Chart(ctx2, {
  type: 'bar',
  data: chartdata2
});




var data3= <?php print_r(json_encode($data3)); ?>;
var data4= <?php print_r(json_encode($data4)); ?>;
var data5= <?php print_r(json_encode($data5)); ?>;
var facebook_follower = [];
var VisitDate = [];
var twitter_follower = [];

for(var i in data3) {
  facebook_follower.push(data3[i].Accepted);
}

for(var i in data4) {
  twitter_follower.push(data4[i].Rejected);
}


for(var i in data5) {
  VisitDate.push(data5[i].VisitDate);
}

var chartdata3 = {
  labels: VisitDate,
  datasets: [
  {
    label: "Accepted",
    fill: false,
    lineTension: 0.1,
    backgroundColor: "rgba(59, 89, 152, 0.75)",
    borderColor: "rgba(59, 89, 152, 1)",
    pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
    pointHoverBorderColor: "rgba(59, 89, 152, 1)",
    data: facebook_follower
  },
  {
    label: "Rejected",
    fill: false,
    lineTension: 0.1,
    backgroundColor: "rgba(29, 202, 255, 0.75)",
    borderColor: "rgba(29, 202, 255, 1)",
    pointHoverBackgroundColor: "rgba(29, 202, 255, 1)",
    pointHoverBorderColor: "rgba(29, 202, 255, 1)",
    data: twitter_follower
  }
  ]
};

var ctx3 = $("#AR");

var LineGraph = new Chart(ctx3, {
  type: 'line',
  data: chartdata3
});



var xValues = ["Orders", "Complaints", "AMC"];
var yValues = [<?php echo $POrder ?>, <?php echo $PComplaint ?>, <?php echo $PAMC ?>];
var barColors = ["red", "green","blue"];

new Chart("myChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Pending Work"
    }
  }
});



var dataA= <?php print_r(json_encode($data3)); ?>;
var dataR= <?php print_r(json_encode($data4)); ?>;
var Accepted = [];
var Rejected = [];
var VDate = [];
var RDate = [];
for(var i in dataA) {
  Accepted.push(dataA[i].Accepted);
  VDate.push(dataA[i].VisitDate)
}
for(var i in dataR) {
  Rejected.push(dataR[i].Rejected);
  RDate.push(dataR[i].VisitDate);
}
var xValues = VDate;
var xRValues = RDate;


new Chart("myChart2", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{ 
      data: Accepted,
      borderColor: "green",
      fill: false
    }]
  },
  options: {
    legend: {display: false}
  }
});


new Chart("myChart3", {
  type: "line",
  data: {
    labels: xRValues,
    datasets: [{ 
      data: Rejected,
      borderColor: "red",
      fill: false
    }]
  },
  options: {
    legend: {display: false}
  }
});

</script>


</body>
</html>