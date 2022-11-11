<?php 
include 'connection.php';
include 'session.php';

$query="SELECT `reminder lock`.BillID, ExecutiveID, ReceivedDate FROM cyrusbilling.billbook
inner join cyrusbackend.branchs on billbook.BranchCode=branchs.BranchCode
inner join cyrusbackend.`reminder bank` on branchs.ZoneRegionCode=`reminder bank`.ZoneRegionCode
inner join `reminder lock` on billbook.BillID=`reminder lock`.BillID WHERE UserID=0 and ReceivedDate>='2022-11-01';";
$result = mysqli_query($con2,$query);
if(mysqli_num_rows($result)>0)
{
  $count=1;
  while ($arr=mysqli_fetch_assoc($result))
  {
    $BillID=$arr['BillID'];
    $EXEID=$arr['ExecutiveID'];
    $sql = "UPDATE `reminder lock` SET UserID=$EXEID WHERE BillID=$BillID";

    // if ($con2->query($sql) === TRUE) {
    //     echo $count.'-->'.$BillID.'</br>';
    // }else {
    //   echo "Error: " . $sql . "<br>" . $con2->error;

    // }
    $count++;
  }

}
