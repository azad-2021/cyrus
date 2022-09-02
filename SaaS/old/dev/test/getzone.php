
<?php

$connect = new PDO("mysql:host=localhost;dbname=backend", "root", "");

if(isset($_POST["type"]))
{
   if($_POST["type"] == "category_data")
   {
      $query = "
      SELECT * FROM bank 
      ORDER BY BankName ASC
      ";
      $statement = $connect->prepare($query);
      $statement->execute();
      $data = $statement->fetchAll();
      foreach($data as $row)
      {
         $output[] = array(
            'id'  => $row["BankCode"],
            'name'  => $row["BankName"]
        );
     }
     echo json_encode($output);
 }
 else
 {
  $query = "
  SELECT * FROM zoneregions 
  WHERE BankCode = '".$_POST["category_id"]."'
  ";
  $statement = $connect->prepare($query);
  $statement->execute();
  $data = $statement->fetchAll();
  foreach($data as $row)
  {
     $output[] = array(
        'id'  => $row["ZoneRegionCode"],
        'name'  => $row["ZoneRegionName"]
    );
 }
 echo json_encode($output);
}
}

?>