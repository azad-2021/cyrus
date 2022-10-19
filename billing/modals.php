
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



<div class="modal fade" id="ViewWork" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Materials for Billing</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h5 align="center">Approved Materials</h5>
        <table class="table table-hover table-bordered border-primary" id="branchdata" style="margin:25px;">
          <thead>
            <tr>
              <th style="min-width:100px">Sr. No.</th>
              <th style="min-width:200px">Material</th>
              <th style="min-width:250px">Bar Code</th>
              <th style="min-width:80px">Rate</th>
              <th style="min-width:100px">Quantity</th>
              <th style="min-width:100px">Amount</th>
              <th style="min-width:100px">Discount</th>
              <th style="min-width:120px">GST</th>
              <th style="min-width:120px">HSN Code</th>
              <th style="min-width:250px">Select Category</th>
              <th style="min-width:100px">Delete</th>
            </tr>
          </thead>
          <tbody id="material">

          </tbody>
        </table>

        <h5 align="center">Additional Materials</h5>
        <table class="table table-hover table-bordered border-primary" id="branchdata" style="margin:25px;">
          <thead>
            <tr>
              <th style="min-width:100px">Sr. No.</th>
              <th style="min-width:200px">Material</th>

              <th style="min-width:80px">Rate</th>
              <th style="min-width:100px">Quantity</th>
              <th style="min-width:100px">Amount</th>
              <th style="min-width:100px">Discount</th>
              <th style="min-width:120px">GST</th>
              <th style="min-width:120px">HSN Code</th>
              <th style="min-width:250px">Category</th>
              <th style="min-width:100px">Delete</th>
            </tr>
          </thead>
          <tbody id="materialAD">

          </tbody>
        </table>

        <div style="float: right;">
          <h4 id="TotalAmount">0</h4>
          <label>Additional Discount </label>
          <input type="number" name="" id="AddDiscount" class="form-control rounded-corner">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary Add" data-bs-toggle="modal" data-bs-target="#addItem">Add Approved Material</button>
        <button type="button" class="btn btn-primary AddAdditional" data-bs-toggle="modal" data-bs-target="#addItemAdditional">Add Additional Material</button>
        <button type="button" class="btn btn-primary GenerateInvoice">Generate Invoice</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="addItemAdditional" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add additional materials</h5>
        <button type="button" class="btn-close ShowMaterial" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">


        <form class="rounded-corner" id="FAdd" style="justify-content:center;" style="margin:25px;">
          <div class="row">

            <div class="col-lg-3">
              <label>Material Name</label>
              <input type="text" id="ItemAdd" name="MaterialName" class="form-control rounded-corner">
            </div>
            
            <div class="col-lg-3">
              <label>Rate</label>
              <input type="number" min="0" name="Rate" id="RateAdd" class="form-control rounded-corner">
            </div>

            <div class="col-lg-3">
              <label>Quantity</label>
              <input type="number"  name="Qty" id="QtyAdd" class="form-control rounded-corner">
            </div>
            <div class="col-lg-3">
              <label>Amount</label>
              <input type="text" id="AmmountAdd" class="form-control rounded-corner" disabled>
            </div>
            <div class="col-lg-3">
              <label>Select Category</label>
              <select class="form-control rounded-corner" id="GstRatesNew">
                <option value="">Select</option>
                <?php
                $Query="SELECT * FROM `gst rates` order by CatagoryName";
                $resultG=mysqli_query($con2,$Query);
                while ($rowG=mysqli_fetch_assoc($resultG)){

                  $d = array("HSN"=>$rowG['HSNCode'], "GST"=>$rowG['Rate'], "CategoryID"=>$rowG['ItemID']);
                  $data = json_encode($d);
                  echo "<option value='".$data."''>".$rowG['CatagoryName'].'</option>';
                }
                ?>

              </select>
            </div>

            <div class="col-lg-3">
              <label>HSN Code</label>
              <input type="text" name="HSN" id="HSNAdd" class="form-control rounded-corner" disabled>
            </div>
            <div class="col-lg-3">
              <label>GST</label>
              <input type="text" name="GST" id="GSTAdd" class="form-control rounded-corner" disabled>
            </div>
            <div class="col-lg-3">
              <label>Discount</label>
              <input type="number" min="0" id="DiscAdd" value="0" name="Discount" class="form-control rounded-corner">
            </div>
            
            
          </div>
          <br>
          <center><button type="button" class="btn btn-primary SaveAdditionalItems">Add</button></center>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary ShowMaterial" data-bs-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>



<div class="modal fade" data-bs-backdrop="static" id="addItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog modal-lg modal-dialog-top modal-dialog-scrollable">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Approved Materials</h5>
        <button type="button" class="btn-close ShowMaterial" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="material">

        </div>
        <br><!--
        <form id="f1">
          <div class="row text-centered">
            <div class="col-lg-5">
              <center>
                <label >Select Items</label>
              </center>
              <select id="ItemA" class="form-control rounded-corner" name="Items" required>
                <option value="">Select</option>
              </select>
            </div>
            <div class="col-lg-5">
              <center>
                <label>Enter Quantity</label>
              </center>
              <input type="number" name="" id="qty" class="form-control rounded-corner" onkeydown="limit(this);" onkeyup="limit(this);">
            </div>
            <div class="col-lg-2">
              <center>
                <label></label>
                <br>
              </center>
              <button type="button" class="btn btn-primary btn-lg addItems">Add</button>
            </div>
          </div>
        </form>
      -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary ShowMaterial" data-bs-dismiss="modal">Close</button>
        <!--<button type="button" class="btn btn-primary cl confirm">Confirm</button>-->
      </div>
    </div>
  </div>
</div>