<?php

//load.php file script

$connect = new PDO("mysqli:host=46.22.129.7;dbname=apleona_waste", "apl_waste_usr", "Upl5o73?");
$db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');

if(isset($_POST["type"]))
{
 if($_POST["type"] == "category_data")
 {
  $query = "
  SELECT * FROM ewc_codes_updated WHERE ewc_parent_id IS NOT NULL
  ORDER BY ewc_parent_id ASC
  ";
//   $statement = $connect->prepare($query);
//   $statement->execute();
  $result = mysqli_query($db, $query);
  //$data = mysqli_fetch_array($result);
  while ($row = mysqli_fetch_array($result)) {
  //foreach($data as $row) {
   $output[] = array(
    'id'  => $row["ewc_parent_id"],
    'name'  => $row["ewc_description"]
   );
  }
  echo json_encode($output);
 }
 else
 {
  $query = "
  SELECT * FROM tbl_sub_industry 
  WHERE industry_id = '".$_POST["category_id"]."' 
  ORDER BY sub_industry_name ASC
  ";
  $statement = $connect->prepare($query);
  $statement->execute();
  $data = $statement->fetchAll();
  foreach($data as $row)
  {
   $output[] = array(
    'id'  => $row["sub_industry_id"],
    'name'  => $row["sub_industry_name"]
   );
  }
  echo json_encode($output);
 }
}

?>