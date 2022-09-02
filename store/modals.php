    <div class="modal fade" id="Challan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content rounded-corner">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">View Challan Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <form class="form-control" action="">
                <div class="row">
                  <div class="col-lg-6">
                    <label for="validationCustom01" class="form-label " align="center">Select Employee</label>
                    <select class="form-select rounded-corner" aria-label="Default select example" id="EmployeeCodeW" name="EmployeeID" required="">
                      <option value="">Select</option>
                      <?php 
                      $query="SELECT * FROM employees WHERE Inservice=1 order by `Employee Name`";
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
                <div class="col-lg-6">
                  <label for="validationCustom01" class="form-label " align="center">Date</label>
                  <input type="date" class="form-control rounded-corner" name="SDate" id="Sdate" required>
                </div>
              </div>
            </form>
            
            <div class="table-responsive" style="margin-top:20px">
              <table class="table table-bordered border-primary display">

                <thead>
                  <tr>
                    <th style="min-width:80px">Sr. No.</th>
                    <th style="min-width:300px">Challan No.</th>
                    <th style="min-width:150px">Type</th>
                    <th style="min-width:150px">Address</th>
                    <th style="min-width:150px">Print Challan</th>
                    <th style="min-width:150px">Cancel Challan</th>
                  </tr>
                </thead>
                <tbody id="ChallanView">

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
  </div>


  <div class="modal fade" id="Edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content rounded-corner">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">

            <form class="form-control" action="challan.php" method="get" target="_blank">
              <div class="row">
                <div class="col-lg-6">
                  <label for="validationCustom01" class="form-label " align="center">Select Employee</label>
                  <select class="form-select rounded-corner" aria-label="Default select example" id="EmployeeCodeE" required="">
                    <option value="">Select</option>
                    <?php 
                    $query="SELECT * FROM employees WHERE Inservice=1 order by `Employee Name`";
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
              <div class="col-lg-6">
                <label for="validationCustom01" class="form-label " align="center">Date</label>
                <input type="date" class="form-control rounded-corner" id="DateE" required>
              </div>
            </div>
          </form>


        </div>
        <div class="table-responsive">
          <table class="table table-bordered border-primary display"  id="myTable">

            <thead>
              <tr>
                <th style="min-width:80px">Sr. No.</th>
                <th style="min-width:300px">Description</th>
                <th style="min-width:150px">Bar Code</th>
              </tr>
            </thead>
            <tbody id="ChallanDataE">

            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="FindChallan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Find Challan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <center>
            <form class="form-control" action="challan.php" method="GET" target="blank">
              <div class="col-md-4">
                <label for="validationCustom01" class="form-label " align="center">Enter Challan No.</label>
                <input type="text" id="ChallanF" class="form-control rounded-corner" name="ChallanNo" required>
              </div>
              <!--
              <div class="col-md-4">
                <center><input type="radio" class="checkbox" style="margin-top: 10px;" Name="Type" value="Railways">Railways<center>
                </div>
              -->
              <br>

              <div class="col-md-4">
                <button type="submit" class="btn btn-primary Find" data-bs-dismiss="modal" value="submit">Find</button>
              </div>
            </form>
          </center>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="EditBarCode" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Bar Code</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <center>
            <form class="form-control" id="EFBarCode">
              <div class="col-md-4">
                <label for="validationCustom01" class="form-label " align="center">Enter Bar Code</label>
                <input type="text" id="EBarCode" class="form-control rounded-corner" name="ChallanNo" required>
              </div>
            </form>
          </center>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary SaveEBarcode" data-bs-dismiss="modal">Save</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="ServiceCenter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Service Center Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
        </div>
        <div class="table-responsive">
          <table class="table table-bordered border-primary display"  id="myTable">

            <thead>
              <tr>
                <th style="min-width:80px">Sr. No.</th>
                <th style="min-width:300px">Description</th>
                <th style="min-width:100px">Total Items</th>
                <th style="min-width:100px">Returned Items</th>
                <th style="min-width:100px">Reused Items</th>
              </tr>
            </thead>
            <tbody id="ServiceCenterData">

            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="ServiceDetails" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Service Center Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
        </div>
        <div class="table-responsive">
          <table class="table table-bordered border-primary display"  id="myTable">

            <thead>
              <tr>
                <th style="min-width:80px">Sr. No.</th>
                <th style="min-width:300px">Description</th>
                <th style="min-width:100px">Challan No</th>
                <th style="min-width:100px">Action</th>
              </tr>
            </thead>
            <tbody id="ServiceData">

            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="ServiceCenterReturned" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Returned Items Entry</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form class="form-control" action="" id="Freturn">
          <div class="row">
            <center>
              <div class="col-lg-12" style="margin: 10px;">
                <label for="validationCustom01" class="form-label " align="center">New Serial No.</label>
                <input type="checkbox" name="NewSerialNo" id="NewSerialNo" class="form-check-input" value="New">
              </div>
            </center>
            <br>
            <div class="col-lg-3">
              <label for="validationCustom01" class="form-label " align="center">Select Item</label>
              <select class="form-select rounded-corner" id="RItemID" required="">
                <option value="">Select</option>
                <?php 
                $query="SELECT * FROM servicecenter
                join cyrusbackend.item on servicecenter.ItemID=item.ItemID
                WHERE Returned=0 order by ItemName";
                $result=mysqli_query($con2,$query);
                if (mysqli_num_rows($result)>0)
                {
                 while ($a=mysqli_fetch_assoc($result))
                 {

                  echo "<option value='".$a['ItemID']."'>".$a['ItemName']."</option><br>";
                }
              }
              ?>
            </select>
          </div>

          <div class="col-lg-3">
            <label class="form-label " align="center">Select Serial No.</label>
            <select class="form-select rounded-corner" id="RSerialNo" required="">
              <option value="">Select</option>
            </select>
          </div>

          <div class="col-lg-3">
            <label for="validationCustom01" class="form-label " align="center">Returned Date</label>
            <input type="date" class="form-control rounded-corner" id="RDate" required>
          </div>
          <div class="col-lg-3">
            <label for="validationCustom01" class="form-label " align="center">New Serial No.</label>
            <input type="text" class="form-control rounded-corner" id="NewSr" required>
          </div>
        </div>
      </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary SaveReturned">Save</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>


