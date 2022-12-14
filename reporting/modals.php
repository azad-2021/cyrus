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

<div class="modal" id="Reference" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Close ID</h5>
      </div>
      <div class="modal-body">

        <form class="form-control rounded-corner" method="POST" action="">
          <center>
            <div class="col-lg-6">
              <label for="validationCustom01" class="form-label ">Enter Jobcard No</label>
              <input type="text" class="form-control rounded-corner" id="Jobcard" required>
            </div>
            <div class="col-lg-6">
              <label for="validationCustom01" class="form-label ">Enter Remark</label>
              <textarea  type="text" class="form-control rounded-corner" id="Remark" maxlength="150" required></textarea>
            </div>

            <input class="d-none" type="text" name="Type" id="TypeGen">
            <input class="d-none" type="number" name="ID" id="QID">
          </div>
        </center>
      </form>
      <div class="modal-footer">
        <button class="btn btn-primary GenerateRefID" data-bs-dismiss="modal">Save</button>
        <input class="btn btn-secondary" type="reset"  data-bs-dismiss="modal" value="Close">
      </div>

    </div>
  </div>
</div>


<div class="modal fade" id="EditServiceDone" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Service Done</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <textarea type="text" class="form-control rounded-corner" id="NewServiceDone"></textarea>
        <input type="text" name="" id="JobcardServiceDone" class="d-none">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary SaveServiceDone">Save</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="EditPendingWork" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pending Work</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <textarea type="text" class="form-control rounded-corner" id="NewPendingWork"></textarea>
        <input type="text" name="" id="JobcardPendingWork" class="d-none">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary SavePendingWork">Save</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="ViewGadgetDetails" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Jobcard Details</h5>
      </div>
      <div class="modal-body">
        <div class="modal-footer" id="GadgetData">

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div class="modal" id="NewEstimate" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Estimate</h5>
      </div>
      <div class="modal-body">
        <div class="modal-footer">
          <form class="form-control rounded-corner">
            <div class="row">
              <div class="col-sm-4">
                <select id="BankAddEst" class="form-control rounded-corner" name="BankAddEst" required>
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
                <select id="ZoneAddEst" class="form-control rounded-corner" name="ZoneAddEst" required>
                  <option value="">Zone</option>
                </select>
              </div>
              <div class="col-sm-4">
                <select id="BranchAddEst" class="form-control rounded-corner" name="BranchAddEst" required>
                  <option value="">Branch</option>
                </select>
              </div>

            </div>

          </form>



          <form class="form-control rounded-corner" style="margin-top: 30px;" id="FNewEst">
            <div class="row">
              <div class="col-sm-5">
                <select id="ItemsEstimate" class="form-control rounded-corner" name="ItemsEstimate" required>
                  <option value="">Select Item</option>
                </select>
              </div>
              <div class="col-sm-5">
                <input type="number" class="form-control rounded-corner" min="0" name="" id="qtyEstimate">
              </div>
              <div class="col-sm-2" style="margin-top-50px;">
                <button type="button" class="btn btn-primary AddToEstimate">Add</button>
              </div>

            </div>

          </form>


          <table class="table table-hover table-bordered border-primary" style="margin-top:20px;">
            <thead>
              <th>Sr. No</th>
              <th>Material Name</th>
              <th>Rate</th>
              <th>Qunatity</th>
              <th>Amount</th>
              <th>Action</th>
            </thead>
            <tbody id="EstAddData"></tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary SaveNewEstimate" data-bs-dismiss="modal">Save</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>