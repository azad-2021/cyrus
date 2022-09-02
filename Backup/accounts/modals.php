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
