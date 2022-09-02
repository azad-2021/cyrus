<?php 
include 'connection.php';
?>

<!DOCTYPE html>  
<html>  
<head>   
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="author" content="Anant Singh Suryavanshi">
  <title>AMC Report </title>
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
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/staterestore/1.0.1/css/stateRestore.dataTables.min.css">

  <style type="text/css">
  td,th{
    font-size: 17px;

  }
</style>

</head>  
<body> 
  <div class="container" >
    <br><br><br>
    <div class="row g-3">
      <div class="col-md-12">
        <!--<h5 align="center" style="margin-top: 2px;">Search</h5>-->
        <form class="needs-validation form-control rounded-corner" method="POST" style="margin-bottom: 5px;" >
          <div class="row g-3">

            <div class="col-sm-4">
              <select id="Bank" class="form-control rounded-corner" name="Bank" required>
                <option value="">Bank</option>
                <?php
                $BankData="SELECT BankCode, BankName FROM cyrusbackend.amcs
                join branchdetails on amcs.ZoneRegionCode=branchdetails.ZoneRegionCode
                Group by BankCode order by BankName";
                $result=mysqli_query($con,$BankData);
                if (mysqli_num_rows($result)>0)
                {
                  while ($arr=mysqli_fetch_assoc($result))
                  {
                    $d = array("BankName"=>$arr['BankName'], "BankCode"=>$arr['BankCode']);

                    $data= json_encode($d);
                    ?>
                    <option value='<?php echo "$data"; ?>'><?php echo $arr['BankName']; ?></option>
                    <?php
                  }
                }
                ?>
              </select>
            </div>
            <div class="col-sm-4">
              <select id="Zone" class="form-control rounded-corner" name="Zone" required>
                <option value="">Zone</option>
              </select>
            </div>

            <div class="col-sm-4">
              <select id="Quarter" class="form-control rounded-corner" name="Zone" required>
                <option value="">Select Quarter</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
              </select>
            </div>

          </div>
        </form>
      </div>
    </div>
    <div class="col-lg-12 table-responsive" style="margin: 12px;" id="printableArea">
      <center>
        <h4>AMC</h4>
        <h5>
          <div id="BankName" class="col-lg-6"></div>
          <div id="ZoneName" class="col-lg-6"></div>
        </h5>
      </center>
      <table class="table table-hover table-bordered border-primary" >

        <thead> 
         <tr>
          <th>Sr.No.</th>
          <th>Branch</th>
          <th>Jobcard No</th>
          <th>Start Date</th>
          <th>End Date</th>
          <th>Visit Date</th>
          <th>Status</th>
          <th>Gadget</th>
        </tr>                     
      </thead>                 
      <tbody id="AmcData">
      </tbody>
    </table>
  </div>
</div>
<center>
  <button class="btn btn-primary" onclick="printDiv('printableArea');">Print</button>
</center>
<br><br>
<script src="https://cdn.datatables.net/staterestore/1.0.1/js/dataTables.stateRestore.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('table.display').DataTable( {
      responsive: false,
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal( {
            header: function ( row ) {
              var data = row.data();
              return 'Details for '+data[0]+' '+data[1];
            }
          } ),
          renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
            tableClass: 'table'
          } )
        }
      },
      stateSave: true,
    } );
  } );


  $(document).on('change','#Bank', function(){
    var data = $(this).val();
    //console.log(data);
    const obj = JSON.parse(data);
    BankCode = obj.BankCode;
    document.getElementById("BankName").innerHTML=obj.BankName;
    if(BankCode){
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'BankCode':BankCode},
        success:function(result){
          $('#Zone').html(result);

        }
      }); 
    }else{
      $('#Zone').html('<option value="">Zone</option>');
      $('#Branch').html('<option value="">Branch</option>'); 
    }
  });


  $(document).on('change','#Zone', function(){
    var data = $(this).val();
    //console.log(data);
    const obj = JSON.parse(data);
    document.getElementById("ZoneName").innerHTML=obj.ZoneName;
    document.getElementById("Quarter").value='';
  });


  $(document).on('change','#Quarter', function(){
    var Quarter = $(this).val();
    var data= document.getElementById("Zone").value;
    const obj = JSON.parse(data);
    ZoneCode = obj.ZoneCode;

    if(Quarter){
      $.ajax({
        type:'POST',
        url:'dataget.php',
        data:{'ZoneCode':ZoneCode, 'Quarter':Quarter},
        success:function(result){
          $('#AmcData').html(result);

        }
      }); 
    }

  });

  function printDiv(divName) {

    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
  }
</script>
</body>
</html>
<?php 
$con->close();
$con2->close();
?>