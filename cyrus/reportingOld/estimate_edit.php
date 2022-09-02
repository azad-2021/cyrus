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
  <title>Edit Estimate</title>
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


    <div class="modal fade" id="Estimate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Estimates</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="EstimateData">

          </div>
          <div class="modal-footer">

            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button data-bs-toggle="modal" data-bs-target="#AddItems" class="btn btn-primary" id="Add" name="Delete">Add Items</button>
          </div>
        </div>
      </div>
    </div>



    <div class="modal fade" id="editQty" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Enter New Quantity</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <input  type="text" class="d-none est" id="es" name="">
          <input type="text" class="apd d-none" id="ap" name="">

          <div class="modal-body">
            <form>
              <div class="mb-3">

                <input type="number" class="form-control Qty" id="newQty">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" data-bs-dismiss="modal" class="btn btn-primary QtyUpdate">Save</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="deleteItems" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <h5>Do You want to delete this item ?</h5>
          </div>
          <div class="modal-footer">
            <input class="d-none" type="text" id="delest" name="">
            <input class="d-none" type="text" id="delap" name="">
            <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Close</button>
            <button type="button" data-bs-dismiss="modal" class="btn btn-danger Delete">Yes</button>
          </div>
        </div>
      </div>
    </div>


    <div class="modal fade" id="AddItems" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Items</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <input type="text" class="apd d-none" id="apd" name="">

          <div class="modal-body">
            <form>
              <div class="mb-3">
                <select id="items" class="form-control my-select3" name="Items" required>
                  <option value="">Select</option>
                </select>
              </div>
              <center>
                <div class="mb-3">
                  <label class="my-select3">Enter Quantity</label><br>
                  <input class="my-select3" type="number" name="" id="addQty" class="form-control">
                </div>
              </center>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" data-bs-dismiss="modal" class="btn btn-primary addItems">Save</button>
          </div>
        </div>
      </div>
    </div>

    <table class="table table-hover table-bordered border-primary display">
      <thead>
        <tr>
          <th scope="col">Approval ID</th>
          <th scope="col">Emplyee</th>
          <th scope="col">Action</th>
          <th scope="col">Print</th> 
        </tr>
      </thead>
      <tbody id="estimateView">

      </tbody>
    </table>
  </div>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
  <script src="search.js"></script>
  <script src="ajax-script.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('table.display').DataTable( {
        responsive: false
      } );
    } );

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