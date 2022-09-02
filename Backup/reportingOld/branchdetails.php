<?php 
include 'connection.php';
include 'session.php';
$EXEID=$_SESSION['userid'];
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
  <title>Branch Details</title>
  <link rel="icon" href="cyrus logo.png" type="image/icon type">
  <!-- Bootstrap core CSS -->
  <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <link rel="stylesheet" type="text/css" href="css/style.css">

  <style type="text/css">
  table.scrolldown {
    width: 100%;

    /* border-collapse: collapse; */
    border-spacing: 0;
    border: 2px solid black;
  }

  /* To display the block as level element */
  table.scrolldown tbody, table.scrolldown thead {
    display: block;
  } 

  thead tr th {
    height: 40px; 
    line-height: 40px;
  }

  table.scrolldown tbody {

    /* Set the height of table body */
    height: 150px; 

    /* Set vertical scroll */
    overflow-y: auto;

    /* Hide the horizontal scroll */
    overflow-x: hidden; 
  }
  td,th{
    min-width: 200px;
    font-size: 18px;
  }
</style> 

</head>  
<body> 
  <?php 
  include 'navbar.php';
  include 'modals.php';
  ?>
  <div class="container">

    <div class="row g-3">
      <div class="col-md-12">
        <!--<h5 align="center" style="margin-top: 2px;">Search</h5>-->
        <form class="needs-validation form-control novalidate my-select4" method="POST" style="margin-bottom: 5px;">
          <div class="row g-3">

            <div class="col-sm-4">
              <select id="Bank" class="form-control my-select3" name="Bank" required>
                <option value="">Bank</option>
                <?php
                $BankData="Select BankCode, BankName from bank order by BankName";
                $result=mysqli_query($con,$BankData);
                if (mysqli_num_rows($result)>0)
                {
                  while ($arr=mysqli_fetch_assoc($result))
                  {
                    ?>
                    <option value="<?php echo $arr['BankCode']; ?>"><?php echo $arr['BankName']; ?></option>
                    <?php
                  }
                }
                ?>
              </select>
            </div>
            <div class="col-sm-4">
              <select id="Zone" class="form-control my-select3" name="Zone" required>
                <option value="">Zone</option>
              </select>
            </div>
            <div class="col-sm-4">
              <select id="Branch" class="form-control my-select3" name="Branch" required>
                <option value="">Branch</option>
              </select>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="modal fade" id="ViewVAT" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">VAT Bill details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="VATData">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>


    <div class="modal fade" id="ViewGST" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">GST Bill Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="GSTData">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>


    <div class="col-lg-12" >
      <br>
      <h4 align="center" style="margin-bottom: 20px">Branch Details</h4>
      <div class="row lg-12" id="BranchData">
      </div>
    </div>


    <div class="col-lg-12" style="margin: 12px; overflow: auto;">
      <table class="table table-hover table-bordered border-primary scrolldown table-responsive"> 
        <h5 style="margin: 2px; text-align: center;">Orders</h5>
        <thead> 
          <tr> 
            <th>Order ID</th>
            <th>Information Date</th>
            
            <th >Attended</th>
            <th >Visit Date</th>
            
            <th >Gadget</th>                        
            <th >Assign Date</th>                            
            <th >Call Verified</th>   
            <th >Employee</th>
            <th style="min-width:500px">Discription</th> 
            <th style="min-width:500px">Executive Remark</th>
                     
          </tr>                     
        </thead>               
        <tbody id="Order">

        </tbody>
      </table>
    </div>
    <div class="col-lg-12" style="margin: 12px; overflow: auto;">
      <table class="table scrolldown table table-hover table-bordered border-primary"> 
        <h5 style="margin: 5px; text-align: center;">Complaints</h5>
        <thead> 
          <tr> 
            <th >Complaint ID</th>
            <th >Information Date</th>
            <th >Attended</th>
            <th>Date of Visit</th>           
            <th >Gadget</th>            
            <th >Assign Date</th>
            <th >Call Verified</th>             
            <th>Employee</th>
            <th style="min-width: 500px;">Discription</th>  
            <th style="min-width: 500px;">Executive Remark</th>
                       
          </tr>                     
        </thead>                 
        <tbody id="Complaints" > 

        </tbody>
      </table> 
    </div>
    <div class="col-lg-12" style="margin: 12px; overflow: auto;">
      <table class="display table table-hover table-bordered border-primary scrolldown" id="resizeMe3">
        <h5 style="margin: 2px; text-align: center;">Jobcard</h5>
        <thead> 
          <tr> 
            <th>Jobcard Number</th>
            <th>Date of Visit</th>
            <th>Gadget</th>
            <th>Employee</th>
            <th style="min-width: 800px;">Service Done</th>
            <th style="min-width: 800px;">Pending Work</th>   
          </tr>                     
        </thead>                 
        <tbody id="jobcard"> 

        </tbody>
      </table>   
    </div>
    <script src="ajax-script.js"></script>
    <script src="search.js"></script>
    <script type="text/javascript">
      /*
      $(document).ready(function() {
        $('table.display').DataTable( {
          responsive: false,
          "scrollY":        "200px",
          "scrollCollapse": true,
          "ordering": false,
          "searching": false,
          "paging":         false
        } );
      } );*/

      var exampleModal = document.getElementById('editQty')
      exampleModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute('data-bs-Qty')
  var Est = button.getAttribute('data-bs-estid')
  var Ap = button.getAttribute('data-bs-ap')
  console.log(Est)
  document.getElementById("es").value = Est;
  document.getElementById("ap").value = Ap;
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //

  // Update the modal's content.
  var modalTitle = exampleModal.querySelector('.modal-title')
  var modalBodyInput = exampleModal.querySelector('.modal-body input')
  //modalTitle.textContent = 'New message to ' + recipient
  modalBodyInput.value = recipient
})



      var exampleModal4 = document.getElementById('deleteItems')
      exampleModal4.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button4 = event.relatedTarget
  // Extract info from data-bs-* attributes
  var Estid = button4.getAttribute('data-bs-esid')
  var Appid = button4.getAttribute('data-bs-appid')
  console.log(Estid)
  console.log(Appid)
  document.getElementById("delest").value = Estid;
  document.getElementById("delap").value = Appid;

})


</script>
</body>
</html>
<?php 
$con->close();
$con2->close();
?>