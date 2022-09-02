<?php
include"connection.php";
$ControlerID=6;
$sql ="SELECT count(ApprovalID) as Rejected, month(VDate) as RDate FROM cyrusbackend.approval WHERE Vremark='REJECTED' and year(VDate)=year(current_date()) group by month(VDate);";
$result = mysqli_query($con,$sql);
$dataR=array();
while ($row = mysqli_fetch_array($result)) { 
    $dataR[]=$row;
}

$sql ="SELECT count(ApprovalID) as Accepted, month(VDate) as ADate FROM cyrusbackend.approval WHERE Vremark!='REJECTED' and year(VDate)=year(current_date()) and posted=1 group by month(VDate);";
$result = mysqli_query($con,$sql);
$dataA=array();
while ($row = mysqli_fetch_array($result)) { 
    $dataA[]=$row;
}

// Employees Rejected jobcard
$query="SELECT distinct `Assign To` FROM cyrusbackend.`cyrus regions`
join districts on districts.RegionCode=`cyrus regions`.RegionCode
join employees on districts.`Assign To`=employees.EmployeeCode
where ControlerID=$ControlerID order by `Employee Name`";
$result = $con->query($query);
$data = array();
while ($row = mysqli_fetch_array($result)) { 
    $EmployeeCode=$row["Assign To"];

    $query2 = sprintf("SELECT count(ApprovalID) as CountApproval, `Employee Name` as Employee FROM cyrusbackend.approval
        join employees on approval.EmployeeID=employees.EmployeeCode
        WHERE year(VisitDate)=year(current_date()) and Vremark='REJECTED' and approval.EmployeeID=$EmployeeCode");

    $result2 = $con->query($query2);
    $rowAA = mysqli_fetch_array($result2);
    $data[] = $rowAA;

    $query3 = sprintf("SELECT count(ApprovalID) as CountApproval, `Employee Name` as Employee FROM cyrusbackend.approval
        join employees on approval.EmployeeID=employees.EmployeeCode
        WHERE year(VisitDate)=year(current_date()) and Vremark!='REJECTED' and approval.EmployeeID=$EmployeeCode");

    $result3 = $con->query($query3);
    $rowAA = mysqli_fetch_array($result3);
    $data2[] = $rowAA;
}

//print_r($data);
$sql2 ="SELECT count(ApprovalID), day(VDate) FROM cyrusbackend.approval WHERE posted=1 and month(VDate)=month(current_date()) and Vby like '%Jayant Saxena%' group by VDate;";
$result2 = mysqli_query($con,$sql2);
$chart_data2="";
while ($row2 = mysqli_fetch_array($result2)) { 

    $CountApproval2[]  = $row2['count(ApprovalID)']  ;
    $VDate[] = $row2['day(VDate)'];
}

// Employees Accepted jobcard
$sql2 ="SELECT count(ApprovalID), day(VDate) FROM cyrusbackend.approval WHERE posted=1 and month(VDate)=month(current_date()) and Vby like '%Sanjay Singh%' group by VDate;";
$result2 = mysqli_query($con,$sql2);
$chart_data2="";
while ($row2 = mysqli_fetch_array($result2)) { 

    $CountApprovalS[]  = $row2['count(ApprovalID)']  ;
    $VDateS[] = $row2['day(VDate)'];
}


/*


$query = sprintf("SELECT count(ApprovalID) as CountApproval, `Employee Name` as Employee FROM cyrusbackend.approval
    join employees on approval.EmployeeID=employees.EmployeeCode
    WHERE year(VisitDate)=year(current_date()) and Vremark!='REJECTED'
    group by EmployeeID order by Employee");

//execute query
$result = $con->query($query);
$data2 = array();
foreach ($result as $row) {
  $data2[] = $row;
}
*/


$query = sprintf("SELECT BankName, branchdetails.Address3, sum(billbook.TotalBilledValue - billbook.ReceivedAmount) as PendingPayment FROM cyrusbackend.`cyrus regions`
    join districts on `cyrus regions`.RegionCode=districts.RegionCode
    join branchdetails on districts.`District`=branchdetails.Address3
    join cyrusbilling.billbook on branchdetails.BranchCode=billbook.BranchCode
    WHERE ControlerID=$ControlerID and (billbook.TotalBilledValue - billbook.ReceivedAmount) >1 and month(BillDate)>(month(current_date())-3) and billbook.Cancelled=0
    group by branchdetails.Address3 order by BankName");

$result = $con->query($query);
$data3 = array();


foreach ($result as $row) {
  $data3[] = $row;
}



$query = sprintf("SELECT count(DISTINCT BranchName) As CountJobcard, VisitDate, vemployeework.`Employee Name` as Employee FROM cyrusbackend.`cyrus regions`
    join districts on `cyrus regions`.RegionCode=districts.RegionCode
    join employees on districts.`Assign To`=employees.EmployeeCode
    join vemployeework on employees.`Employee Name`=vemployeework.`Employee Name`
    WHERE ControlerID=$ControlerID and month(VisitDate)=(month(current_date())-1) and year(VisitDate)=year(current_date())
    Group by EmployeeCode order by vemployeework.`Employee Name`;");

$result = $con->query($query);
$data4 = array();
foreach ($result as $row) {
  $data4[] = $row;
}


$query = sprintf("SELECT `Employee Name` As Employee, sum(billbook.TotalBilledValue - billbook.ReceivedAmount) as PendingPayment FROM cyrusbackend.`cyrus regions`
    join districts on `cyrus regions`.RegionCode=districts.RegionCode
    join branchdetails on districts.`District`=branchdetails.Address3
    join cyrusbilling.billbook on branchdetails.BranchCode=billbook.BranchCode
    join employees on districts.`Assign To`=employees.EmployeeCode
    WHERE ControlerID=$ControlerID and (billbook.TotalBilledValue - billbook.ReceivedAmount) >1 and billbook.Cancelled=0
    group by employees.EmployeeCode order by Employee");

$result = $con->query($query);
$data5 = array();
foreach ($result as $row) {
  $data5[] = $row;
}


$query="SELECT `Assign To` FROM cyrusbackend.`cyrus regions`
join districts on `cyrus regions`.RegionCode=districts.RegionCode
join employees on districts.`Assign To`=employees.EmployeeCode
where ControlerID=$ControlerID group by `Assign To` order by `Employee Name`";
$result = $con->query($query);

$data6 = array();
while($row=mysqli_fetch_assoc($result)){
    $EmployeeID=$row['Assign To'];

    $query = sprintf("SELECT `Employee Name` As Employee, (sum(`pending Order`) + sum(`pending Complaints`) +sum(`pending AMC`)) As PendingWork  FROM cyrusbackend.pendingwork
        WHERE EmployeeCode=$EmployeeID");

    $result2 = $con->query($query);
    $row2=mysqli_fetch_assoc($result2);
    $data6[] = $row2;

}



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
      <div class="row">

        <div class="col-lg-6">
            <h5 class="page-header" >Accepted jobcards per month</h5>
            <canvas id="Accepted"></canvas>
        </div>

        <div class="col-lg-6">
            <h5 class="page-header" >Rejected jobcards per month</h5>
            <canvas id="Rejected"></canvas>
        </div>

        <div class="col-lg-12">
            <h5 class="page-header" >Employees reports of Accepted Jobcards of this year</h5>
            <canvas id="AcceptedJ"></canvas>
        </div>

        <div class="col-lg-12">
            <h5 class="page-header" >Employees reports of Rejected Jobcards this year</h5>
            <canvas id="RejectedJ"></canvas>
        </div>

        <div class="col-lg-12">
            <h5 class="page-header" >Pending Payments of Abhineet Anand (District)</h5>
            <div>Pending Payments</div>
            <canvas id="PendingPaymentDistrict"></canvas>
        </div>

        <div class="col-lg-12">
            <h5 class="page-header" >Pending Payments of Abhineet Anand (Employees)</h5>
            <div>Pending Payments</div>
            <canvas id="PendingPaymentEmployee"></canvas>
        </div>

        <div class="col-lg-12">
            <h5 class="page-header" >Total Visits of Last Month</h5>
            <canvas id="VisitsPerDay"></canvas>
        </div>

        <div class="col-lg-12">
            <h5 class="page-header" >Pending Work of Service Engineers</h5>
            <div>Pending Work</div>
            <canvas id="PendingWork"></canvas>
        </div>

        <div class="col-lg-6">
            <h5 class="page-header" >Daily verification report of Jayant Saxena</h5>
            <canvas  id="JayantSaxena"></canvas> 
        </div>

        <div class="col-lg-6">
            <h5 class="page-header" >Daily verification report of Sanjay Singh</h5>
            <canvas  id="SanjaySingh"></canvas> 
        </div>
    </div>
</div>
</body>
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script type="text/javascript">

    var barColors = ["#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff","#5969ff", "#ff407b","#25d5f2","#ffc750","#2ec551","#7040fa","#ff004e","#5969ff"];
    var hoverBackground='rgba(200, 200, 200, 1)';
    var hoverBorder='rgba(200, 200, 200, 1)';

//Employees Rejected Jobcard

var data= <?php print_r(json_encode($data)); ?>;
var EmployeeJ = [];
var RejectedJ = [];

for(var i in data) {
    EmployeeJ.push(data[i].Employee);
    RejectedJ.push(data[i].CountApproval);
}

var xERValues = EmployeeJ;


new Chart("RejectedJ", {
    type: "bar",
    data: {
        labels: xERValues,
        datasets: [{ 
            backgroundColor: barColors,
            data: RejectedJ,
            hoverBackgroundColor: hoverBackground,
            hoverBorderColor: hoverBorder,
            fill: false
        }]
    },
    options: {
        legend: {display: false}
    }
});


// Employees Accepted Jobcards
var data2= <?php print_r(json_encode($data2)); ?>;
var EmployeeA = [];
var AcceptedJ = [];

for(var i in data2) {
    EmployeeA.push(data2[i].Employee);
    AcceptedJ.push(data2[i].CountApproval);
}

var xERValues = EmployeeA;


new Chart("AcceptedJ", {
    type: "bar",
    data: {
        labels: xERValues,
        datasets: [{ 
            backgroundColor: barColors,
            data: AcceptedJ,
            hoverBackgroundColor: hoverBackground,
            hoverBorderColor: hoverBorder,
            fill: false
        }]
    },
    options: {
        legend: {display: false}
    }
});

var data3= <?php print_r(json_encode($data3)); ?>;
var District = [];
var PendingPayment = [];

for(var i in data3) {
    District.push(data3[i].BankName+' '+data3[i].Address3);
    PendingPayment.push(data3[i].PendingPayment);
}

new Chart("PendingPaymentDistrict", {
    type: "bar",
    data: {
        labels: District,
        datasets: [{ 
            backgroundColor: barColors,
            data: PendingPayment,
            hoverBackgroundColor: hoverBackground,
            hoverBorderColor: hoverBorder,
            fill: false
        }]
    },
    options: {
        legend: {display: false}
    }
});

//END of Pending Payment by Address3

var data4= <?php print_r(json_encode($data4)); ?>;
var Jobcard = [];
var EmployeeName = [];

for(var i in data4) {
    EmployeeName.push(data4[i].Employee);
    Jobcard.push(data4[i].CountJobcard);
}


new Chart("VisitsPerDay", {
    type: "bar",
    data: {
        labels: EmployeeName,
        datasets: [{ 
            backgroundColor: barColors,
            data: Jobcard,
            hoverBackgroundColor: hoverBackground,
            hoverBorderColor: hoverBorder,
            fill: false
        }]
    },
    options: {
        legend: {display: false}
    }
});

//END of Perday Visit

var data5= <?php print_r(json_encode($data5)); ?>;
var Employee = [];
var PendingPaymentE = [];

for(var i in data5) {
    Employee.push(data5[i].Employee);
    PendingPaymentE.push(data5[i].PendingPayment);
}

new Chart("PendingPaymentEmployee", {
    type: "bar",
    data: {
        labels: Employee,
        datasets: [{ 
            backgroundColor: barColors,
            data: PendingPaymentE,
            hoverBackgroundColor: hoverBackground,
            hoverBorderColor: hoverBorder,
            fill: false
        }]
    },
    options: {
        legend: {display: false}
    }
});

//END of Pending Payment by Employees

var data6= <?php print_r(json_encode($data6)); ?>;
var Employee = [];
var PendingWork = [];

for(var i in data6) {
    Employee.push(data6[i].Employee);
    PendingWork.push(data6[i].PendingWork);
}

new Chart("PendingWork", {
    type: "bar",
    data: {
        labels:Employee,
        datasets: [{ 
            backgroundColor: barColors,
            data:PendingWork,
            hoverBackgroundColor: hoverBackground,
            hoverBorderColor: hoverBorder,
            fill: false
        }]
    },
    options: {
        legend: {display: false}
    }
});

//END of Pending Work of Employees

new Chart("JayantSaxena", {
    type: "bar",
    data: {
        labels: <?php echo json_encode($VDate); ?>,
        datasets: [{ 
            backgroundColor: barColors,
            data:<?php echo json_encode($CountApproval2); ?>,
            hoverBackgroundColor: hoverBackground,
            hoverBorderColor: hoverBorder,
            fill: false
        }]
    },
    options: {
        legend: {display: false}
    }
});

new Chart("SanjaySingh", {
    type: "bar",
    data: {
        labels: <?php echo json_encode($VDateS); ?>,
        datasets: [{ 
            backgroundColor: barColors,
            data: <?php echo json_encode($CountApprovalS); ?>,
            hoverBackgroundColor: hoverBackground,
            hoverBorderColor: hoverBorder,
            fill: false
        }]
    },
    options: {
        legend: {display: false}
    }
});

var dataR= <?php print_r(json_encode($dataR)); ?>;
var Rejected = [];
var RDate = [];
for(var i in dataR) {
  Rejected.push(dataR[i].Rejected);
  RDate.push(dataR[i].RDate);
}
var xRValues = RDate;


new Chart("Rejected", {
    type: "bar",
    data: {
        labels: xRValues,
        datasets: [{ 
            backgroundColor: barColors,
            data: Rejected,
            hoverBackgroundColor: hoverBackground,
            hoverBorderColor: hoverBorder,
            fill: false
        }]
    },
    options: {
        legend: {display: false}
    }
});

var dataA= <?php print_r(json_encode($dataA)); ?>;
var Accepted = [];
var ADate = [];
for(var i in dataA) {
  Accepted.push(dataA[i].Accepted);
  ADate.push(dataA[i].ADate);
}
var xAValues = ADate;


new Chart("Accepted", {
    type: "bar",
    data: {
        labels: xAValues,
        datasets: [{ 
            backgroundColor: barColors,
            data: Accepted,
            hoverBackgroundColor: hoverBackground,
            hoverBorderColor: hoverBorder,
            fill: false
        }]
    },
    options: {
        legend: {display: false}
    }
});

</script>
</html>