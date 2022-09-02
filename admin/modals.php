
<div class="modal fade" id="ReleasedMaterials" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content rounded-corner" style="background-color:#f0f0f0">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Released Materials</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="MaterialsData">

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Find Complaints -->
<div class="modal" id="FindOrder" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Find Order</h5>
      </div>
      <div class="modal-body">

        <form class="row g-3 needs-validation" novalidate id="form2" name="form">
          <center>
            <div class="col-md-4">
              <label for="validationCustom01" class="form-label ">Enter Order ID</label>
              <input type="text" class="form-control rounded-corner" id="forder" name="forder" required>
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
    <div class="modal-content rounded-corner">
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
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Find Complaint</h5>
      </div>
      <div class="modal-body">

        <form class="row g-3 needs-validation" novalidate id="formC" name="form">
          <center>
            <div class="col-md-4">
              <label for="validationCustom01" class="form-label ">Enter Complaint ID</label>
              <input type="text" class="form-control rounded-corner" id="fcomplaint" name="fcomplaint" required>
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
    <div class="modal-content rounded-corner">
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
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Find Jobcard</h5>
      </div>
      <div class="modal-body">

        <form class="row g-3 needs-validation" novalidate id="formJ" name="form">
          <center>
            <div class="col-md-4">
              <label for="validationCustom01" class="form-label ">Enter Jobcard Number</label>
              <input type="text" class="form-control rounded-corner" id="fjobcard" name="fjobcard" required>
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
    <div class="modal-content rounded-corner">
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
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Find Branch</h5>
      </div>
      <div class="modal-body">

        <form class="row g-3 needs-validation" novalidate id="formB" name="form">
          <div class="col-md-6">
            <label for="validationCustom01" class="form-label " align="center">Select Search Type</label>
            <select class="form-select rounded-corner" aria-label="Default select example" id="type">
              <option value="">Select</option>
              <option value="Name">Branch Name</option>
              <option value="Code">Branch Code</option>
              <option value="District">District</option>
            </select>
          </div>
          <div class="col-md-6">
            <label for="validationCustom01" class="form-label ">Enter Details</label>
            <input type="text" class="form-control rounded-corner" id="fbranch" name="fbranch" required>
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
    <div class="modal-content rounded-corner">
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
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Employee Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <center>
          <div class="col-md-5">
            <label for="validationCustom01" class="form-label " align="center">Select Employee</label>
            <select class="form-select rounded-corner" aria-label="Default select example" id="EmployeeCode">
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

<!-- Inventory Pending -->
<div class="modal fade" id="InventoryPending" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content rounded-corner">
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

<div class="modal fade" id="AddExecutive" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">User Name:</label>
            <input type="text" class="form-control rounded-corner" id="UserName">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">User Type:</label>
            <select class="form-control rounded-corner" id="UserType">
              <option value="">Select</option>
              <option value="AMC">AMC</option>
              <option value="Executive">Executive</option>
              <option value="Supervisor">Supervisor</option>
              <option value="Inventory">Inventory Release</option>
              <option value="Dataentry">Job Card Entry</option>
              <option value="Reminders">Reminders</option>
              <option value="Reporting">Work Reporting</option>       
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary SaveExecutive">Save</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="Employees" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Employees</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-hover table-bordered border-primary SrEngineer-Table">
          <thead>
            <th>Name</th>
            <th>Mobile Number</th>
            <th>Target Amount</th>
            <th>Reported To</th>
            <th style="min-width:180px;">Change Reporting To</th>
            <th>Jobcard Entry</th>
            <th style="min-width:180px;">Change Jobcard Entry</th>
            <th>Total District</th>
            <th>Change Inservice</th>
            <th>Action</th>
          </thead>
          <tbody id="employeelist">

          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="AddEmployees" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Employee</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="NewEmployeeF">
          <div class="row">
            <div class="col-lg-6">
              <label for="recipient-name" class="col-form-label">Employee Name:</label>
              <input type="text" class="form-control rounded-corner" id="EmployeeName">
            </div>
            <div class="col-lg-6">
              <label for="recipient-name" class="col-form-label">Qualifications:</label>
              <input type="text" class="form-control rounded-corner" id="EmployeeQulaification">
            </div>
            <div class="col-lg-6">
              <label for="recipient-name" class="col-form-label">District:</label>
              <input type="text" class="form-control rounded-corner" id="EmployeeDistrict">
            </div>
            <div class="col-lg-6">
              <label for="recipient-name" class="col-form-label">Mobile Number:</label>
              <input type="text" class="form-control rounded-corner" id="EmployeeMobile">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary SaveNewEmployee">Save</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="UpdateEmployees" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="NewEmployeeF">
          <div class="row">
            <div class="col-lg-6">
              <label for="recipient-name" class="col-form-label">Employee Name:</label>
              <input type="text" class="form-control rounded-corner" id="EmployeeNameU">
            </div>
            <div class="col-lg-6">
              <label for="recipient-name" class="col-form-label">Qualifications:</label>
              <input type="text" class="form-control rounded-corner" id="EmployeeQulaificationU">
            </div>
            <div class="col-lg-6">
              <label for="recipient-name" class="col-form-label">District:</label>
              <input type="text" class="form-control rounded-corner" id="EmployeeDistrictU">
            </div>
            <div class="col-lg-6">
              <label for="recipient-name" class="col-form-label">Mobile Number:</label>
              <input type="text" class="form-control rounded-corner" id="EmployeeMobileU">
            </div>
            <center>
              <div class="col-lg-6">
                <label for="recipient-name" class="col-form-label">Target Amount:</label>
                <input type="text" class="form-control rounded-corner" id="EmployeeTargetU">
              </div>
            </center>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary SaveNewEmployeeU">Save</button>
      </div>
    </div>
  </div>
</div>

<!--
<div class="modal fade" id="DataentryAllotment" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Employees</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-hover table-bordered border-primary">
          <thead>
            <th>Sr. No.</th>
            <th>Service Engineer Name</th>
            <th>Alloted To</th>
            <th>Change Alloted To</th>
            <th>Reset</th>
          </thead>
          <tbody id="employeelistD">

          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
-->

<div class="modal fade" id="Executive" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Executive</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-hover table-bordered border-primary Executive-Table">
          <thead>
            <th>Name</th>
            <th>Total Service Engineer</th>
            <th>Total District</th>
            <th>Region</th>
            <th>User Type</th>
            <th>Reset Password</th>
            <!--<th>Action</th>-->
          </thead>
          <tbody id="executivelist">

          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="WorkReport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="work_data">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="BankReminders" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Banks details for payment follow-up</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-6">
            <input type="text" id="myInput5" onkeyup="myFunction5()" placeholder="Search for Bank Name" class="form-control rounded-corner" style="margin-bottom:20px">
          </div>
          <div class="col-lg-6">
            <input type="text" id="myInput6" onkeyup="myFunction6()" placeholder="Search for Zone" class="form-control rounded-corner" style="margin-bottom:20px">
          </div>
        </div>
        <table class="table table-hover table-bordered border-primary" id="myTable6">
          <thead>
            <th>Sr. No.</th>
            <th>Bank</th>
            <th>Zone</th>
            <th>Assign To</th>
            <th>Change Assign To</th>
          </thead>
          <tbody id="BankReminderData">

          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="JobcardReminder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content rounded-corner" style="background-color:#f0f0f0">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Remark</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="jobcardR">
          <input type="text" class="d-none" name="" id="cardnumber">
          <textarea class="form-control rounded-corner" id="JobcardReminderData"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary SaveReminder">Save</button>
        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- END Search Jobcard -->