<div class="modal fade" id="ReturnedRelease" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content rounded-corner">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Enter Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form class="form-control" action="" id="Freturn">
          <div class="row">

            <div class="col-lg-3">
              <label class="form-label " align="center">Select State</label>
              <select class="form-select rounded-corner" id="RRStates" required="">
                <option value="">Select</option>
                <?php 
                $query="SELECT * FROM states";
                $result=mysqli_query($con2,$query);
                if (mysqli_num_rows($result)>0)
                {
                 while ($a=mysqli_fetch_assoc($result))
                 {

                  echo "<option value='".$a['StateCode']."'>".$a['State Name']."</option><br>";
                }
              }
              ?>
            </select>
          </div>

          <div class="col-lg-3">
            <label class="form-label " align="center">Select Employee</label>
            <select class="form-select rounded-corner" id="RREmployeeCode" required="">
              <option value="">Select</option>
              <?php 
              $query="SELECT * FROM employees WHERE Inservice=1 order by `Employee Name`";
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
        <div class="col-lg-3">
          <label for="validationCustom01" class="form-label " align="center">Select Item</label>
          <select class="form-select rounded-corner" id="RRItemID" required="">
            <option value="">Select</option>
            <?php 
            $query="SELECT * FROM servicecenter
            join cyrusbackend.item on servicecenter.ItemID=item.ItemID
            WHERE Returned=1 and Used=0 order by ItemName";
            $result=mysqli_query($con2,$query);
            if (mysqli_num_rows($result)>0)
            {
             while ($a=mysqli_fetch_assoc($result))
             {

              echo "<option value='".$a['ItemID']."'>".$a['ItemName']."</option><br>";
            }
          }
          ?>
        </select>
      </div>
      
        <div class="col-lg-3">
          <label for="validationCustom01" class="form-label " align="center">Enter BarCode</label>
          <input type="text" name="" id="RRBarCode" class="form-control rounded-corner" onkeyup="showResult(this.value)">
          <div id="livesearch"></div>
        </div>
        <center>
        <div class="col-lg-4">
          <label for="validationCustom01" class="form-label " align="center">Address</label>
          <input type="text" class="form-control rounded-corner" id="RRAddress" required>
        </div>
      </center>
    </div>
  </form>
  <div class="modal-footer">
    <button type="button" class="btn btn-primary SaveReturnedReleased">Save</button>
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
  </div>
</div>
</div>
</div>
</div>
