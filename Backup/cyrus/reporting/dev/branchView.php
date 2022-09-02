
<?php  
include('connection.php');   

if(isset($_POST["Search"]) and isset($_POST["type"]))
{   
  $Search='%'.$_POST["Search"].'%';
  $Type=$_POST["type"];
  if ($Type=='Name') {
    //$Search='%'.$_POST["Search"].'%';
    $query = "SELECT * FROM branchdetails WHERE `BranchName` like '$Search'";
  }elseif($Type=='Code') {
    $query = "SELECT * FROM branchdetails WHERE `Branch_code` like '$Search'";
  }elseif($Type=='District') {
    $query = "SELECT * FROM branchdetails WHERE `Address3` like '$Search'";
  }
  
  $result = $con->query($query);
}
?>

<div class="col-lg-12" style="margin: 12px;">
  <table class="container table table-hover table-bordered border-primary table-responsive"> 
    <thead> 
      <tr> 
        <th style="min-width:150px;">Bank</th>
        <th style="min-width:150px;">Zone</th>
        <th style="min-width:150px;">Branch Name</th>
        <th style="min-width:150px;">Branch Code</th>           
        <th style="min-width:150px;">Phone</th>
        <th style="min-width:150px;">Mobile</th>
        <th style="min-width:150px;">Email</th>                     
      </tr>                     
    </thead>                 
    <tbody>
      <?php

      if (mysqli_num_rows($result)>0)
      {
       while($row = mysqli_fetch_array($result)){


       print "<tr>";
       print '<td>'.$row['BankName']."</td>";
       print '<td>'.$row['ZoneRegionName']."</td>";
       print '<td>'.$row['BranchName']."</td>";
       print "<td>".$row['Branch_code']."</td>";
       print '<td>'.$row['PhoneNo']."</td>"; 
       print "<td>".$row['Mobile Number']."</td>";             
       print "<td>".$row['Email']."</td>";
       print "</tr>";
     }

     $con->close();
   }
   ?>
 </tbody>
</table>  
</div>