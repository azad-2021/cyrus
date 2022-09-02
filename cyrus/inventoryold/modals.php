<div class="modal fade" id="ReleasePrint" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Print Released Orders</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="form-control" target="_blank" action="printRelease.php" method="post">
        <div class="row">
          <div class="col-md-5">
            <label for="validationCustom01" class="form-label " align="center">Select Employee</label>
            <select class="form-select my-select3" aria-label="Default select example" name="EmployeeCode" required>
              <option value="">Select</option>
              <?php 
              $query="SELECT * FROM employees WHERE Inservice=1 Order By `Employee Name`";
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
        <div class="col-md-5">
          <label for="validationCustom01" class="form-label " align="center">Date</label>
          <input type="date" class="form-control my-select3" name="Sdate" id="Sdate" required>
        </div>
        <div class="col-md-2">
          <br>
          <button style="margin-top: 20px;" type="submit" class="btn btn-primary">Print</button>
        </div>
      </div>
      </form>

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    </div>
  </div>
</div>
</div>


