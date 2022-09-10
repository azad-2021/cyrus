<?php

//$jobcard=$_GET['cardno'];
//$EmployeeID=$_GET['empid'];
include"connection.php";
$query ="SELECT JobCardNo FROM cyrusbackend.approval WHERE VDate between '2022-06-29' and '2022-08-02' and Vremark like '%REJECTED%';";
$results = mysqli_query($con2, $query);
$a=0;
while($row=mysqli_fetch_assoc($results)){
  $a++;
  $jobcard =  $row['JobCardNo'];

  if(copy('jobcard/'.$jobcard.'.jpg', '/home/ashok/Public/onlinejobcards/accepted/'.$jobcard.'.jpg')) {
	// 'home/ashok/public/onlinejobcards/accepted/'
    echo $a.'<br>';
    //header("location:/cyrus/reporting/vexecutive.php?empid=$EmployeeID");
  }

  else if(copy('jobcard/'.$jobcard.'.pdf', '/home/ashok/Public/onlinejobcards/accepted/'.$jobcard.'.pdf')) {
	// 'home/ashok/public/onlinejobcards/accepted/'
    echo $a.'<br>';
    //header("location:/cyrus/reporting/vexecutive.php?empid=$EmployeeID");
  }elseif(copy('jobcard/'.$jobcard.'.jpeg', '/home/ashok/Public/onlinejobcards/accepted/'.$jobcard.'.jpeg')) {
  // 'home/ashok/public/onlinejobcards/accepted/'
    echo $a.'<br>';
    //header("location:/cyrus/reporting/vexecutive.php?empid=$EmployeeID");
  }

  else {echo "it failed";
//header("location:/html/executive/vexecutive.php?empid=$EmployeeID");
//echo "failed to movie JOBCARD";
}

}
?>
