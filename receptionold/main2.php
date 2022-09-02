
<?php 

include 'data.php';
include 'connection.php';
include 'session.php';
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
  <title>Home</title>
  <link rel="icon" href="cyrus logo.png" type="image/icon type">
  <!-- Bootstrap core CSS -->
  <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
  <script src="Bootstrap/js/bootstrap.bundle.min.js"></script>
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
                $result=mysqli_query($conn,$BankData);
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

    <div class="modal fade" id="dataModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Order details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="OrdersData">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
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


    <div class="modal fade" id="dataModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Jobcard details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="JobcardData">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="dataModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Complaint details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="ComplaintsData">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>



    <div class="modal fade" id="PhoneUpdate" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Phone Number</h5>
          </div>
          <div class="modal-body">

            <form class="row g-3 needs-validation" novalidate id="form2" name="form">
              <div class="col-md-4 d-none">
                <label for="validationCustom04" class="form-label">Branch</label>
                <select id="BranchC" class="form-control my-select3" name="BranchCode" required>
                </select>
                <div class="invalid-feedback">
                  Please select a valid Branch.
                </div>
              </div>
              <center>
                <div class="col-md-4 modal-body-phone">
                  <label for="validationCustom01" class="form-label ">Phone</label>
                  <input type="text" class="form-control my-select2 " id="Phone" name="Phone" required>
                </div>
              </center>
            </div>

            <div class="modal-footer">

              <button type="button" onclick="UpdatePhone()" data-bs-dismiss="modal" class="btn btn-primary">Submit</button>
              <input class="btn btn-secondary" type="reset"  data-bs-dismiss="modal" value="Close">


            </div>
          </form>
        </div>
      </div>
    </div>


    <div class="modal" id="FindOrder" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Find Order</h5>
          </div>
          <div class="modal-body">

            <form class="row g-3 needs-validation" novalidate id="form2" name="form">
              <center>
                <div class="col-md-4">
                  <label for="validationCustom01" class="form-label ">Enter Order ID</label>
                  <input type="text" class="form-control my-select2" id="forder" name="forder" required>
                </div>
              </center>
            </div>

            <div class="modal-footer">
              <input data-bs-dismiss="modal" class="btn btn-primary search_order" value="Search">
              <input class="btn btn-secondary" type="reset"  data-bs-dismiss="modal" value="Close">


            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="ViewOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="ViewOrderData">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>


    <div class="modal" id="FindComplaint" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Find Complaint</h5>
          </div>
          <div class="modal-body">

            <form class="row g-3 needs-validation" novalidate id="formC" name="form">
              <center>
                <div class="col-md-4">
                  <label for="validationCustom01" class="form-label ">Enter Complaint ID</label>
                  <input type="text" class="form-control my-select2" id="fcomplaint" name="fcomplaint" required>
                </div>
              </center>
            </div>

            <div class="modal-footer">
              <input data-bs-dismiss="modal" class="btn btn-primary search_complaint" value="Search">
              <input class="btn btn-secondary" type="reset"  data-bs-dismiss="modal" value="Close">
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="ViewComplaint" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Complaint Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="ViewComplaintData">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>


    <div class="modal" id="FindJobcard" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Find Jobcard</h5>
          </div>
          <div class="modal-body">

            <form class="row g-3 needs-validation" novalidate id="formJ" name="form">
              <center>
                <div class="col-md-4">
                  <label for="validationCustom01" class="form-label ">Enter Jobcard Number</label>
                  <input type="text" class="form-control my-select2" id="fjobcard" name="fjobcard" required>
                </div>
              </center>
            </div>

            <div class="modal-footer">
              <input data-bs-dismiss="modal" class="btn btn-primary search_jobcard" value="Search">
              <input class="btn btn-secondary" type="reset"  data-bs-dismiss="modal" value="Close">
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="ViewJobcard" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Job Card Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="ViewJobcardData">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal" id="Discription" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Find Jobcard</h5>
          </div>
          <div class="modal-body">

            <form class="row g-3 needs-validation" novalidate id="formd" name="form">
              <center>
                <div class="col-md-4">
                  <label for="validationCustom01" class="form-label ">Enter Jobcard Number</label>
                  <input type="text" class="form-control my-select2" id="discription" name="discription" required>
                </div>
              </center>
            </div>

            <div class="modal-footer">
              <input data-bs-dismiss="modal" class="btn btn-primary search_jobcard" value="Search">
              <input class="btn btn-secondary" type="reset"  data-bs-dismiss="modal" value="Close">
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="DiscriptionUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" style="$modal-content-border-color:        rgba($black, .6);">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form class="row g-3 needs-validation" novalidate id="formd" name="form">
              <div class="col-md-12 Discription">
                <label for="validationCustom01" class="form-label ">Update Discription</label>
                <input type="text" class="form-control my-select2" id="disc" name="disc" required>
              </div>
              <div class="col-md-12 OrderID d-none">
                <label for="validationCustom01" class="form-label ">Update Discription</label>
                <input type="text" class="form-control my-select2 " id="OrderID1" name="discription" required>
              </div>
              <div class="col-md-12 BranchCode d-none">
                <label for="validationCustom01" class="form-label ">Update Discription</label>
                <input type="text" class="form-control my-select2 " id="brc" name="brc" required>
              </div>
            </div>

            <div class="modal-footer">
              <input data-bs-dismiss="modal" class="btn btn-primary update_disc" value="Update">
              <input class="btn btn-secondary" type="reset"  data-bs-dismiss="modal" value="Close">
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="InfoDateUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" style="$modal-content-border-color:        rgba($black, .6);">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title modal-title2"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form class="row g-3 needs-validation" novalidate id="formInfodate" name="form">
              <div class="col-md-12 Info">
                <label for="validationCustom01" class="form-label ">Update Information Date</label>
                <input type="date" class="form-control my-select3" id="InfoDate" name="InfoDate" required>
              </div>
              <div class="col-md-12 OrderID2 d-none">
                <label for="validationCustom01" class="form-label "></label>
                <input type="text" class="form-control my-select2 " id="OID" name="discription" required>
              </div>
              <div class="col-md-12 BranchCode2 d-none">
                <label for="validationCustom01" class="form-label "></label>
                <input type="text" class="form-control my-select2 " id="brcd" name="brcd" required>
              </div>
            </div>

            <div class="modal-footer">
              <input data-bs-dismiss="modal" class="btn btn-primary update_infodate" value="Update">
              <input class="btn btn-secondary" type="reset"  data-bs-dismiss="modal" value="Close">
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="ReceivedByUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" style="$modal-content-border-color:        rgba($black, .6);">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title modal-title3"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form class="row g-3 needs-validation" novalidate id="formReceivedBy" name="form">
              <div class="col-md-12 received">
                <label for="validationCustom01" class="form-label ">Update Received By</label>
                <input type="text" class="form-control my-select3" id="Received" name="InfoDate" required>
              </div>
              <div class="col-md-12 OrderID3 d-none">
                <label for="validationCustom01" class="form-label "></label>
                <input type="text" class="form-control my-select2 " id="ODID" name="discription" required>
              </div>
              <div class="col-md-12 BranchCode3 d-none">
                <label for="validationCustom01" class="form-label "></label>
                <input type="text" class="form-control my-select2 " id="BRCD" name="brcd" required>
              </div>
            </div>

            <div class="modal-footer">
              <input data-bs-dismiss="modal" class="btn btn-primary update_receivedby" value="Update">
              <input class="btn btn-secondary" type="reset"  data-bs-dismiss="modal" value="Close">
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="OrderByUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" style="$modal-content-border-color:        rgba($black, .6);">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title modal-title4"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form class="row g-3 needs-validation" novalidate id="formReceivedBy" name="form">
              <div class="col-md-12 orderby">
                <label for="validationCustom01" class="form-label ">Update Order By</label>
                <input type="text" class="form-control my-select3" id="orderby" name="InfoDate" required>
              </div>
              <div class="col-md-12 odid d-none">
                <label for="validationCustom01" class="form-label "></label>
                <input type="text" class="form-control my-select2 " id="odid" name="discription" required>
              </div>
              <div class="col-md-12 Brcd d-none">
                <label for="validationCustom01" class="form-label "></label>
                <input type="text" class="form-control my-select2 " id="Brcd" name="brcd" required>
              </div>
            </div>

            <div class="modal-footer">
              <input data-bs-dismiss="modal" class="btn btn-primary update_orderby" value="Update">
              <input class="btn btn-secondary" type="reset"  data-bs-dismiss="modal" value="Close">
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Update Complaints -->

    <div class="modal fade" id="DiscriptionUpdateC" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" style="$modal-content-border-color:        rgba($black, .6);">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title modal-titleC"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body modal-bodyC">
            <form class="row g-3 needs-validation" novalidate id="formdC" name="form">
              <div class="col-md-12 DiscriptionC">
                <label for="validationCustom01" class="form-label ">Update Complaint Discription</label>
                <input type="text" class="form-control my-select2" id="discC" name="disc" required>
              </div>
              <div class="col-md-12 ComplaintID d-none">
                <label for="validationCustom01" class="form-label ">Update Discription</label>
                <input type="text" class="form-control my-select2 " id="ComplaintID" name="discription" required>
              </div>
              <div class="col-md-12 BranchCodeC d-none">
                <label for="validationCustom01" class="form-label ">Update Discription</label>
                <input type="text" class="form-control my-select2 " id="BranchCodeC" name="brcC" required>
              </div>
            </div>

            <div class="modal-footer">
              <input data-bs-dismiss="modal" class="btn btn-primary update_discC" value="Update">
              <input class="btn btn-secondary" type="reset"  data-bs-dismiss="modal" value="Close">
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="InfoDateUpdateC" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" style="$modal-content-border-color:        rgba($black, .6);">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title modal-titleC2"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form class="row g-3 needs-validation" novalidate id="formInfodateC" name="form">
              <div class="col-md-12 InfoC">
                <label for="validationCustom01" class="form-label ">Update Information Date of Complaint</label>
                <input type="date" class="form-control my-select3" id="InfoDateC" name="InfoDate" required>
              </div>
              <div class="col-md-12 ComplaintID2 d-none">
                <label for="validationCustom01" class="form-label "></label>
                <input type="text" class="form-control my-select2 " id="ComplaintID2" name="discription" required>
              </div>
              <div class="col-md-12 BranchCodeC2 d-none">
                <label for="validationCustom01" class="form-label "></label>
                <input type="text" class="form-control my-select2 " id="BranchCodeC2" name="brcd" required>
              </div>
            </div>
            <div class="modal-footer">
              <input data-bs-dismiss="modal" class="btn btn-primary update_infodateC" value="Update">
              <input class="btn btn-secondary" type="reset"  data-bs-dismiss="modal" value="Close">
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="ReceivedByUpdateC" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" style="$modal-content-border-color:        rgba($black, .6);">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title modal-titleC3"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form class="row g-3 needs-validation" novalidate id="formReceivedBy" name="form">
              <div class="col-md-12 receivedC">
                <label for="validationCustom01" class="form-label ">Update Received By Complaints</label>
                <input type="text" class="form-control my-select3" id="ReceivedC" name="ReceivedC" required>
              </div>
              <div class="col-md-12 ComplaintID3 d-none">
                <label for="validationCustom01" class="form-label "></label>
                <input type="text" class="form-control my-select2 " id="ComplaintID3" name="discription" required>
              </div>
              <div class="col-md-12 BranchCodeC3 d-none">
                <label for="validationCustom01" class="form-label "></label>
                <input type="text" class="form-control my-select2 " id="BranchCodeC3" name="brcd" required>
              </div>
            </div>
            <div class="modal-footer">
              <input data-bs-dismiss="modal" class="btn btn-primary update_receivedbyC" value="Update">
              <input class="btn btn-secondary" type="reset"  data-bs-dismiss="modal" value="Close">
            </div>
          </form>
        </div>
      </div>
    </div>


    <div class="modal fade" id="MadeByUpdateC" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" style="$modal-content-border-color:        rgba($black, .6);">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title modal-titleC4"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form class="row g-3 needs-validation" novalidate id="formReceivedBy" name="form">
              <div class="col-md-12 madebyC">
                <label for="validationCustom01" class="form-label ">Update Made by</label>
                <input type="text" class="form-control my-select3" id="madebyC" name="InfoDate" required>
              </div>
              <div class="col-md-12 ComplaintID4 d-none">
                <label for="validationCustom01" class="form-label "></label>
                <input type="text" class="form-control my-select2 " id="ComplaintID4" name="discription" required>
              </div>
              <div class="col-md-12 BranchCodeC4 d-none">
                <label for="validationCustom01" class="form-label "></label>
                <input type="text" class="form-control my-select2 " id="BranchCodeC4" name="brcd" required>
              </div>
            </div>

            <div class="modal-footer">
              <input data-bs-dismiss="modal" class="btn btn-primary update_madebyC" value="Update">
              <input class="btn btn-secondary" type="reset"  data-bs-dismiss="modal" value="Close">
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- End Update Complaints -->

    <div class="modal fade" id="ViewJobcard" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Job Card Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="ViewJobcardData">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal" id="FindBranch" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Find Branch</h5>
          </div>
          <div class="modal-body">

            <form class="row g-3 needs-validation" novalidate id="formB" name="form">
              <div class="col-md-6">
                <label for="validationCustom01" class="form-label " align="center">Select Search Type</label>
                <select class="form-select my-select3" aria-label="Default select example" id="type">
                  <option value="">Select</option>
                  <option value="Name">Branch Name</option>
                  <option value="Code">Branch Code</option>
                  <option value="District">District</option>
                </select>
              </div>
              <div class="col-md-6">
                <label for="validationCustom01" class="form-label ">Enter Details</label>
                <input type="text" class="form-control my-select2" id="fbranch" name="fbranch" required>
              </div>
            </div>
            <div class="modal-footer">
              <input data-bs-dismiss="modal" class="btn btn-primary search_branch" value="Search">
              <input class="btn btn-secondary" type="reset"  data-bs-dismiss="modal" value="Close">
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="ViewBranch" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Branchs</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="ViewBranchData">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="MobileUpdate" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-titleM" id="exampleModalLabel">Update Mobile</h5>
          </div>
          <div class="modal-bodyM">

            <form class="row g-3 needs-validation" novalidate id="form3" name="form">
              <div class="col-md-4 d-none">
                <label for="validationCustom04" class="form-label">Branch</label>
                <select id="BranchC" class="form-control my-select3" name="BranchCode" required>
                </select>
                <div class="invalid-feedback">
                  Please select a valid Branch.
                </div>
              </div>
              <center>
                <div class="col-md-4 modal-body-mobile">
                  <label for="validationCustom02" class="form-label ">Mobile</label>
                  <input type="text" class="form-control my-select2" id="Mobile" name="Mobile" required>
                </div>
              </center>
            </div>

            <div class="modal-footer">

              <button type="button" onclick="UpdateMobile()" data-bs-dismiss="modal" class="btn btn-primary">Submit</button>
              <input class="btn btn-secondary" type="reset"  data-bs-dismiss="modal" value="Close">
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="EmailUpdate" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-titleE" id="exampleModalLabel">Update Email</h5>
          </div>
          <div class="modal-body">

            <form class="row g-3 needs-validation" novalidate id="form4" name="form">
              <div class="col-md-4 d-none">
                <label for="validationCustom04" class="form-label">Branch</label>
                <select id="BranchC" class="form-control my-select3" name="BranchCode" required>
                </select>
                <div class="invalid-feedback">
                  Please select a valid Branch.
                </div>
              </div> 
              <center>     
                <div class="col-md-4 modal-body-email">
                  <label for="validationCustom01" class="form-label ">Email</label>
                  <input type="text" class="form-control my-select2" id="Email" name="Email" required>
                </div>
              </center>
            </div>

            <div class="modal-footer">

              <button type="button" onclick="UpdateEmail()" data-bs-dismiss="modal" class="btn btn-primary">Submit</button>
              <input class="btn btn-secondary" type="reset"  data-bs-dismiss="modal" value="Close">
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="GSTUpdate" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update GST No.</h5>
          </div>
          <div class="modal-body">

            <form class="row g-3 needs-validation" novalidate id="form5" name="form">
              <div class="col-md-4 d-none">
                <label for="validationCustom04" class="form-label">Branch</label>
                <select id="BranchC" class="form-control my-select3" name="BranchCode" required>
                </select>
                <div class="invalid-feedback">
                  Please select a valid Branch.
                </div>
              </div>      

              <center>
                <div class="col-md-4">
                  <label for="validationCustom02" class="form-label ">GST No.</label>
                  <input type="text" class="form-control my-select2" id="GST" name="GST" required>
                </div>
              </center>
            </div>

            <div class="modal-footer">

              <button type="button" onclick="UpdateGST()" data-bs-dismiss="modal" class="btn btn-primary">Submit</button>
              <input class="btn btn-secondary" type="reset"  data-bs-dismiss="modal" value="Close">
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="gadgetUpdateC" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" style="$modal-content-border-color:        rgba($black, .6);">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title modal-titleC5"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form class="row g-3 needs-validation" novalidate id="formReceivedBy" name="form">
              <div class="col-md-12 gadgetC">
                <label for="validationCustom01" class="form-label ">Update Gadget</label>
                <select id="gadgetC" class="form-control my-select3" name="GadgetID" required>
                  <option value="">Device</option>
                  <?php
                  $Device="Select * from gadget order by Gadget";
                  $result=mysqli_query($conn,$Device);
                  if (mysqli_num_rows($result)>0)
                  {
                    while ($arr=mysqli_fetch_assoc($result))
                    {
                      ?>
                      <option value="<?php echo $arr['GadgetID']; ?>"><?php echo $arr['Gadget']; ?></option>
                      <?php
                    }
                  }
                  ?>
                </select>
              </div>
              <div class="col-md-12 ComplaintID5 d-none">
                <label for="validationCustom01" class="form-label "></label>
                <input type="text" class="form-control my-select2 " id="ComplaintID5" name="discription" required>
              </div>
              <div class="col-md-12 BranchCodeC5 d-none">
                <label for="validationCustom01" class="form-label "></label>
                <input type="text" class="form-control my-select2 " id="BranchCodeC5" name="brcd" required>
              </div>
            </div>

            <div class="modal-footer">
              <input data-bs-dismiss="modal" class="btn btn-primary update_gadgetC" value="Update">
              <input class="btn btn-secondary" type="reset"  data-bs-dismiss="modal" value="Close">
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="gadgetUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" style="$modal-content-border-color:        rgba($black, .6);">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title modal-title5"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form class="row g-3 needs-validation" novalidate id="formReceivedBy" name="form">
              <div class="col-md-12 gadget">
                <label for="validationCustom01" class="form-label ">Update Gadget</label>
                <select id="gadget" class="form-control my-select3" name="GadgetID" required>
                  <option value="">Device</option>
                  <?php
                  $Device="Select * from gadget order by Gadget";
                  $result=mysqli_query($conn,$Device);
                  if (mysqli_num_rows($result)>0)
                  {
                    while ($arr=mysqli_fetch_assoc($result))
                    {
                      ?>
                      <option value="<?php echo $arr['GadgetID']; ?>"><?php echo $arr['Gadget']; ?></option>
                      <?php
                    }
                  }
                  ?>
                </select>
              </div>
              <div class="col-md-12 OrderID5 d-none">
                <label for="validationCustom01" class="form-label "></label>
                <input type="text" class="form-control my-select2 " id="OrderID5" name="discription" required>
              </div>
              <div class="col-md-12 BranchCode5 d-none">
                <label for="validationCustom01" class="form-label "></label>
                <input type="text" class="form-control my-select2 " id="BranchCode5" name="brcd" required>
              </div>
            </div>

            <div class="modal-footer">
              <input data-bs-dismiss="modal" class="btn btn-primary update_gadget" value="Update">
              <input class="btn btn-secondary" type="reset"  data-bs-dismiss="modal" value="Close">
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="UpdateBranchCode" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Branch Code</h5>
          </div>
          <div class="modal-body">

            <form class="row g-3 needs-validation" novalidate id="form5" name="form">
              <div class="col-md-4 d-none">
                <label for="validationCustom04" class="form-label">Branch</label>
                <select id="BranchC" class="form-control my-select3" name="BranchCode" required>
                </select>
                <div class="invalid-feedback">
                  Please select a valid Branch.
                </div>
              </div>      

              <center>
                <div class="col-md-4">
                  <label for="validationCustom02" class="form-label ">Branch Code</label>
                  <input type="text" class="form-control my-select2" id="Branch_code" name="Branch_code" required>
                </div>
              </center>
            </div>

            <div class="modal-footer">

              <button type="button" onclick="UpdateBranchCode()" data-bs-dismiss="modal" class="btn btn-primary">Submit</button>
              <input class="btn btn-secondary" type="reset"  data-bs-dismiss="modal" value="Close">
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Order / Complaints</h5>
          </div>
          <div class="modal-body">

            <form class="row g-3 needs-validation" novalidate id="form" name="form">

              <div class="col-md-4 d-none">
                <label for="validationCustom04" class="form-label">Branch</label>
                <select id="BranchC" class="form-control my-select3" name="BranchCode" required>
                </select>
                <div class="invalid-feedback">
                  Please select a valid Branch.
                </div>
              </div>

              <div class="col-md-4">
                <label for="validationCustom04" class="form-label">Select Type</label>
                <select id="Type" class="form-control my-select3" name="Type" required>
                  <option value="">Select</option>
                  <option value="Order">Order</option>
                  <option value="Complaint">Complaint</option>
                </select>
                <div class="invalid-feedback">
                  Please select a valid Type.
                </div>
              </div>

              <div class="col-md-4">
                <label for="validationCustom04" class="form-label">Device</label>
                <select id="Device" class="form-control my-select3" name="GadgetID" required>
                  <option value="">Device</option>
                  <?php
                  $Device="Select * from gadget order by Gadget";
                  $result=mysqli_query($conn,$Device);
                  if (mysqli_num_rows($result)>0)
                  {
                    while ($arr=mysqli_fetch_assoc($result))
                    {
                      ?>
                      <option value="<?php echo $arr['GadgetID']; ?>"><?php echo $arr['Gadget']; ?></option>
                      <?php
                    }
                  }
                  ?>
                </select>
                <div class="invalid-feedback">
                  Please select a valid Device.
                </div>
              </div>
              <div class="col-md-4">
                <label for="validationCustom01" class="form-label ">Received By</label>
                <input type="text" class="form-control my-select2" id="ReceivedBy" name="ReceivedBy" required>
              </div>
              <div class="col-md-4">
                <label for="validationCustom02" class="form-label ">Made By</label>
                <input type="text" class="form-control my-select2" id="MadeBy" name="MadeBy" required>
              </div>
              <div class="col-md-4">
                <label for="validationCustom01" class="form-label ">Date Of Information</label>
                <input type="date" class="form-control my-select3" id="InfoDateAdd" name="InfoDate" required>
              </div>
              <div class="col-md-4">
                <label for="validationCustom01" class="form-label ">Expected Completion</label>
                <input type="date" class="form-control my-select3" id="ExpectedAdd" name="ExpDate" required>
              </div>

              <div class="col-md-12">
                <label for="validationCustomUsername" class="form-label">Discription</label>
                <div class="input-group has-validation">
                  <textarea class="form-control my-select2" id="DiscriptionAdd" name="Discription" required></textarea>
                  <div class="invalid-feedback">
                    Please enter a Discription.
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">

              <button type="button" onclick="myFunction()" data-bs-dismiss="modal" class="btn btn-primary">Submit</button>
              <input class="btn btn-secondary" type="reset"  data-bs-dismiss="modal" value="Close">  </div>
            </form>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-8">
          <div class="col-lg-12" style="margin: 12px;">
            <table class=" table table-hover table-bordered border-primary table-responsive display" id="resizeMe"> 
              <h5 style="margin: 2px; text-align: center;">Orders</h5>
              <thead> 
                <tr> 
                  <th style="min-width: 150px;">Order ID</th>
                  <th style="min-width: 150px;">Information Date</th>
                  <th style="min-width: 500px;">Discription</th>
                  <th style="min-width: 150px;">Attended</th>
                  <th style="min-width: 150px;">Visit Date</th>
                  <th style="min-width: 500px;">Executive Remark</th>                          
                  <th style="min-width: 150px;">Gadget</th>                        
                  <th style="min-width: 150px;">Assign Date</th>                            
                  <th style="min-width: 150px;">Call Verified</th>   
                  <th style="min-width: 150px;">Employee</th>          
                </tr>                     
              </thead>                 
              <tbody id="Order"> 
              </tbody>
            </table>
          </div>
          <div class="col-lg-12" style="margin: 12px;">
            <table class=" display table table-hover table-bordered border-primary"> 
              <h5 style="margin: 5px; text-align: center;">Complaints</h5>
              <thead> 
                <tr> 
                  <th style="min-width: 150px;">Complaint ID</th>
                  <th style="min-width: 150px;">Information Date</th>
                  <th style="min-width: 500px;">Discription</th>
                  <th style="min-width: 150px;">Attended</th>
                  <th style="min-width: 150px;">Date of Visit</th>
                  <th style="min-width: 500px;">Executive Remark</th> 
                  <th style="min-width: 150px;">Gadget</th>            
                  <th style="min-width: 150px;">Assign Date</th>
                  <th style="min-width: 150px;">Call Verified</th>             
                  <th style="min-width: 150px;">Employee</th>            
                </tr>                     
              </thead>                 
              <tbody id="Complaints" > 

              </tbody>
            </table> 
          </div>
          <div class="col-lg-12" style="margin: 12px;">
            <table class="display table table-hover table-bordered border-primary" id="resizeMe3">
              <h5 style="margin: 2px; text-align: center;">Jobcard</h5>
              <thead> 
                <tr> 
                  <th style="min-width: 150px;">Card No</th>
                  <th style="min-width: 150px;">Jobcard Number</th>
                  <th style="min-width: 800px;">Service Done</th>
                  <th style="min-width: 800px;">Pending Work</th>
                  <th style="min-width: 150px;">Date of Visit</th>
                  <th style="min-width: 150px;">Gadget</th>
                  <th style="min-width: 150px;">Employee</th>   
                </tr>                     
              </thead>                 
              <tbody id="jobcard"> 

              </tbody>
            </table>   
          </div>
        </div>
        <div class="col-lg-4" >
          <br>
          <h4 align="center" style="margin-bottom: 20px">Branch Details</h4>
          <div class="row lg-12" id="BranchData">
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="ajax-script.js" type="text/javascript"></script>  
  <script type="text/javascript">
  // Example starter JavaScript for disabling form submissions if there are invalid fields
  (function () {
    'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
  .forEach(function (form) {
    form.addEventListener('submit', function (event) {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()

var exampleModal = document.getElementById('DiscriptionUpdate')
exampleModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute('data-bs-discription')
  var ID = button.getAttribute('data-bs-OrderID')
  var BranchCode = button.getAttribute('data-bs-BranchCode')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitle = exampleModal.querySelector('.modal-title')
  var modalBodyInput = exampleModal.querySelector('.Discription input')
  var idInput = exampleModal.querySelector('.OrderID input')
  var brcInput = exampleModal.querySelector('.BranchCode input')

  modalTitle.textContent = 'Update Discription: '
  modalBodyInput.value = recipient
  idInput.value = ID
  brcInput.value = BranchCode
})


var exampleModal5 = document.getElementById('gadgetUpdate')
exampleModal5.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button5 = event.relatedTarget
  // Extract info from data-bs-* attributes
  //var recipient5 = button5.getAttribute('data-bs-gadget')
  var ID5 = button5.getAttribute('data-bs-OrderID5')
  console.log(gadget);
  var BranchCode5 = button5.getAttribute('data-bs-BranchCode5')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitle5 = exampleModal5.querySelector('.modal-title5')
  //var modalBodyInput5 = exampleModal5.querySelector('.gadget input')
  var idInput5 = exampleModal5.querySelector('.OrderID5 input')
  var brcInput5 = exampleModal5.querySelector('.BranchCode5 input')

  modalTitle5.textContent = 'Update Gadget: '
  //modalBodyInput5.value = recipient5
  idInput5.value = ID5
  brcInput5.value = BranchCode5
})

var exampleModalC5 = document.getElementById('gadgetUpdateC')
exampleModalC5.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var buttonC5 = event.relatedTarget
  // Extract info from data-bs-* attributes
  //var recipient5 = button5.getAttribute('data-bs-gadget')
  var IDC5 = buttonC5.getAttribute('data-bs-ComplaintID5')
  var BranchCodeC5 = buttonC5.getAttribute('data-bs-BranchCodeC5')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitleC5 = exampleModalC5.querySelector('.modal-titleC5')
  //var modalBodyInput5 = exampleModal5.querySelector('.gadget input')
  var idInputC5 = exampleModalC5.querySelector('.ComplaintID5 input')
  var brcInputC5 = exampleModalC5.querySelector('.BranchCodeC5 input')

  modalTitleC5.textContent = 'Update Gadget: '
  //modalBodyInput5.value = recipient5
  idInputC5.value = IDC5
  brcInputC5.value = BranchCodeC5
})


