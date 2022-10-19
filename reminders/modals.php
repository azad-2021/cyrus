
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
    <div class="modal-content rounded-corner">
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
              <div class="form-check" style="margin-top: 40px;">
                <input class="form-check-input" type="checkbox" id="Action">
                <label class="form-check-label" for="flexCheckDefault" style="margin-top: -5px;">Action Required</label>
              </div>
            </div>
            <div class="col-12 form-check form-check-inline" align="right" style="margin-top: 30px;">
              <label>Call Received</label>

              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="CallReceived" id="CallReceived" value="Yes">
                <label class="form-check-label" for="inlineRadio1">Yes</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="CallReceived" id="CallReceived" value="No">
                <label class="form-check-label" for="inlineRadio2">No</label>
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



<div class="modal" id="MailBox" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Send E-mail to branch</h5>
      </div>
      <div class="modal-body">

        <form class="form-control rounded-corner" novalidate id="formB" name="form">
          <div class="row">
            <center>
              <div class="col-md-6" style="margin-bottom: 10px;">
                <label for="validationCustom01" class="form-label " align="center">Branch Email</label>
                <input type="email" class="form-control rounded-corner" name="BranchMail" id="BranchMail" required disabled>
              </div>
            </center>
            <div class="col-md-4">
              <label for="validationCustom01" class="form-label ">Branch Mobile No. 1</label>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="CheckBranchNo1" style="margin-top: 10px;">
                <label class="form-check-label" for="defaultCheck1">
                 <input type="text" name="" id="BranchNo1" class="form-control rounded-corner" disabled>
               </label>
             </div>
           </div>
           <div class="col-md-4">
            <label for="validationCustom01" class="form-label ">Branch Mobile No. 2</label>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="CheckBranchNo2" style="margin-top: 10px;">
              <label class="form-check-label" for="defaultCheck1">
               <input type="text" name="" id="BranchNo2" class="form-control rounded-corner" disabled>
             </label>
           </div>
         </div>

         <div class="col-md-4">
          <label for="validationCustom01" class="form-label ">Branch Mobile No. 3</label>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="CheckBranchNo3" style="margin-top: 10px;">
            <label class="form-check-label" for="defaultCheck1">
             <input type="text" name="" id="BranchNo3" class="form-control rounded-corner" disabled>
           </label>
         </div>
       </div>


       <div class="col-md-4" style="justify-content: center;">
        <label for="validationCustom01" class="form-label ">Branch Phone No.</label>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="CheckBranchNo3" style="margin-top: 10px;">
          <label class="form-check-label" for="defaultCheck1">
           <input type="text" name="" id="BranchPhone" class="form-control rounded-corner" disabled>
         </label>
       </div>
     </div>


     <input type="text" class="d-none" name="" id="MailBranchCode">
   </div>
 </form>
</div>
<div class="modal-footer">
  <button class="btn btn-primary SendMail">Send</button>

</div>

</div>
</div>
</div>



<!-- End Search Branch -->