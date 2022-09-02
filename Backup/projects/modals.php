
<!--

<div class="modal fade" id="AddOrder" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title">Enter Details</h5>
      </div>
      <div class="modal-body">

        <form class="row g-3 needs-validation" novalidate id="form" name="form">

          <div class="col-md-4">
            <label for="validationCustom01" class="form-label ">Organization</label>
            <select class="form-control rounded-corner" id="Organization">
              <option>Select</option>
              <?php
              $query="SELECT * from projects.organization order by OrganizationName";
              $result=mysqli_query($con,$query);
              if (mysqli_num_rows($result)>0)
              {
                while ($arr=mysqli_fetch_assoc($result))
                {
                  ?>
                  <option value="<?php echo $arr['OrganizationCode']; ?>"><?php echo $arr['OrganizationName']; ?></option>
                  <?php
                }
              }
              ?>
            </select>
          </div>

          <div class="col-md-4">
            <label for="validationCustom01" class="form-label ">Division</label>
            <select class="form-control rounded-corner" id="Division">
              <option>Select</option>
            </select>
          </div>

          <div class="col-md-4">
            <label for="validationCustom01" class="form-label ">Information Date</label>
            <input type="date" class="form-control rounded-corner" id="InfoDateAdd" name="InfoDate">
          </div>
          <div class="col-md-4">
            <label for="validationCustom01"  class="form-label ">Expected Completion</label>
            <input type="date" class="form-control rounded-corner" id="ExpectedAdd" name="ExpDate" required>
          </div>

          <div class="col-md-8">
            <label for="validationCustomUsername" class="form-label">Description</label>
            <textarea class="form-control rounded-corner" id="DescriptionAdd" name="Discription" required></textarea> 
          </div>
          <div class="table-responsive">
            <table class="table table-hover table-bordered border-primary">
              <thead>
                <th>Site Name</th>
                <th><input  class="form-check-input" type="checkbox" value="" id="SelectAll" style="margin-top: 15px;">
                  <label class="form-check-label">
                    Select All
                  </label></th>
                </thead>
                <tbody id="Site">

                </tbody>
              </table>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" data-bs-toggle="modal" data-bs-target="#AddMaterial" class="btn btn-primary">Add Material</button>
            <button type="button" data-bs-dismiss="modal" class="btn btn-primary SaveOrder">Save</button>
            <input class="btn btn-secondary" type="reset"  data-bs-dismiss="modal" value="Close"></div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="AddMaterial" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
      <div class="modal-content rounded-corner">
        <div class="modal-header">
          <h5 class="modal-title">Enter Material Detail</h5>
        </div>
        <div class="modal-body">

          <form class="row g-3 needs-validation field" novalidate id="form" name="form">

            <div class="col-md-4">
              <label for="validationCustom01" class="form-label ">Enter Material Name</label>
              <input type="text" class="form-control rounded-corner" id="MaterialName" name="NameArray[]">
            </div>

            <div class="col-md-4">
              <label for="validationCustom01" class="form-label ">Rate</label>
              <input type="number" min=0 class="form-control rounded-corner" id="MaterialRate" name="RateArray[]">
            </div>


            <div class="col-md-4">
              <label for="validationCustom01" class="form-label ">Select Category</label>
              <select class="form-control rounded-corner" id="Organization" name="ItemArray[]">
                <option>Select</option>
                <?php
                $query="SELECT * from cyrusbackend.item order by ItemName";
                $result=mysqli_query($con,$query);
                if (mysqli_num_rows($result)>0)
                {
                  while ($arr=mysqli_fetch_assoc($result))
                  {
                    ?>
                    <option value="<?php echo $arr['ItemID']; ?>"><?php echo $arr['ItemName']; ?></option>
                    <?php
                  }
                }
                ?>
              </select>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary add_button" onclick="javascript:void(0);">More material</button>
          <button class="btn btn-secondary showAddOrder"  data-bs-dismiss="modal" value="Close">Close</button></div>
        </div>
      </div>
    </div>
  </div>

  -->