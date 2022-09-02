<?php
include('connection.php'); 
include 'session.php';
$username = $_SESSION['user'];

$query ="SELECT * FROM `user` WHERE Active='1'";
$results = mysqli_query($con, $query);

?>



<!doctype html>
    <html lang="en">
    <head>
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
       <meta charset="utf-8">
       <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
       <meta name="description" content="">
       <meta name="author" content="Anant Singh Suryavanshi">
       <title>Admin</title>
       <link rel="icon" href="cyrus logo.png" type="image/icon type">
       <!-- Bootstrap core CSS -->
       <link href="bootstrap/css/bootstrap.css" rel="stylesheet">  
       <link rel="stylesheet" type="text/css" href="datatable/jquery.dataTables.min.css"/>
       <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
       <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css"> 
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

    .r {
        margin: 5px;
    }
</style>
</script>

</head>


<body>


    <div class="container" style="overflow: hidden;">
        <br>
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #eeeeee;">
          <a class="navbar-brand" href="home.php?"><?php echo $username; ?></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="logout.php"><strong>Logout</strong></a>
            </li>
        </ul>
    </div>
</nav>
<br><br>

<fieldset>

    <h3 align="center">Active Users</h3>  
    <br />  
    <div class="table-responsive">  
     <table class="table-hover border" id="example" class="display nowrap"> 
        <thead> 
            <tr>  
                <th>User ID</th> 
                <th>Name</th>
                <th>User Type</th>  
                <th>Action</th>
            </tr>                     
        </thead>                 
        <tbody class="bg-info"> 
            <?php  
            while ($row=mysqli_fetch_array($results,MYSQLI_ASSOC)){ 
                {  

                  $UserID=$row["ID"];
                  $Name=$row["Name"];
                  $Type=$row["Type"];


                  echo '  
                  <tr> 
                  <td>'.$UserID.'</td>
                  <td>'.$Name.'</td>  
                  <td>'.$Type.'</td>
                  <td><a target="blank" href=deactivate.php?id='.$row["ID"].'>Deactivate User </a>&nbsp;&nbsp;&nbsp;<a target="blank" href=delete.php'.$row["ID"].'>Delete User</a></td> 
                  </tr>  
                  ';  
              }}  
              

              ?> 

          </table>  
      </div>  
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

<script>

    $(document).ready(function() {
        var table = $('#example').DataTable( {
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            responsive: true
        } );
    } );

</script>
</body>

</html>