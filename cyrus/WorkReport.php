<?php
include"connection.php";
$ControlerID=6;
$queryTech="SELECT `Assign To`, `Employee Name` FROM cyrusbackend.`cyrus regions`
join districts on `cyrus regions`.RegionCode=districts.RegionCode
join employees on districts.`Assign To`=employees.EmployeeCode
where ControlerID=$ControlerID group by `Assign To` order by `Employee Name`"; 
$resultTech=mysqli_query($con,$queryTech);

?>

<!DOCTYPE html>
<html lang="en"> 
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <title>Graph</title> 

  <style type="text/css">
  .my-select {
    background-color: $light-brown;
    color: $dark-grey;
    border-radius: 20px;
    text-align: center;

  }
</style>

</head>
<body>
  <div class="container">
    <!-- Button trigger modal -->
    <br>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#SelectEngineer">
      Work Report
    </button>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#SelectEngineer2">
      Work Report Table
    </button>
    <div class="modal fade" id="SelectEngineer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Work Report</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="GET" action="Report.php" target="_blank">
              <div class="mb-3">
                <select  required name="EmployeeCode" class="form-control select my-select" required>
                  <option>Select</option>
                  <?php
                  while($data=mysqli_fetch_assoc($resultTech)){
                    echo "<option value=".$data['Assign To'].">".$data['Employee Name']."</option>";
                  }  
                  ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="bdaymonth">Start Date</label>
                <input class="form-control my-select" type="date" name="SDate">
              </div>
              <div class="mb-3">
                <label for="bdaymonth">End Date</label>
                <input class="form-control my-select" type="date" name="EDate">
              </div>
              <center>
                <div class="mb-3">
                  <button class="btn btn-primary" type="submit">Submit</button>
                </div>
              </center>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>



    <div class="modal fade" id="SelectEngineer2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Work Report</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="GET" action="Report2.php" target="_blank">
              <div class="mb-3">
                <select  required name="EmployeeCode" class="form-control select my-select" required>
                  <option>Select</option>
                  <?php
                  $query="SELECT `Employee Name`, EmployeeCode FROM cyrusbackend.employees WHERE Inservice=1 order by `Employee Name`";
                  $result=mysqli_query($con,$query);
                  while($data=mysqli_fetch_assoc($result)){
                    echo "<option value=".$data['EmployeeCode'].">".$data['Employee Name']."</option>";
                  }  
                  ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="bdaymonth">Start Date</label>
                <input class="form-control my-select" type="date" name="SDate">
              </div>
              <div class="mb-3">
                <label for="bdaymonth">End Date</label>
                <input class="form-control my-select" type="date" name="EDate">
              </div>
              <center>
                <div class="mb-3">
                  <button class="btn btn-primary" type="submit">Submit</button>
                </div>
              </center>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

  </div>

</body>
</html>