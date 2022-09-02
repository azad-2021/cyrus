<?php
include('connection.php'); 
include 'session.php';
$username = $_SESSION['user'];



$query ="SELECT * FROM `gadget`";
$results = mysqli_query($con, $query);


$query ="SELECT * FROM `operators`";
$resultOperator = mysqli_query($con, $query);

$query2 ="SELECT * FROM `operators`";
$results2 = mysqli_query($con, $query2);

if(isset($_POST['submit'])){




  $Branch=$_POST['Branch'];
  $GadgetID=$_POST['GadgetID'];
  $Validity=$_POST['Validity'];
  $SimType=$_POST['SimType'];
  $OperatorID=$_POST['OperatorID'];
  $Remark=$_POST['Remark'];
  $Provider=$_POST['Provider'];
  $RefID=$_POST['RefID'];

  $errors='';

  if($Provider=='Cyrus'){
    if (empty($Validity)==true) {
      $errors='<script>alert("Please Enter Validity of Recharge")</script>';
    }
  }

  if(isset($_POST['Other'])){
    $_POST['Other'];

    if ($Other=='1') {

      if (empty($Remark)==true) {
        $errors='<script>alert("Please Enter Remark")</script>';
      }
    }
  }elseif($GadgetID=='5') {
    if (empty($_POST['categoryZ2M1'] or $_POST['categoryZ2M2'])==true) {

      $errors='<script>alert("Please Enter Zone Message")</script>';
    }else{

      $CatZ2M1=$_POST['categoryZ2M1'];
      $CatZ2M2=$_POST['categoryZ2M2'];

      $Category='Zone 1 = '.$CatZ2M1.';
      Zone 2 = '.$CatZ2M2;
    }
  }elseif ($GadgetID=='6') {
    if (empty($_POST['categoryZ4M1'] or $_POST['categoryZ4M2'] or $_POST['categoryZ4M3'] or $_POST['categoryZ4M4'])==true) {
      $errors='<script>alert("Please Enter Zone Message")</script>';
    }else{


      $CatZ4M1=$_POST['categoryZ4M1'];
      $CatZ4M2=$_POST['categoryZ4M2'];
      $CatZ4M3=$_POST['categoryZ4M3'];
      $CatZ4M4=$_POST['categoryZ4M4'];

      $Category='Zone 1 = '.$CatZ4M1.';
      Zone 2 = '.$CatZ4M2.';
      Zone 3 = '.$CatZ4M3.';
      Zone 4 = '.$CatZ4M4;
    }
  }
      //echo 
      /*
      echo $Validity.'.....';

      echo $Bank.'.....';
      echo $Zone.'.....';
     echo $Branch.'.....';
      echo $Gadget.'.....';
      echo $Remark.'.....';
*/
      if (empty($errors)==true) {

        if (empty($OperatorID)==false) {
        // code...
          if (empty($SimType)==true) {
            echo '<script>alert("Please select Sim Type")</script>';
          }else{
            $queryAdd="INSERT INTO `orders`(`BranchCode`, `GadgetID`, `SimProvider`,  `SimType`, `OperatorID`, `ValidityRecharge`, `Executive`, `VoiceMessage`, `Remark`, `RefID`) VALUES ('$Branch', '$GadgetID', '$Provider', '$SimType', '$OperatorID', '$Validity', '$username', '$Category', '$Remark', '$RefID')";
            $resultAdd = mysqli_query($con,$queryAdd);
            if ($resultAdd) {
              header("location:ordertable.php?");
            }
          }
        }else{

          $queryAdd="INSERT INTO `orders`(`BranchCode`, `SimProvider`, `GadgetID`, `ValidityRecharge`, `Executive`, `VoiceMessage`, `Remark`, `RefID`) VALUES ('$Branch', '$Provider', '$GadgetID', '$Validity', '$username', '$Category', '$Remark', '$RefID')";
          $resultAdd = mysqli_query($con,$queryAdd);
          if ($resultAdd) {
            header("location:ordertable.php?");
          }
        }




      }else{
        echo $errors;
      }
    }



    ?>

    <!doctype html>
      <html lang="en">
      <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Add Orders</title>
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="icon" href="cyrus logo.png" type="image/icon type">
        <link rel="stylesheet" type="text/css" href="css/style.css"> 
        <link href='https://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
        
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link rel="stylesheet" href="dist/css/bootstrap-select.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
        <style>
        fieldset {
          background-color: #eeeeee;
          margin: 5px;
          padding: 10px;
        }

        legend {
          background-color: #26082F;
          color: white;
          padding: 5px 5px;
        }
      </style>

      <script type="text/javascript">
        function yesnoCheck(that) {
          if(that.value == "5"){
            document.getElementById("1").style.display = "flex";
            document.getElementById("2").style.display = "none";
          }else if(that.value == "6") {
            document.getElementById("2").style.display = "flex";
            document.getElementById("1").style.display = "none";
          }else{
            document.getElementById("1").style.display = "none";
            document.getElementById("2").style.display = "none";
          }
        }
      </script>

    </head>


    <body>



      <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #E0E1DE;" id="nav">
        <div class="container-fluid" align="center">
          <a class="navbar-brand" href="index.html"><img src="cyrus logo.png" alt="cyrus.com" width="50" height="60">Cyrus Electronics</a>
          <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-md-center" id="navbarNavDropdown">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="ordertable.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="orders.php">Add Orders</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="released.php">Completed Orders</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="cancelorders.php">Canceled Orders</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <br><br>
      <div class="container" style="overflow: hidden;">
        <legend style="text-align: center;" class="my-select">Enter Details</legend>
        <fieldset class="my-select">

          <form method="POST" action="">
            <div class="form-row">

              <div class="form-group col-md-3">

                <div class="input-field">
                  <!--<select id="Bank" class="form-control my-select" name="Bank" required>-->
                    <select class="selectpicker form-control" data-container="body" data-live-search="true" title="Select bank" data-hide-disabled="true" id="Bank" name="Bank" required>
                      <option value="">Select Bank</option>
                      <?php
                      $BankData="Select BankCode, BankName from bank order by BankName";
                      $result=mysqli_query($con2,$BankData);
                      if (mysqli_num_rows($result)>0)
                      {
                        while ($arr=mysqli_fetch_assoc($result))
                        {
                          ?>
                          <option value="<?php echo $arr['BankCode']; ?>"><?php echo $arr['BankName']; ?></option>
                          <?php
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group col-md-3">
                  
                  <select id="Zone" class="form-control my-select" name="Zone" required>
                    <!--<select class="selectpicker form-control"  data-container="body" data-live-search="true" title="Select Zone" data-hide-disabled="true" id="Zone" name="Zone" required>-->
                      <option value="">Zone</option>
                    </select>

                  </div>
                  <div class="form-group col-md-3">
                    <input type="text" id="input2" class="form-control my-select" placeholder="Search Branch">
                    <select id="Branch" class="form-control my-select" name="Branch" required>
                      <option value="">Branch</option>
                    </select>
                  </div>

                  <div class="form-group col-md-3">

                    <input type="text" id="input4" class="form-control my-select" placeholder="Search Gadget">
                    <select class="form-control my-select" name="GadgetID" required onchange="yesnoCheck(this);" id="Gadget">
                      <option value="">Select Gadget</option>
                      <?php 
                      while ($arr=mysqli_fetch_assoc($results))
                      {
                        ?>
                        <option value="<?php echo $arr['GadgetID']; ?>"><?php echo $arr['Gadget']; ?></option>
                        <?php
                      }?>      
                    </select>
                  </div>

                  <div class="form-group col-md-3">
                    <label for="SimType">Sim Provider</label>
                    <select class="form-control my-select" name="Provider" required>
                      <option value="">Select</option>
                      <option value="Bank">Bank</option>
                      <option value="Cyrus">Cyrus</option>      
                    </select>
                  </div>

                  <div class="form-group col-md-3">
                    <label for="SimType">Select Sim Type</label>
                    <select class="form-control my-select" name="SimType">
                      <option value="">Select</option>
                      <option value="Prepaid">Prepaid</option>
                      <option value="Postpaid">Postpaid</option>      
                    </select>
                  </div>

                  <div class="form-group col-md-3">
                    <label for="Operator">Operator</label>
                    <select class="form-control my-select" name="OperatorID">
                      <option value="">Select</option>
                      <?php 
                      while ($arr=mysqli_fetch_assoc($resultOperator))
                      {
                        ?>
                        <option value="<?php echo $arr['OperatorID']; ?>"><?php echo $arr['Operator']; ?></option>
                        <?php
                      }?>      
                    </select>

                  </div>


                  <div class="form-group col-md-3">
                    <label for="Validity of Recharge">Validity of Recharge in Months</label>
                    <select class="form-control my-select" name="Validity">
                      <option value="">Select</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>   
                      <option value="5">5</option>
                      <option value="6">6</option>   
                      <option value="7">7</option>
                      <option value="8">8</option>   
                      <option value="9">9</option>
                      <option value="10">10</option> 
                      <option value="11">11</option>
                      <option value="12">12</option>   
                      <option value="24">24</option>   
                    </select>

                  </div>


                  <div class="form-group col-md-12" id="1"  style="display: none;">

                    <div class="form-group col-md-3">
                      <label for="Validity of Recharge">Voice Category for Zone 1</label>
                      <select class="form-control my-select" name="categoryZ2M1">
                        <option value="">Select</option>
                        <option value="Alarm">Alarm</option>
                        <option value="Fire Alarm">Fire Alarm</option>
                      </select>
                    </div>


                    <div class="form-group col-md-3">
                      <label for="Validity of Recharge">Voice Category for Zone 2</label>
                      <select class="form-control my-select" name="categoryZ2M2">
                        <option value="">Select</option>
                        <option value="Alarm">Alarm</option>
                        <option value="Fire Alarm">Fire Alarm</option>
                      </select>
                    </div>

                    <div class="form-group col-md-3">
                      <p>For other Remark is mandatory</p>
                      <label class="form-check-label" for="flexCheckDefault">Other</label>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="Other">
                    </div>
                  </div>

                  <div class="form-group col-md-12" id="2"  style="display: none;">

                    <div class="form-group col-lg-2">
                      <label for="Validity of Recharge">Category Zone 1</label>
                      <select class="form-control my-select" name="categoryZ4M1">
                        <option value="">Select</option>
                        <option value="Alarm">Alarm</option>
                        <option value="Fire Alarm">Fire Alarm</option>
                      </select>
                    </div>

                    <div class="form-group col-md-2">
                      <label for="Validity of Recharge">Category Zone 2</label>
                      <select class="form-control my-select" name="categoryZ4M2">
                        <option value="">Select</option>
                        <option value="Alarm">Alarm</option>
                        <option value="Fire Alarm">Fire Alarm</option>
                      </select>

                    </div>

                    <div class="form-group col-md-2">
                      <label for="Validity of Recharge">Category Zone 3</label>
                      <select class="form-control my-select" name="categoryZ4M3">
                        <option value="">Select</option>
                        <option value="Alarm">Alarm</option>
                        <option value="Fire Alarm">Fire Alarm</option>
                      </select>
                    </div>

                    <div class="form-group col-md-3">
                      <label for="Validity of Recharge">Category Zone 4</label>
                      <select class="form-control my-select" name="categoryZ4M4">
                        <option value="">Select</option>
                        <option value="Alarm">Alarm</option>
                        <option value="Fire Alarm">Fire Alarm</option>
                      </select>

                    </div>
                    <br>
                    <div class="form-group col-md-3">
                      <p>For other Remark is mandatory</p>
                      <label class="form-check-label" for="flexCheckDefault">Other</label>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="Other">
                    </div>
                  </div>
                </div>
                <div class="form-group col-md-3">
                  <label for="Branch">Reference order ID</label>
                  <input type="number" name="RefID" required class="form-control my-select">
                </div>
                <div class="form-group col-md-3">
                  <label for="Branch">Reset Form</label>
                  
                </div>

                <div class="form-group col-md-12">
                  <label for="Remark">Remark</label>
                  <textarea class="form-control my-select" id="exampleFormControlTextarea1" cols="12" rows="4" name="Remark"></textarea>
                </div>
              </div>  
              <br><br>
              <center>
                <input type="submit"  class=" btn btn-success" value="submit" name="submit"></input>
                <input type="reset"  class=" btn btn-danger" value="Reset" name="Reset"></input>
                <br><br>
              </center>      
            </form>

          </div>
        </fieldset>

        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="ajax-script.js" type="text/javascript">
        </script>
      </body>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="ajax-script.js" type="text/javascript">
      </script>
      <script src="assets/js/jquery.min.js"></script>
      <script src="assets/js/popper.js"></script>
      <script src="bootstrap/js/bootstrap.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>


      <script>

        $('#input').keyup(function () {
          select_search($('#input').val(),$('#Zone option'));
        });
        $('#input2').keyup(function () {
          select_search($('#input2').val(),$('#Branch option'),'');
        });
        $('#input3').keyup(function () {
          select_search($('#input3').val(),$('#Bank option'),'');
        });
        $('#input4').keyup(function () {
          select_search($('#input4').val(),$('#Gadget option'),'');
        });
      </script>
      </html>