var exampleModal2 = document.getElementById('InfoDateUpdate')
exampleModal2.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button2 = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient2 = button2.getAttribute('data-bs-info')
  var ID2 = button2.getAttribute('data-bs-OrderID2')
  var BranchCode2 = button2.getAttribute('data-bs-BranchCode2')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitle2 = exampleModal2.querySelector('.modal-title2')
  var modalBodyInput2 = exampleModal2.querySelector('.Info input')
  var idInput2 = exampleModal2.querySelector('.OrderID2 input')
  var brcInput2 = exampleModal2.querySelector('.BranchCode2 input')

  modalTitle2.textContent = 'Update Information Date '
  modalBodyInput2.value = recipient2
  idInput2.value = ID2
  brcInput2.value = BranchCode2
})


var exampleModal3 = document.getElementById('ReceivedByUpdate')
exampleModal3.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button3 = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient3 = button3.getAttribute('data-bs-received')
  var ID3 = button3.getAttribute('data-bs-OrderID3')
  var BranchCode3 = button3.getAttribute('data-bs-BranchCode3')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitle3 = exampleModal3.querySelector('.modal-title3')
  var modalBodyInput3 = exampleModal3.querySelector('.received input')
  var idInput3 = exampleModal3.querySelector('.OrderID3 input')
  var brcInput3 = exampleModal3.querySelector('.BranchCode3 input')

  modalTitle3.textContent = 'Update Received By '
  modalBodyInput3.value = recipient3
  idInput3.value = ID3
  brcInput3.value = BranchCode3
})

