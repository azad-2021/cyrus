<?php
/*
if(copy('/technician/jobcard/test.pdf', '/home/ashok/Public/onlinejobcards/file.pdf')) {
	// 'home/ashok/public/onlinejobcards/accepted/'
  echo "It worked!!!";
}
else {echo "it failed";}
*/

//$jobcard=$_GET['cardno'];
$EmployeeID=$_GET['empid'];
$jobcard =  51476;

if(copy('jobcard/'.$jobcard.'.jpg', '/html/'.$jobcard.'.jpg')) {
	// 'home/ashok/public/onlinejobcards/accepted/'
  echo "It worked!!!";
  header("location:/html/executive/vexecutive.php?empid=$EmployeeID");
}elseif(copy('jobcard/'.$jobcard.'.pdf', 'home/ashok/public/onlinejobcards/accepted/'.$jobcard.'.pdf')) {
	// 'home/ashok/public/onlinejobcards/accepted/'
  echo "It worked!!!";
  header("location:/html/executive/vexecutive.php?empid=$EmployeeID");
}
else {echo "it failed";
//header("location:/html/executive/vexecutive.php?empid=$EmployeeID");
}

?>