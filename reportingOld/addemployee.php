
<?php 

include 'connection.php';

$queryTechnicianList= "SELECT * FROM employees WHERE Inservice=1";
$resultTechnicianList=mysqli_query($con,$queryTechnicianList);



if(isset($_POST['submit']))
{

  $data3=json_encode(($_POST["Exe"]));
  $data4=json_decode($data3);
  $arrayLength = count($data4);  
  $data5=json_encode(($_POST["ID"]));
  $data6=json_decode($data5);

  $i = 0;
  while ($i < $arrayLength)
  {

    $sql = "INSERT INTO reporting (EmployeeID, ExecutiveID)
    VALUES ('$data6[$i]', '$data4[$i]')";

    if ($con->query($sql) === TRUE) {
    } else {
      echo "Error: " . $sql . "<br>" . $con->error;
    }
    $i++;
  }

}

?>





<!DOCTYPE html>
<html lang="en">
<head>
  <title>Executive</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="datatable/jquery.dataTables.min.css"/>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
  <style type="text/css">
  <style>
  fieldset {
    background-color: #eeeeee;
    margin: 10px;
  }

  legend {
    background-color: #26082F;
    color: white;
    padding: 5px 10px;
  }

  .r {
    margin: 5px;
  }
</style>

</head>

<body>
  <br><br>
  <label for="exampleDataList" class="form-label">Datalist example</label>
  <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
  <datalist id="datalistOptions">
    <?php while($data1=mysqli_fetch_assoc($resultTechnicianList)){  
     ?>
      <option value="<?php echo $data1['EmployeeCode']; ?>"><?php echo $data1['Employee Name']; ?></option>
      <?php 
    }
    ?>
  </datalist>
  <div class="container">

    <!-- Add technician Section -->
    <fieldset >  
      <div class="col-lg-12">
        <form method="post" action="" name="sub">     
          <div class="col-lg-12 table-responsive">
            <table id="userTable2" class="display nowrap table-striped table-hover table-sm" id="exampleFormControlSelect2" class="form-control">
              <thead>
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Name</th>
                  <th scope="col">Select Executive</th>
                </tr>
              </thead>
              <tbody>
                <?php while($data1=mysqli_fetch_assoc($resultTechnicianList)){  
                 ?>


                 <tr>
                  <td >
                    <?php echo $ID =$data1['EmployeeCode']; ?>
                  </td>
                  <td >
                    <?php echo $data1['Employee Name']; ?>
                  </td>
                  <td >
                    <input type="hidden" name="ID[]" value="<?php echo $ID; ?>">
                    <select  required name="Exe[]" class="form-control" id="exampleFormControlSelect2" >
                      <?php
                      $queryTech="SELECT * FROM pass";
                      $resultTech=mysqli_query($con,$queryTech);
                      $a=1;
                      while($data=mysqli_fetch_assoc($resultTech)){
                        $select='Select';
                        if ($a==1) {
                          echo "<option value=0>".$select."</option>";
                        }

                        echo "<option value=".$data['ID'].">".$data['UserName']."</option>";
                        $a++;
                      }

                      ?>
                    </select>

                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table> 

          <br><br>  
          <center>

            <input type="submit"  class=" btn btn-success" value="submit" name="submit"></input>
          </center> 
        </form>      
        <br>
      </div>
    </fieldset>
  </div> 
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="//cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js
  "></script>

  <script type="text/javascript">

    $(document).ready(function() {
     var table = $('#userTable2').DataTable( {
      rowReorder: {
        selector: 'td:nth-child(2)'
      },
      responsive: true

    } );
   } );

 </script> 
</body>
</html>
