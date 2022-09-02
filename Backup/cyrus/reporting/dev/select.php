
<?php 

  include 'connection.php';



  $queryTech="SELECT * FROM pass order by `UserName`"; 
  $resultTech=mysqli_query($con,$queryTech);

  if(isset($_POST['submit']))
  {
    $Exe=$_POST['Exe'];
    echo $Exe;
   header("location:addemployee.php?exeid=$Exe");
  }
?>





<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Add Technician</title>
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
    <div class="container">
      <!-- Add technician Section -->
      <fieldset >
        <legend>Add Technician</legend>    
        <div class="col-lg-12">
            <form method="post" action="">
              <label for="exampleFormControlSelect2">Select Executive
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <select  required name="Exe" class="form-control" id="exampleFormControlSelect2" >
                <?php
                  while($data=mysqli_fetch_assoc($resultTech)){
                    echo "<option value=".$data['ID'].">".$data['UserName']."</option>";
                  }  
                ?>
              </select>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
            <br><br>  
              <center>
                <input type="submit"  class=" btn btn-success" value="submit" name="submit"></input>
              </center>          
          </div>   
            </form>    
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
  </body>
</html>
