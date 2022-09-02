<?php

$jobcard=$_GET['cardno'];
$EmployeeID=$_GET['empid'];
//$jobcard = "51476.jpg";

if(copy('jobcard/'.$jobcard.'.jpg', '/home/ashok/Public/onlinejobcards/accepted/'.$jobcard.'.jpg')) {
	// 'home/ashok/public/onlinejobcards/accepted/'
  //echo "It worked!!!";
    header("location:/executive/vexecutive.php?empid=$EmployeeID");
}

else if(copy('jobcard/'.$jobcard.'.pdf', '/home/ashok/Public/onlinejobcards/accepted/'.$jobcard.'.pdf')) {
	// 'home/ashok/public/onlinejobcards/accepted/'
  //echo "It worked!!!";
    header("location:/executive/vexecutive.php?empid=$EmployeeID");
}elseif(copy('jobcard/'.$jobcard.'.jpeg', '/home/ashok/Public/onlinejobcards/accepted/'.$jobcard.'.jpeg')) {
  // 'home/ashok/public/onlinejobcards/accepted/'
  //echo "It worked!!!";
    header("location:/executive/vexecutive.php?empid=$EmployeeID");
}

else {echo "it failed";
//header("location:/html/executive/vexecutive.php?empid=$EmployeeID");
//echo "failed to movie JOBCARD";
}
?>
