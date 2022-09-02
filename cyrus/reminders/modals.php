
<div class="modal fade" id="Bill" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pending Bills</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="BillData" style="background-color: #f0f0f0;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="reminder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Enter Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="FormReminder">
          <div class="col-6 d-none">
            <input type="text" class="form-control my-select3" id="billid">
          </div>
          <div class="col-6 d-none">
            <input type="text" class="form-control my-select3" id="branch">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Detail of conversation with branch:</label>
            <textarea  rows="3" class="form-control my-select3" id="conversation"></textarea>
          </div>
          <div class="row">
            <div class="col-6">
              <label for="recipient-name" class="col-form-label">Next Reminder Date</label>
              <input type="date" class="form-control my-select3" id="NextDate">
            </div>
            <div class="col-6">
              <div class="form-check" style="margin-top: 60px;">
                <input class="form-check-input" type="checkbox" id="Action">
                <label class="form-check-label" for="flexCheckDefault" style="margin-top: -5px;">Action Required</label>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary SaveReminder" data-bs-dismiss="modal">Save</button>
        <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
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