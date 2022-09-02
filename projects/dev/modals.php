<div class="modal fade" id="dataModal" tabindex="-1"  aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title">Order details</h5>
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

<div class="modal fade" id="ViewVAT" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title">VAT Bill details</h5>
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


<div class="modal fade" id="ViewGST" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title">GST Bill Details</h5>
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


<div class="modal fade" id="dataModal3" tabindex="-1"  aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title">Jobcard details</h5>
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

<div class="modal fade" id="dataModal2" tabindex="-1"  aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title">Complaint details</h5>
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
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title">Update Phone Number</h5>
      </div>
      <div class="modal-body">

        <form class="row g-3 needs-validation" novalidate id="form2" name="form">
          <div class="col-md-4 d-none">
            <label for="validationCustom04" class="form-label">Branch</label>
            <select id="BranchC" class="form-control rounded-corner" name="BranchCode" required>
            </select>
            <div class="invalid-feedback">
              Please select a valid Branch.
            </div>
          </div>
          <center>
            <div class="col-md-4 modal-body-phone">
              <label for="validationCustom01" class="form-label ">Phone</label>
              <input type="text" class="form-control rounded-corner " id="Phone" name="Phone" required>
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
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title">Find Order</h5>
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

<div class="modal fade" id="ViewOrder" tabindex="-1"  aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title">Order Details</h5>
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
        <h5 class="modal-title">Find Complaint</h5>
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

<div class="modal fade" id="ViewComplaint" tabindex="-1"  aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title">Complaint Details</h5>
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
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title">Find Jobcard</h5>
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

<div class="modal fade" id="ViewJobcard" tabindex="-1"  aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title">Job Card Details</h5>
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
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title">Find Jobcard</h5>
      </div>
      <div class="modal-body">

        <form class="row g-3 needs-validation" novalidate id="formd" name="form">
          <center>
            <div class="col-md-4">
              <label for="validationCustom01" class="form-label ">Enter Jobcard Number</label>
              <input type="text" class="form-control rounded-corner" id="discription" name="discription" required>
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

<div class="modal fade" id="DiscriptionUpdate" tabindex="-1"  aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" style="$modal-content rounded-corner-border-color:        rgba($black, .6);">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3 needs-validation" novalidate id="formd" name="form">
          <div class="col-md-12 Discription">
            <label for="validationCustom01" class="form-label ">Update Discription</label>
            <input type="text" class="form-control rounded-corner" id="disc" name="disc" required>
          </div>
          <div class="col-md-12 OrderID d-none">
            <label for="validationCustom01" class="form-label ">Update Discription</label>
            <input type="text" class="form-control rounded-corner " id="OrderID1" name="discription" required>
          </div>
          <div class="col-md-12 BranchCode d-none">
            <label for="validationCustom01" class="form-label ">Update Discription</label>
            <input type="text" class="form-control rounded-corner " id="brc" name="brc" required>
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

<div class="modal fade" id="InfoDateUpdate" tabindex="-1"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="$modal-content rounded-corner-border-color:        rgba($black, .6);">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title modal-title2"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3 needs-validation" novalidate id="formInfodate" name="form">
          <div class="col-md-12 Info">
            <label for="validationCustom01" class="form-label ">Update Information Date</label>
            <input type="date" class="form-control rounded-corner" id="InfoDate" name="InfoDate" required>
          </div>
          <div class="col-md-12 OrderID2 d-none">
            <label for="validationCustom01" class="form-label "></label>
            <input type="text" class="form-control rounded-corner " id="OID" name="discription" required>
          </div>
          <div class="col-md-12 BranchCode2 d-none">
            <label for="validationCustom01" class="form-label "></label>
            <input type="text" class="form-control rounded-corner " id="brcd" name="brcd" required>
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


