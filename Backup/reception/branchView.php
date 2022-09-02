
<?php  
include('connection.php');   
include 'session.php';
if(isset($_POST["Search"]) and isset($_POST["type"]))
{   
  $Search='%'.$_POST["Search"].'%';
  $Type=$_POST["type"];
  if ($Type=='Name') {
    //$Search='%'.$_POST["Search"].'%';
    $query = "SELECT * FROM branchs WHERE `BranchName` like '$Search'";
  }elseif($Type=='Code') {
    $query = "SELECT * FROM branchs WHERE `Branch_code` like '$Search'";
  }elseif($Type=='District') {
    $query = "SELECT * FROM branchs WHERE `Address3` like '$Search'";
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
        $ZoneCode=$row['ZoneRegionCode'];
        if (!empty($ZoneCode)) {
          $query2 = "SELECT * FROM zoneregions WHERE ZoneRegionCode = $ZoneCode";
          $result2 = $con->query($query2);
          if (mysqli_num_rows($result2)>0)
          {
           $data=mysqli_fetch_array($result2);
           $BankCode=$data['BankCode'];
           //echo $BankCode;
           $query3 = "SELECT * FROM bank WHERE BankCode = $BankCode";
           $result3 = $con->query($query3);
           if (mysqli_num_rows($result3)>0)
           {
             $data2=mysqli_fetch_array($result3);
           }
         }
       }


       print "<tr>";
       print '<td>'.$data2['BankName']."</td>";
       print '<td>'.$data['ZoneRegionName']."</td>";
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