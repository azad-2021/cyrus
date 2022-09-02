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


<div class="modal fade" id="ReceivedByUpdate" tabindex="-1"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="$modal-content rounded-corner-border-color:        rgba($black, .6);">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title modal-title3"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3 needs-validation" novalidate id="formReceivedBy" name="form">
          <div class="col-md-12 received">
            <label for="validationCustom01" class="form-label ">Update Received By</label>
            <input type="text" class="form-control rounded-corner" id="Received" name="InfoDate" required>
          </div>
          <div class="col-md-12 OrderID3 d-none">
            <label for="validationCustom01" class="form-label "></label>
            <input type="text" class="form-control rounded-corner " id="ODID" name="discription" required>
          </div>
          <div class="col-md-12 BranchCode3 d-none">
            <label for="validationCustom01" class="form-label "></label>
            <input type="text" class="form-control rounded-corner " id="BRCD" name="brcd" required>
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

<div class="modal fade" id="OrderByUpdate" tabindex="-1"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="$modal-content rounded-corner-border-color:        rgba($black, .6);">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title modal-title4"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3 needs-validation" novalidate id="formReceivedBy" name="form">
          <div class="col-md-12 orderby">
            <label for="validationCustom01" class="form-label ">Update Order By</label>
            <input type="text" class="form-control rounded-corner" id="orderby" name="InfoDate" required>
          </div>
          <div class="col-md-12 odid d-none">
            <label for="validationCustom01" class="form-label "></label>
            <input type="text" class="form-control rounded-corner " id="odid" name="discription" required>
          </div>
          <div class="col-md-12 Brcd d-none">
            <label for="validationCustom01" class="form-label "></label>
            <input type="text" class="form-control rounded-corner " id="Brcd" name="brcd" required>
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

<div class="modal fade" id="DiscriptionUpdateC" tabindex="-1"  aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" style="$modal-content rounded-corner-border-color:        rgba($black, .6);">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title modal-titleC"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body modal-bodyC">
        <form class="row g-3 needs-validation" novalidate id="formdC" name="form">
          <div class="col-md-12 DiscriptionC">
            <label for="validationCustom01" class="form-label ">Update Complaint Discription</label>
            <input type="text" class="form-control rounded-corner" id="discC" name="disc" required>
          </div>
          <div class="col-md-12 ComplaintID d-none">
            <label for="validationCustom01" class="form-label ">Update Discription</label>
            <input type="text" class="form-control rounded-corner " id="ComplaintID" name="discription" required>
          </div>
          <div class="col-md-12 BranchCodeC d-none">
            <label for="validationCustom01" class="form-label ">Update Discription</label>
            <input type="text" class="form-control rounded-corner " id="BranchCodeC" name="brcC" required>
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

<div class="modal fade" id="InfoDateUpdateC" tabindex="-1"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="$modal-content rounded-corner-border-color:        rgba($black, .6);">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title modal-titleC2"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3 needs-validation" novalidate id="formInfodateC" name="form">
          <div class="col-md-12 InfoC">
            <label for="validationCustom01" class="form-label ">Update Information Date of Complaint</label>
            <input type="date" class="form-control rounded-corner" id="InfoDateC" name="InfoDate" required>
          </div>
          <div class="col-md-12 ComplaintID2 d-none">
            <label for="validationCustom01" class="form-label "></label>
            <input type="text" class="form-control rounded-corner " id="ComplaintID2" name="discription" required>
          </div>
          <div class="col-md-12 BranchCodeC2 d-none">
            <label for="validationCustom01" class="form-label "></label>
            <input type="text" class="form-control rounded-corner " id="BranchCodeC2" name="brcd" required>
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

<div class="modal fade" id="ReceivedByUpdateC" tabindex="-1"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="$modal-content rounded-corner-border-color:        rgba($black, .6);">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title modal-titleC3"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3 needs-validation" novalidate id="formReceivedBy" name="form">
          <div class="col-md-12 receivedC">
            <label for="validationCustom01" class="form-label ">Update Received By Complaints</label>
            <input type="text" class="form-control rounded-corner" id="ReceivedC" name="ReceivedC" required>
          </div>
          <div class="col-md-12 ComplaintID3 d-none">
            <label for="validationCustom01" class="form-label "></label>
            <input type="text" class="form-control rounded-corner " id="ComplaintID3" name="discription" required>
          </div>
          <div class="col-md-12 BranchCodeC3 d-none">
            <label for="validationCustom01" class="form-label "></label>
            <input type="text" class="form-control rounded-corner " id="BranchCodeC3" name="brcd" required>
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


