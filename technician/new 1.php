<?php
$j="51476.jpg";
if(copy('jobcard/51476.jpg', '/home/ashok/Public/onlinejobcards/rejected/file.jpg')) {
	// 'home/ashok/public/onlinejobcards/accepted/'
  echo "It worked!!!";
}
else {echo "it failed";}
?>
