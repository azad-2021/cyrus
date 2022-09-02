
<?php

$connect = new PDO("mysql:host=192.168.1.1:9916; dbname=Saas", "Ashok", "cyrus@123");

if(isset($_POST["type"]))
{
 if($_POST["type"] == "category_data")
 {
  $q = "
  SELECT * FROM simprovider 
  ORDER BY ID ASC
  ";
  $statement = $connect->prepare($q);
  $statement->execute();
  $data = $statement->fetchAll();
  foreach($data as $row)
  {
   $output[] = array(
    'id'  => $row["ID"],
    'name'  => $row["MobileNumber"]
   );
  }
  echo json_encode($output);
 }

}

?>