<div class="modal fade" id="MadeByUpdateC" tabindex="-1"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="$modal-content rounded-corner-border-color:        rgba($black, .6);">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title modal-titleC4"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3 needs-validation" novalidate id="formReceivedBy" name="form">
          <div class="col-md-12 madebyC">
            <label for="validationCustom01" class="form-label ">Update Made by</label>
            <input type="text" class="form-control rounded-corner" id="madebyC" name="InfoDate" required>
          </div>
          <div class="col-md-12 ComplaintID4 d-none">
            <label for="validationCustom01" class="form-label "></label>
            <input type="text" class="form-control rounded-corner " id="ComplaintID4" name="discription" required>
          </div>
          <div class="col-md-12 BranchCodeC4 d-none">
            <label for="validationCustom01" class="form-label "></label>
            <input type="text" class="form-control rounded-corner " id="BranchCodeC4" name="brcd" required>
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

<div class="modal fade" id="ViewBranch" tabindex="-1"  aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title">Branchs</h5>
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
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-titleM">Update Mobile</h5>
      </div>
      <div class="modal-bodyM">

        <form class="row g-3 needs-validation" novalidate id="form3" name="form">
          <div class="col-md-4 d-none">
            <label for="validationCustom04" class="form-label">Branch</label>
            <select id="BranchC" class="form-control rounded-corner" name="BranchCode" required>
            </select>
            <div class="invalid-feedback">
              Please select a valid Branch.
            </div>
          </div>
          <center>
            <div class="col-md-4 modal-body-mobile">
              <label for="validationCustom02" class="form-label ">Mobile</label>
              <input type="text" class="form-control rounded-corner" id="Mobile" name="Mobile" required>
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
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-titleE">Update Email</h5>
      </div>
      <div class="modal-body">

        <form class="row g-3 needs-validation" novalidate id="form4" name="form">
          <div class="col-md-4 d-none">
            <label for="validationCustom04" class="form-label">Branch</label>
            <select id="BranchC" class="form-control rounded-corner" name="BranchCode" required>
            </select>
            <div class="invalid-feedback">
              Please select a valid Branch.
            </div>
          </div> 
          <center>     
            <div class="col-md-4 modal-body-email">
              <label for="validationCustom01" class="form-label ">Email</label>
              <input type="text" class="form-control rounded-corner" id="Email" name="Email" required>
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
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title">Update GST No.</h5>
      </div>
      <div class="modal-body">

        <form class="row g-3 needs-validation" novalidate id="form5" name="form">
          <div class="col-md-4 d-none">
            <label for="validationCustom04" class="form-label">Branch</label>
            <select id="BranchC" class="form-control rounded-corner" name="BranchCode" required>
            </select>
            <div class="invalid-feedback">
              Please select a valid Branch.
            </div>
          </div>      

          <center>
            <div class="col-md-4">
              <label for="validationCustom02" class="form-label ">GST No.</label>
              <input type="text" class="form-control rounded-corner" id="GST" name="GST" required>
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

<div class="modal fade" id="gadgetUpdateC" tabindex="-1"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="$modal-content rounded-corner-border-color:        rgba($black, .6);">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title modal-titleC5"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3 needs-validation" novalidate id="formReceivedBy" name="form">
          <div class="col-md-12 gadgetC">
            <label for="validationCustom01" class="form-label ">Update Gadget</label>
            <select id="gadgetC" class="form-control rounded-corner" name="GadgetID" required>
              <option value="">Device</option>
              <?php
              $Device="Select * from gadget order by Gadget";
              $result=mysqli_query($con,$Device);
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
            <input type="text" class="form-control rounded-corner " id="ComplaintID5" name="discription" required>
          </div>
          <div class="col-md-12 BranchCodeC5 d-none">
            <label for="validationCustom01" class="form-label "></label>
            <input type="text" class="form-control rounded-corner " id="BranchCodeC5" name="brcd" required>
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