var exampleModal4 = document.getElementById('OrderByUpdate')
exampleModal4.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button4 = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient4 = button4.getAttribute('data-bs-orderby')
  var ID4 = button4.getAttribute('data-bs-odid')
  var BranchCode4 = button4.getAttribute('data-bs-Brcd')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitle4 = exampleModal4.querySelector('.modal-title4')
  var modalBodyInput4 = exampleModal4.querySelector('.orderby input')
  var idInput4 = exampleModal4.querySelector('.odid input')
  var brcInput4 = exampleModal4.querySelector('.Brcd input')

  modalTitle4.textContent = 'Update Order By '
  modalBodyInput4.value = recipient4
  idInput4.value = ID4
  brcInput4.value = BranchCode4
})




//complaints

var exampleModalC = document.getElementById('DiscriptionUpdateC')
exampleModalC.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var buttonC = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipientC = buttonC.getAttribute('data-bs-discriptionC')
  var IDC = buttonC.getAttribute('data-bs-ComplaintID')
  var BranchCodeC = buttonC.getAttribute('data-bs-BranchCodeC')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitleC = exampleModalC.querySelector('.modal-titleC')
  var modalBodyInputC = exampleModalC.querySelector('.DiscriptionC input')
  var idInputC = exampleModalC.querySelector('.ComplaintID input')
  var brcInputC = exampleModalC.querySelector('.BranchCodeC input')

  modalTitleC.textContent = 'Update Complaint Discription: '
  modalBodyInputC.value = recipientC
  idInputC.value = IDC
  brcInputC.value = BranchCodeC
})


