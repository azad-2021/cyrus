<?php 
include 'connection.php';
$SDate=$_GET['SDate'];
$EDate=$_GET['EDate'];
?>

<!DOCTYPE html>  
<html>  
<head>   
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="author" content="Anant Singh Suryavanshi">
  <title>Work Report</title>
  <link rel="icon" href="cyrus logo.png" type="image/icon type">
  <!-- Bootstrap core CSS -->
  <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
</head>  
<body> 
  <?php 
  //include 'navbar.php';
  //include 'modals.php';

  ?>
  <div class="container">
    <div class="modal fade" id="WorkReportDetails" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Work Report</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="WorkData">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>  

    <div class="col-lg-12 table-responsive">
     <table class="container table table-hover display table-bordered border-primary">
      <h4 align="center">Monthly visit details Employees</h4> 
      <thead> 
       <tr>
        <th>Employee Name</th>
        <th>Visits</th>
      </tr>                     
    </thead>                 
    <tbody>
     <?php 

     $query="SELECT count(distinct vemployeework.BranchName) AS Visits, max(VisitDate) as SDate, min(visitdate) as EDate, vemployeework.`Employee Name`, BranchCode, EmployeeCode FROM cyrusbackend.vemployeework
     join employees on vemployeework.`Employee Name`= employees.`Employee Name`
     join branchdetails on vemployeework.Bankname=branchdetails.BankName and vemployeework.ZoneRegionName=branchdetails.ZoneRegionName and vemployeework.BranchName=branchdetails.BranchName
     WHERE VisitDate BETWEEN '$SDate' AND '$EDate'
     group by `Employee Name` order by `Employee Name`";
     $result=mysqli_query($con,$query);  

     if (mysqli_num_rows($result)>0)
     {
      $Sn=1;

      while($row = mysqli_fetch_array($result)){

        ?>

        <tr>
          <td><?php echo $row['Employee Name']; ?></td>
          <td style="color: blue;" class="Show" id2="<?php echo $row['SDate']; ?>" id="<?php echo $row['EmployeeCode']; ?>" id3="<?php echo $row['EDate']; ?>" id4="<?php echo $row['Employee Name']; ?>"><?php echo $row['Visits']; ?></td>          
        </tr>
        <?php
      }

      $con->close();
      $con2->close();
    }
    ?>
  </tbody>
</table>


</div>
</div>





<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<script type="text/javascript">
  $(document).ready(function() {
    $('table.display').DataTable( {
      responsive: true/*,
      dom: 'Bfrtip',
      buttons: [
      'excelHtml5'
      ]*/
    } );
  } );


  $(document).on('click', '.Show', function(){
  //$('#dataModal').modal();
  var EmployeeCode = $(this).attr("id");
  var EDate=$(this).attr("id2");
  var SDate=$(this).attr("id3");
  var Employee=$(this).attr("id4");
  
  if (EmployeeCode) {
    newObj={EmployeeCode: EmployeeCode, SDate: SDate, EDate: EDate, Employee: Employee};
    const Data = JSON.stringify(newObj);
    console.log(Data);
    $.ajax({
     url:"show.php",
     method:"POST",
     data:{Data:Data},
     success:function(data){
      $('#WorkData').html(data);
      $('#WorkReportDetails').modal('show');
    }
  });
  }
});


</script>
</body>
</html>
