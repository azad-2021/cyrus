<!-- Find Orders -->

<div class="modal" id="GSTPayment" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">GST Payment Entry</h5>
      </div>
      <div class="modal-body">

        <form class="row g-3 needs-validation" novalidate id="form2" name="form">
          <div class="row">
            <div class="col-md-4">
              <label for="validationCustom01" class="form-label ">Bill Date</label>
              <input type="text" class="form-control my-select3" id="billdate" name="forder" disabled>
            </div>

            <div class="col-md-4">
              <label for="validationCustom01" class="form-label ">SGST</label>
              <input type="text" class="form-control my-select3" id="sgst" name="forder" required disabled>
            </div>
            <div class="col-md-4">
              <label for="validationCustom01" class="form-label ">CGST</label>
              <input type="text" class="form-control my-select3" id="cgst" name="forder" required disabled>
            </div>
            <div class="col-md-4">
              <label for="validationCustom01" class="form-label ">IGST</label>
              <input type="text" class="form-control my-select3" id="igst" name="forder" required disabled>
            </div>
            <div class="col-md-4">
              <label for="validationCustom01" class="form-label ">Total Billed Value</label>
              <input type="text" class="form-control my-select3" id="billedamount" name="forder" required disabled="">
            </div>
            <div class="col-md-4">
              <label for="validationCustom01" class="form-label ">Received Amount</label>
              <input type="number" class="form-control my-select3" id="receiveamount" name="forder" required>
            </div>
            <div class="col-md-4">
              <label for="validationCustom01" class="form-label ">Receive Date</label>
              <input type="date" class="form-control my-select3" id="receivedate" name="forder" required disabled="">
            </div>
            <div class="col-md-4">
              <label for="validationCustom01" class="form-label ">Security Amount</label>
              <input type="number" class="form-control my-select3" id="securityamount" name="forder" required>
            </div>
            <div class="col-md-4">
              <label for="validationCustom01" class="form-label ">Security Release Date</label>
              <input type="date" class="form-control my-select3" id="securityDate" name="forder" required>
            </div>

            <div class="col-md-4">
              <label for="validationCustom01" class="form-label ">Security Received Amount</label>
              <input type="text" class="form-control my-select3" id="SreceiveAmount" name="forder" required>
            </div>
            <div class="col-md-4">
              <label for="validationCustom01" class="form-label ">Security Received Date</label>
              <input type="date" class="form-control my-select3" id="SreceiveDate" name="forder" required>
            </div>

            <div class="col-md-4 d-none">
              <label for="validationCustom01" class="form-label ">Bill Number</label>
              <input type="text" class="form-control my-select3" id="billno" name="forder" required disabled="">
            </div>
            <div class="col-md-6">
              <label for="validationCustom01" class="form-label ">DD/Online</label>
               <textarea class="form-control my-select3" id="DD" rows="3"></textarea>
            </div>
            <div class="col-md-6">
              <label for="validationCustom01" class="form-label ">Remark</label>
               <textarea class="form-control my-select3" id="Remark" rows="3"></textarea>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <input data-bs-dismiss="modal" class="btn btn-primary payment cl" value="save">
          <input class="btn btn-secondary cl" type="reset"  data-bs-dismiss="modal" value="Close">


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

<!--END Find Orders -->

<!-- Find Complaints -->

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
<!-- END FIND COMPLAINTS -->

<!-- Search Jobcard Details -->
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
<!-- END Search Jobcard -->


<!-- Search Branch -->
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
<!-- End Search Branch -->

<!-- Find Employee Details -->
<div class="modal fade" id="FindEmployee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Employee Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <center>
          <div class="col-md-5">
            <label for="validationCustom01" class="form-label " align="center">Select Employee</label>
            <select class="form-select my-select3" aria-label="Default select example" id="EmployeeCode">
              <option value="">Select</option>
              <?php 
              $query="SELECT * FROM employees WHERE Inservice=1";
              $result=mysqli_query($con,$query);
              if (mysqli_num_rows($result)>0)
              {
               while ($a=mysqli_fetch_assoc($result))
               {

                echo "<option value='".$a['EmployeeCode']."'>".$a['Employee Name']."</option><br>";
              }
            }
            ?>
          </select>
        </div>
      </center>
      <div class="col-lg-12" style="margin: 12px;">
        <table class="container table table-hover table-bordered border-primary table-responsive"> 
          <thead> 
            <tr> 
              <th style="min-width:150px">Mobile Number</th>
              <th style="min-width:150px">Employee Code</th>                    
            </tr>                     
          </thead>                 
          <tbody id="EmployeeData">
          </tbody>
        </table>
      </div>

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    </div>
  </div>
</div>
</div>
<!-- END Find Employee Details -->

<!-- Work Details -->
<div class="modal fade" id="WorkReport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Work Report</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-4">
            <label for="validationCustom01" class="form-label " align="center">Select Employee</label>
            <select class="form-select my-select3" aria-label="Default select example" id="EmployeeCodeW">
              <option value="">Select</option>
              <?php 
              $query="SELECT * FROM employees WHERE Inservice=1";
              $result=mysqli_query($con,$query);
              if (mysqli_num_rows($result)>0)
              {
               while ($a=mysqli_fetch_assoc($result))
               {

                echo "<option value='".$a['EmployeeCode']."'>".$a['Employee Name']."</option><br>";
              }
            }
            ?>
          </select>
        </div>
        <div class="col-md-4">
          <label for="validationCustom01" class="form-label " align="center">Start Date</label>
          <input type="date" class="form-control my-select3" name="" id="Sdate">
        </div>
        <div class="col-md-4">
          <label for="validationCustom01" class="form-label " align="center">End Date</label>
          <input type="date" class="form-control my-select3" name="" id="Edate">
        </div>
      </div>
      <div class="col-lg-12" style="margin: 12px;">
        <table class="container table table-hover table-bordered border-primary table-responsive"> 
          <thead> 
            <tr> 
              <th style="min-width:150px">Visit Date</th>
              <th style="min-width:150px">Bank</th>   
              <th style="min-width:150px">Zone</th> 
              <th style="min-width:150px">Branch</th>  
              <th style="min-width:150px">Service Done</th> 
              <th style="min-width:150px">Remark</th> 
              <th style="min-width:150px">Jobcard</th>
              <th style="min-width:150px">FOrder</th>
              <th style="min-width:150px">FComplaint</th>                 
            </tr>                     
          </thead>                 
          <tbody id="EmployeeWorkData">
          </tbody>
        </table>
      </div>

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    </div>
  </div>
</div>
</div>


<!-- Inventory Pending -->
<div class="modal fade" id="InventoryPending" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Materials Pending Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="InventoryData">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>