<div class="modal fade" id="ExpDateUpdate" tabindex="-1"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="$modal-content rounded-corner-border-color:        rgba($black, .6);">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title modal-title2"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3 needs-validation" novalidate id="formInfodate" name="form">
          <div class="col-md-12 Info">
            <label for="validationCustom01" class="form-label ">Update Expeted Completion Date</label>
            <input type="date" class="form-control rounded-corner" id="expeDate" name="expDate" required>
          </div>
          <div class="col-md-12 OrderID2 d-none">
            <label for="validationCustom01" class="form-label "></label>
            <input type="text" class="form-control rounded-corner " id="expOID" name="discription" required>
          </div>
          <div class="col-md-12 BranchCode2 d-none">
            <label for="validationCustom01" class="form-label "></label>
            <input type="text" class="form-control rounded-corner " id="expbrcd" name="brcd" required>
          </div>
        </div>

        <div class="modal-footer">
          <input data-bs-dismiss="modal" class="btn btn-primary update_ExpectedDate" value="Update">
          <input class="btn btn-secondary" type="reset"  data-bs-dismiss="modal" value="Close">
        </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="ExpDateUpdateC" tabindex="-1"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="$modal-content rounded-corner-border-color:        rgba($black, .6);">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title modal-title2"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3 needs-validation" novalidate id="formInfodate" name="form">
          <div class="col-md-12 Info">
            <label for="validationCustom01" class="form-label ">Update Expeted Completion Date</label>
            <input type="date" class="form-control rounded-corner" id="expeDateC" name="expDate" required>
          </div>
          <div class="col-md-12 OrderID2 d-none">
            <label for="validationCustom01" class="form-label "></label>
            <input type="text" class="form-control rounded-corner " id="expCID" name="discription" required>
          </div>
          <div class="col-md-12 BranchCode2 d-none">
            <label for="validationCustom01" class="form-label "></label>
            <input type="text" class="form-control rounded-corner " id="expbrcdC" name="brcd" required>
          </div>
        </div>

        <div class="modal-footer">
          <input data-bs-dismiss="modal" class="btn btn-primary update_ExpectedDateC" value="Update">
          <input class="btn btn-secondary" type="reset"  data-bs-dismiss="modal" value="Close">
        </div>
      </form>
    </div>
  </div>
</div>

<!-- End Update Complaints -->

<div class="modal fade" id="ViewJobcard" tabindex="-1"  aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title">Job Card Details</h5>
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
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title">Find Branch</h5>
      </div>
      <div class="modal-body">

        <form class="row g-3 needs-validation" novalidate id="formB" name="form">
          <div class="col-md-6">
            <label for="validationCustom01" class="form-label " align="center">Select Search Type</label>
            <select class="form-select rounded-corner" aria-label="Default select example" id="type">
              <option value="">Select</option>
              <option value="Name">Site Name</option>
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

<div class="modal fade" id="ViewBranch" tabindex="-1"  aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title">Site</h5>
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



<div class="modal fade" id="AddOrder" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title">Enter work details</h5>
      </div>
      <div class="modal-body">

        <form class="row g-3 needs-validation" novalidate id="form" name="form">

          <div class="col-md-4">
            <label for="validationCustom01" class="form-label ">LOA Date</label>
            <input type="date" class="form-control rounded-corner" id="InfoDateAdd" name="InfoDate">
          </div>
          <div class="col-md-4">
            <label for="validationCustom01"  class="form-label ">Expected Completion</label>
            <input type="date" class="form-control rounded-corner" id="ExpectedAdd" name="ExpDate" required>
          </div>

          <div class="col-md-4">
            <label for="validationCustomUsername" class="form-label">Waranty in months</label>
            <div class="input-group has-validation">
              <input type="number" id="waranty" class="form-control rounded-corner" name="waranty" min="0">
            </div>
          </div>

          <div class="col-md-3">
            <label for="validationCustomUsername" class="form-label">BG Amount</label>
            <div class="input-group has-validation">
              <input type="number" id="BGAmount" class="form-control rounded-corner" name="waranty" min="0">
            </div>
          </div>
          <div class="col-md-3">
            <label for="validationCustom01" class="form-label ">BG Validity Date</label>
            <input type="date" class="form-control rounded-corner" id="BGValidity" name="InfoDate" required>
          </div>
          <div class="col-md-6">
            <label for="validationCustomUsername" class="form-label">Description</label>
            <div class="input-group has-validation">
              <textarea class="form-control rounded-corner" id="DescriptionAdd" name="Discription" required></textarea>
              <div class="invalid-feedback">
                Please enter a Description.
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" data-bs-dismiss="modal" class="btn btn-primary SaveOrder">Save</button>
        <input class="btn btn-secondary" type="reset"  data-bs-dismiss="modal" value="Close"></div>
      </form>
    </div>
  </div>
</div>



