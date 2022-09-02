<!-- Find Orders -->

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

<!--END Find Orders -->

<!-- Find Complaints -->

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

<!-- Work Details -->
<div class="modal fade" id="WorkReport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Work Report</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-4">
            <label for="validationCustom01" class="form-label " align="center">Select Employee</label>
            <select class="form-select rounded-corner" aria-label="Default select example" id="EmployeeCodeW">
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
          <input type="date" class="form-control rounded-corner" name="" id="Sdate">
        </div>
        <div class="col-md-4">
          <label for="validationCustom01" class="form-label " align="center">End Date</label>
          <input type="date" class="form-control rounded-corner" name="" id="Edate">
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
    <div class="modal-content rounded-corner" style="background-color:#f0f0f0">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Materials Pending Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="InventoryData">

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary cl" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-primary addUpdate" data-bs-toggle="modal" data-bs-target="#add">Add Items</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit Pending Materials-->
<!--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Open modal for @mdo</button>-->


<div class="modal fade" id="editQty" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Enter New Quantity</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Quantity</label>
            <input type="text" class="form-control" id="NewQty" onkeydown="limit(this);" onkeyup="limit(this);">
          </div>
          <div class="mb-3 d-none">
            <label for="recipient-name" class="col-form-label">Item ID</label>
            <input type="text" class="form-control" id="ItemIDUpdate">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" data-bs-dismiss="modal" class="btn btn-primary saveQty">Save</button>
      </div>
    </div>
  </div>
</div>

<!-- Released  Material -->

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


<!-- End released Materails-->


<div class="modal fade" id="AssignedRegion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Region and District</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div style="margin: 12px;">
          <table class="container table table-hover table-bordered border-primary table-responsive"> 
            <thead> 
              <tr> 
                <th style="min-width:150px">Region</th>
                <th style="min-width:150px">District</th>                   
              </tr>                     
            </thead>                 
            <tbody id="RegionData">
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

<div class="modal" id="AddBankVisit" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title">Enter Visit Details</h5>
      </div>
      <div class="modal-body">

        <form class="form-control" id="FBankVisit">
          <div class="row">

            <div class="col-lg-4">
              <label for="validationCustom01" class="form-label ">Select Bank</label>
              <select id="BankVisit" class="form-control rounded-corner">
                <option value="">Select</option>
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


            <div class="col-lg-4">
              <label for="validationCustom01" class="form-label ">Select Zone</label>
              <select id="ZoneVisit" class="form-control rounded-corner">
                <option value="">Select</option>
              </select>
            </div>

            <div class="col-lg-4">
              <label for="validationCustom01" class="form-label ">Select Designation</label>
              <select id="DesignationVisit" class="form-control rounded-corner">
                <option value="">Select</option>
                <?php
                $BankData="SELECT * FROM dsr.designation Order By DesignationName";
                $result=mysqli_query($con3,$BankData);
                if (mysqli_num_rows($result)>0)
                {
                  while ($arr=mysqli_fetch_assoc($result))
                  {
                    ?>
                    <option value="<?php echo $arr['DesignationID']; ?>"><?php echo $arr['DesignationName']; ?></option>
                    <?php
                  }
                }
                ?>
              </select>
            </div>

            <div class="col-lg-4">
              <label for="validationCustom01" class="form-label ">Select Bank Employee</label>
              <select id="BEmployeeVisit" class="form-control rounded-corner">
                <option value="">Select</option>
              </select>
            </div>

            <div class="col-lg-3">
              <label for="validationCustom01" class="form-label ">Date of Visit</label>
              <input type="date" class="form-control rounded-corner" id="VisitDateD" max="<?php echo $Date ?>"  min="<?php echo date('Y-m-d', strtotime($Date. ' - 7 days')) ?>">
            </div>

            <div class="col-lg-4">
              <label for="validationCustom01" class="form-label ">Next Visit Date</label>
              <input type="date" class="form-control rounded-corner" id="NextVisitDateD">
            </div>
            <div class="col-lg-12">
              <label for="validationCustom01" class="form-label ">Visit Remark</label>
              <textarea type="text" class="form-control rounded-corner" maxlength="450" id="DescriptionD"></textarea>
            </div>

          </div>

          <div class="table-responsive" style="margin:20px">
            <table class="table table-hover table-bordered border-primary">
              <thead>
                <th>Bank</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Visit Date</th>
                <th>Next Visit Date</th>
                <th>Description</th>
                <th>Visit By</th>
              </thead>
              <tbody id="BankVisitData">

              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="reset"  data-bs-dismiss="modal">Close</button> 
        </form>
        <button type="button" data-bs-toggle="modal" data-bs-target="#AddBankEmployee" class="btn btn-primary">Add Bank Employee</button>
        <button type="button" data-bs-dismiss="modal" class="btn btn-primary saveBankVisit">Save</button> 
      </div>
      
    </div>
  </div>
</div>


<div class="modal" id="AddBankEmployee" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title">Enter Bank Employee Details</h5>
      </div>
      <div class="modal-body">

        <form class="form-control" id="FBankEmployee">
          <div class="row">
            <div class="col-lg-6" >
              <select id="Bank" class="form-control rounded-corner" name="Bank" style="margin-bottom:10px;">
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
            <div class="col-lg-6">
              <select id="Zone" class="form-control rounded-corner" name="Zone" style="margin-bottom:10px;">
                <option value="">Zone</option>
              </select>
            </div>

            <div class="col-lg-6">
              <select class="form-control rounded-corner" id="DesignationID" style="margin-bottom:10px;">
                <option value="">Designation</option>
                <?php
                $Data="SELECT * FROM dsr.designation Order By DesignationName";
                $result=mysqli_query($con3,$Data);
                if (mysqli_num_rows($result)>0)
                {
                  while ($arr=mysqli_fetch_assoc($result))
                  {
                    ?>
                    <option value="<?php echo $arr['DesignationID']; ?>"><?php echo $arr['DesignationName']; ?></option>
                    <?php
                  }
                }
                ?>
              </select>
            </div>

            <div class="col-lg-6">
              <input type="text" class="form-control rounded-corner" style="margin-bottom:10px;" id="DName" placeholder="Bank Employee Name">
            </div>
            <center>
              <div class="col-lg-6">
                <input type="number" style="margin-bottom:10px;" class="form-control rounded-corner" id="DMobile" placeholder="Employee Mo. Number" onkeyup="limits(this, 10);">
              </div>

            </center>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="reset"  data-bs-dismiss="modal">Close</button> 
        </form>
        <button type="button" data-bs-dismiss="modal" class="btn btn-primary SaveBankEmployee">Save</button> 
      </div>

    </div>
  </div>
</div>