var exampleModalC2 = document.getElementById('InfoDateUpdateC')
exampleModalC2.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var buttonC2 = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipientC2 = buttonC2.getAttribute('data-bs-InfoC')
  var IDC2 = buttonC2.getAttribute('data-bs-ComplaintID2')
  var BranchCodeC2 = buttonC2.getAttribute('data-bs-BranchCodeC2')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitleC2 = exampleModalC2.querySelector('.modal-titleC2')
  var modalBodyInputC2 = exampleModalC2.querySelector('.InfoC input')
  var idInputC2 = exampleModalC2.querySelector('.ComplaintID2 input')
  var brcInputC2 = exampleModalC2.querySelector('.BranchCodeC2 input')

  modalTitleC2.textContent = 'Update Information Date of Complaint: '
  modalBodyInputC2.value = recipientC2
  idInputC2.value = IDC2
  brcInputC2.value = BranchCodeC2
})


var exampleModalC3 = document.getElementById('ReceivedByUpdateC')
exampleModalC3.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var buttonC3 = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipientC3 = buttonC3.getAttribute('data-bs-receivedC')
  var IDC3 = buttonC3.getAttribute('data-bs-ComplaintID3')
  var BranchCodeC3 = buttonC3.getAttribute('data-bs-BranchCodeC3')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitleC3 = exampleModalC3.querySelector('.modal-titleC3')
  var modalBodyInputC3 = exampleModalC3.querySelector('.receivedC input')
  var idInputC3 = exampleModalC3.querySelector('.ComplaintID3 input')
  var brcInputC3 = exampleModalC3.querySelector('.BranchCodeC3 input')

  modalTitleC3.textContent = 'Update Received By Complaints'
  modalBodyInputC3.value = recipientC3
  idInputC3.value = IDC3
  brcInputC3.value = BranchCodeC3
})


