
<div class="modal fade" id="AddDetails" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title">Enter work details</h5>
      </div>
      <div class="modal-body">

        <form class="row g-3 needs-validation" novalidate id="form" name="form">

          <div class="col-md-4">
            <label for="validationCustom01" class="form-label ">Order ID</label>
            <input type="number" class="form-control rounded-corner" id="OrderID" name="InfoDate" disabled>
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