<div class="modal fade" id="gadgetUpdate" tabindex="-1"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="$modal-content rounded-corner-border-color:        rgba($black, .6);">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title modal-title5"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3 needs-validation" novalidate id="formReceivedBy" name="form">
          <div class="col-md-12 gadget">
            <label for="validationCustom01" class="form-label ">Update Gadget</label>
            <select id="gadget" class="form-control rounded-corner" name="GadgetID" required>
              <option value="">Device</option>
              <?php
              $Device="Select * from gadget order by Gadget";
              $result=mysqli_query($con,$Device);
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
            <input type="text" class="form-control rounded-corner " id="OrderID5" name="discription" required>
          </div>
          <div class="col-md-12 BranchCode5 d-none">
            <label for="validationCustom01" class="form-label "></label>
            <input type="text" class="form-control rounded-corner " id="BranchCode5" name="brcd" required>
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
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title">Update Branch Code</h5>
      </div>
      <div class="modal-body">

        <form class="row g-3 needs-validation" novalidate id="form5" name="form">
          <div class="col-md-4 d-none">
            <label for="validationCustom04" class="form-label">Branch</label>
            <select id="BranchC" class="form-control rounded-corner" name="BranchCode" required>
            </select>
            <div class="invalid-feedback">
              Please select a valid Branch.
            </div>
          </div>      

          <center>
            <div class="col-md-4">
              <label for="validationCustom02" class="form-label ">Branch Code</label>
              <input type="text" class="form-control rounded-corner" id="Branch_code" name="Branch_code" required>
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
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title">Add Order / Complaints</h5>
      </div>
      <div class="modal-body">

        <form class="row g-3 needs-validation" novalidate id="form" name="form">

          <div class="col-md-4 d-none">
            <label for="validationCustom04" class="form-label">Branch</label>
            <select id="BranchC" class="form-control rounded-corner" name="BranchCode" required>
            </select>
            <div class="invalid-feedback">
              Please select a valid Branch.
            </div>
          </div>

          <div class="col-md-4">
            <label for="validationCustom04" class="form-label">Select Type</label>
            <select id="Type" class="form-control rounded-corner" name="Type" required>
              <option value="">Select</option>
              <option value="Order">Order</option>
              <option value="Complaint">Complaint</option>
              <option value="AMC">AMC</option>
            </select>
            <div class="invalid-feedback">
              Please select a valid Type.
            </div>
          </div>

          <div class="col-md-4">
            <label for="validationCustom04" class="form-label">Device</label>
            <select id="Device" class="form-control rounded-corner" name="GadgetID" required>
              <option value="">Device</option>
              <?php
              $Device="Select * from gadget order by Gadget";
              $result=mysqli_query($con,$Device);
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
            <input type="text" class="form-control rounded-corner" id="ReceivedBy" name="ReceivedBy" required>
          </div>
          <div class="col-md-4">
            <label for="validationCustom02" class="form-label ">Made By</label>
            <input type="text" class="form-control rounded-corner" id="MadeBy" name="MadeBy" required>
          </div>
          <div class="col-md-4">
            <label for="validationCustom01" class="form-label ">Date Of Information</label>
            <input type="date" value="<?php echo $Date ?>" class="form-control rounded-corner" id="InfoDateAdd" name="InfoDate" required>
          </div>
          <div class="col-md-4">
            <label for="validationCustom01"  class="form-label ">Expected Completion</label>
            <input type="date" class="form-control rounded-corner" id="ExpectedAdd" name="ExpDate" required>
          </div>

          <div class="col-md-12">
            <label for="validationCustomUsername" class="form-label">Discription</label>
            <div class="input-group has-validation">
              <textarea class="form-control rounded-corner" id="DiscriptionAdd" name="Discription" required></textarea>
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

  <div class="modal" id="Reference" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content rounded-corner">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Generate Reference ID</h5>
        </div>
        <div class="modal-body">

          <form class="form-control rounded-corner" method="POST" action="">
            <center>
              <div class="col-lg-6">
                <label for="validationCustom01" class="form-label ">Reassign To</label>
                <select class="form-control rounded-corner" name="ReassignTo" id="ReassignGen">
                 <option value="">Select</option>        
                 <?php

                 $queryTech="SELECT * FROM employees Where Inservice=1 order by `Employee Name`"; 
                 $resultTech=mysqli_query($con,$queryTech);
                 while($data=mysqli_fetch_assoc($resultTech)){

                  echo "<option value=".$data['EmployeeCode'].">".$data['Employee Name']."</option>"; 
                }
                ?>
              </select>
              <input class="d-none" type="text" name="TypeGen" id="TypeGen">
              <input class="d-none" type="number" name="ID" id="QID">
            </div>
          </center>
        </form>
      </div>

      <div class="modal-footer">
        <button class="btn btn-primary GenerateRefID" data-bs-dismiss="modal">Save</button>
        <input class="btn btn-secondary" type="reset"  data-bs-dismiss="modal" value="Close">
      </div>

    </div>
  </div>
</div>