var exampleModalC4 = document.getElementById('MadeByUpdateC')
exampleModalC4.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var buttonC4 = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipientC4 = buttonC4.getAttribute('data-bs-madebyC')
  var IDC4 = buttonC4.getAttribute('data-bs-ComplaintID4')
  var BranchCodeC4 = buttonC4.getAttribute('data-bs-BranchCodeC4')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalTitleC4 = exampleModalC4.querySelector('.modal-titleC4')
  var modalBodyInputC4 = exampleModalC4.querySelector('.madebyC input')
  var idInputC4 = exampleModalC4.querySelector('.ComplaintID4 input')
  var brcInputC4 = exampleModalC4.querySelector('.BranchCodeC4 input')

  modalTitleC4.textContent = 'Update Made By '
  modalBodyInputC4.value = recipientC4
  idInputC4.value = IDC4
  brcInputC4.value = BranchCodeC4
})

function printDiv(divName) {
 var printContents = document.getElementById(divName).innerHTML;
 var originalContents = document.body.innerHTML;

 document.body.innerHTML = printContents;

 window.print();

 document.body.innerHTML = originalContents;
}




var exampleModalPhone = document.getElementById('PhoneUpdate')
exampleModalPhone.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var buttonp = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipientp = buttonp.getAttribute('data-bs-phone')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  console.log(recipientp);
  // Update the modal's content.
  var modalTitlep = exampleModalPhone.querySelector('.modal-title')
  var modalBodyInputp = exampleModalPhone.querySelector('.modal-body-phone input')

  modalTitlep.textContent = 'Upadte Phone Number '
  modalBodyInputp.value = recipientp
})


var exampleModalMobile = document.getElementById('MobileUpdate')
exampleModalMobile.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var buttonp = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipientp = buttonp.getAttribute('data-bs-mobile')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  console.log(recipientp);
  // Update the modal's content.
  var modalTitlep = exampleModalMobile.querySelector('.modal-titleM')
  var modalBodyInputp = exampleModalMobile.querySelector('.modal-body-mobile input')

  modalTitlep.textContent = 'Update Mobile Number '
  modalBodyInputp.value = recipientp
})


var exampleModalEmail = document.getElementById('EmailUpdate')
exampleModalEmail.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var buttonp = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipientp = buttonp.getAttribute('data-bs-email')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  console.log(recipientp);
  // Update the modal's content.
  var modalTitlep = exampleModalEmail.querySelector('.modal-titleE')
  var modalBodyInputp = exampleModalEmail.querySelector('.modal-body-email input')

  modalTitlep.textContent = 'Update Email '
  modalBodyInputp.value = recipientp
})

</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('table.display').DataTable( {
      responsive: true,
      "scrollY":        "80px",
      "searching": false,
      "scrollX": true,
      scrollCollapse: true,
      "scrollCollapse": true,
      "paging":         false
    } );
  } );

</script>
</body>
</html>
