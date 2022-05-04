
<?php

require APPROOT . '/views/inc/header.php'; 
require APPROOT . '/views/inc/cascading.js'; 
require APPROOT . '/views/inc/top_menu.php';
require APPROOT . '/views/inc/side_menu.php';  

?>



      <!-- .app-main -->
      <main class="app-main">
        <!-- .wrapper -->
        <div class="wrapper">
          <!-- .page -->
          <div class="page">
            <!-- .page-inner -->
            <div class="page-inner">
              <!-- .page-title-bar -->
              <header class="page-title-bar">
                <div class="d-flex flex-column flex-md-row" id="headingExport">
                  <p class="lead">
                    <span class="font-weight-bold">Hi, <?php echo $_SESSION['user_name'];  ?></span> <span class="d-block text-muted">Here's what's going on</span>
                  </p>

                  <?php //echo var_dump($_SESSION); ?>
                  <?php //echo APPROOT; ?>

                  <div class="ml-auto">
                    <!-- .dropdown -->
                   
                  </div>
                </div>

                
                   
                <div class="form-group">
                <label class="control-label" for="rangeDatepicker2">Select a Date Range</label>

                 <input id="rangeDatepicker2" class="form-control">
                </div>
                <!-- /.form-group --> 





              </header><!-- /.page-title-bar -->
<!--- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  -->

<!-- .page-section -->
              <div class="page-section">
                <!-- .section-block -->
                <div class="section-block">
                  <!-- metric row -->
                  
<?php if(empty($_GET['mySite'])) {
  $variable = '';
} else if ($_GET['mySite'] == 'ALL') {
  $variable = '';
} else {
  $variable = '- ' . $_GET['mySite'];
} ?>

<p class="lead">
  <span class="font-weight-bold">Collections <?php echo $variable ?></span> 
</p>

<div id="testDiv" name="testDiv">
<?php
if ($_SESSION['country'] == 'IE' OR $_SESSION['country']  == 'Workspace') {
//check if anything in the get. empty after first login

$db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');

if (count($_GET) < 2){
    $site = "ALL";
    $customer = "ALL"; 
    }  
elseif (count($_GET) == 5) {
    $site = $_GET['mySite'];
    $customer = $_GET['myCustomer'];
    $start = $_GET['myStart'];
    $end = $_GET['myEnd'];

    if($_SESSION['customer_group'] == 'Stryker Ireland') {

      if ($site == "ALL" AND $customer == "ALL")
      {
      $sqlTypes = "SELECT ROUND(SUM(CASE WHEN `Unit_of_Measure` = 'Tonnes' THEN Quantity*1000 WHEN `Unit_of_Measure` = 'Litres' THEN Quantity*0.000982 ELSE Quantity END), 2) AS Total, Material_Description FROM collections WHERE collections_customer_country = '". $_SESSION['country'] ."' AND STR_TO_DATE(Colletion_Date, '%d/%m/%Y') BETWEEN '$start' AND '$end' GROUP BY Material_Description ORDER BY Total DESC LIMIT 7";   
      }
      
      if ($customer !== "ALL" AND $site  == "ALL")
      {  
      $sqlTypes = "SELECT ROUND(SUM(CASE WHEN `Unit_of_Measure` = 'Tonnes' THEN Quantity*1000 WHEN `Unit_of_Measure` = 'Litres' THEN Quantity*0.000982 ELSE Quantity END), 2) AS Total, Material_Description FROM collections WHERE collections_customer_group = '". $_SESSION['customer_group'] ."' AND STR_TO_DATE(Colletion_Date, '%d/%m/%Y') BETWEEN '$start' AND '$end' GROUP BY Material_Description ORDER BY Total DESC LIMIT 7"; 
      }
      
      if ($customer !== "ALL" AND $site  !== "ALL")
      {
      $sqlTypes = "SELECT ROUND(SUM(CASE WHEN `Unit_of_Measure` = 'Tonnes' THEN Quantity*1000 WHEN `Unit_of_Measure` = 'Litres' THEN Quantity*0.000982 ELSE Quantity END), 2) AS Total, Material_Description FROM collections WHERE (collections_customer_group = '". $_SESSION['customer_group'] ."' AND collections_customer_site = '$site' AND STR_TO_DATE(Colletion_Date, '%d/%m/%Y') BETWEEN '$start' AND '$end') GROUP BY Material_Description ORDER BY Total DESC LIMIT 7";
      }
      
      } else if($_SESSION['customer_group'] == 'Workspace') {

        if ($site == "ALL" AND $customer == "ALL")
        {
        $sqlTypes = "SELECT SUM(lookup_charity_donations.avg_value*`collections_quantity_not_kg`) AS 'Total' FROM collections INNER JOIN lookup_charity_donations ON collections.Material_Description = lookup_charity_donations.description WHERE collections_customer_country = '". $_SESSION['country'] ."'";   
        }
        
        if ($customer !== "ALL" AND $site  == "ALL")
        {  
        $sqlTypes = "SELECT SUM(lookup_charity_donations.avg_value*`collections_quantity_not_kg`) AS 'Total' FROM collections INNER JOIN lookup_charity_donations ON collections.Material_Description = lookup_charity_donations.description WHERE collections_customer_group = '". $_SESSION['customer_group'] ."'";   
        }
        
        if ($customer !== "ALL" AND $site  !== "ALL")
        {
        $sqlTypes = "SELECT SUM(lookup_charity_donations.avg_value*`collections_quantity_not_kg`) AS 'Total' FROM collections INNER JOIN lookup_charity_donations ON collections.Material_Description = lookup_charity_donations.description WHERE (collections_customer_group = '". $_SESSION['customer_group'] ."' AND collections_customer_site = '$site')";   
        }
        
      } else {
      
        if ($site == "ALL" AND $customer == "ALL")
        {
        $sqlTypes = "SELECT ROUND(SUM(CASE WHEN `Unit_of_Measure` = 'Tonnes' THEN Quantity*1000 WHEN `Unit_of_Measure` = 'Litres' THEN Quantity*0.000982 ELSE Quantity END), 2) AS Total, Material_Class FROM collections WHERE collections_customer_country = '". $_SESSION['country'] ."' AND STR_TO_DATE(Colletion_Date, '%d/%m/%Y') BETWEEN '$start' AND '$end' GROUP BY Material_Class ORDER BY Total DESC LIMIT 7";   
        }
        
        if ($customer !== "ALL" AND $site  == "ALL")
        {  
        $sqlTypes = "SELECT ROUND(SUM(CASE WHEN `Unit_of_Measure` = 'Tonnes' THEN Quantity*1000 WHEN `Unit_of_Measure` = 'Litres' THEN Quantity*0.000982 ELSE Quantity END), 2) AS Total, Material_Class FROM collections WHERE collections_customer_group = '". $_SESSION['customer_group'] ."' AND STR_TO_DATE(Colletion_Date, '%d/%m/%Y') BETWEEN '$start' AND '$end' GROUP BY Material_Class ORDER BY Total DESC LIMIT 7"; 
        }
        
        if ($customer !== "ALL" AND $site  !== "ALL")
        {
        $sqlTypes = "SELECT ROUND(SUM(CASE WHEN `Unit_of_Measure` = 'Tonnes' THEN Quantity*1000 WHEN `Unit_of_Measure` = 'Litres' THEN Quantity*0.000982 ELSE Quantity END), 2) AS Total, Material_Class FROM collections WHERE (collections_customer_group = '". $_SESSION['customer_group'] ."' AND collections_customer_site = '$site' AND STR_TO_DATE(Colletion_Date, '%d/%m/%Y') BETWEEN '$start' AND '$end') GROUP BY Material_Class ORDER BY Total DESC LIMIT 7";
        }
      
      }

  } else {
    $site = $_GET['mySite'];
    $customer = $_GET['myCustomer'];

    if($_SESSION['customer_group'] == 'Stryker Ireland') {

      if ($site == "ALL" AND $customer == "ALL")
      {
      $sqlTypes = "SELECT ROUND(SUM(CASE WHEN `Unit_of_Measure` = 'Tonnes' THEN Quantity*1000 WHEN `Unit_of_Measure` = 'Litres' THEN Quantity*0.000982 ELSE Quantity END), 2) AS Total, Material_Description FROM collections WHERE collections_customer_country = '". $_SESSION['country'] ."' GROUP BY Material_Description ORDER BY Total DESC LIMIT 7";   
      }
      
      if ($customer !== "ALL" AND $site  == "ALL")
      {  
      $sqlTypes = "SELECT ROUND(SUM(CASE WHEN `Unit_of_Measure` = 'Tonnes' THEN Quantity*1000 WHEN `Unit_of_Measure` = 'Litres' THEN Quantity*0.000982 ELSE Quantity END), 2) AS Total, Material_Description FROM collections WHERE collections_customer_group = '". $_SESSION['customer_group'] ."' GROUP BY Material_Description ORDER BY Total DESC LIMIT 7"; 
      }
      
      if ($customer !== "ALL" AND $site  !== "ALL")
      {
      $sqlTypes = "SELECT ROUND(SUM(CASE WHEN `Unit_of_Measure` = 'Tonnes' THEN Quantity*1000 WHEN `Unit_of_Measure` = 'Litres' THEN Quantity*0.000982 ELSE Quantity END), 2) AS Total, Material_Description FROM collections WHERE (collections_customer_group = '". $_SESSION['customer_group'] ."' AND collections_customer_site = '$site') GROUP BY Material_Description ORDER BY Total DESC LIMIT 7";
      }
      
      } else if($_SESSION['customer_group'] == 'Workspace') {

        if ($site == "ALL" AND $customer == "ALL")
        {
        $sqlTypes = "SELECT SUM(lookup_charity_donations.avg_value*`collections_quantity_not_kg`) AS 'Total' FROM collections INNER JOIN lookup_charity_donations ON collections.Material_Description = lookup_charity_donations.description WHERE collections_customer_country = '". $_SESSION['country'] ."'";   
        }
        
        if ($customer !== "ALL" AND $site  == "ALL")
        {  
        $sqlTypes = "SELECT SUM(lookup_charity_donations.avg_value*`collections_quantity_not_kg`) AS 'Total' FROM collections INNER JOIN lookup_charity_donations ON collections.Material_Description = lookup_charity_donations.description WHERE collections_customer_group = '". $_SESSION['customer_group'] ."'";   
        }
        
        if ($customer !== "ALL" AND $site  !== "ALL")
        {
        $sqlTypes = "SELECT SUM(lookup_charity_donations.avg_value*`collections_quantity_not_kg`) AS 'Total' FROM collections INNER JOIN lookup_charity_donations ON collections.Material_Description = lookup_charity_donations.description WHERE (collections_customer_group = '". $_SESSION['customer_group'] ."' AND collections_customer_site = '$site')";   
        }
        
      } else {
      
        if ($site == "ALL" AND $customer == "ALL")
        {
        $sqlTypes = "SELECT ROUND(SUM(CASE WHEN `Unit_of_Measure` = 'Tonnes' THEN Quantity*1000 WHEN `Unit_of_Measure` = 'Litres' THEN Quantity*0.000982 ELSE Quantity END), 2) AS Total, Material_Class FROM collections WHERE collections_customer_country = '". $_SESSION['country'] ."' GROUP BY Material_Class ORDER BY Total DESC LIMIT 7";   
        }
        
        if ($customer !== "ALL" AND $site  == "ALL")
        {  
        $sqlTypes = "SELECT ROUND(SUM(CASE WHEN `Unit_of_Measure` = 'Tonnes' THEN Quantity*1000 WHEN `Unit_of_Measure` = 'Litres' THEN Quantity*0.000982 ELSE Quantity END), 2) AS Total, Material_Class FROM collections WHERE collections_customer_group = '". $_SESSION['customer_group'] ."' GROUP BY Material_Class ORDER BY Total DESC LIMIT 7"; 
        }
        
        if ($customer !== "ALL" AND $site  !== "ALL")
        {
        $sqlTypes = "SELECT ROUND(SUM(CASE WHEN `Unit_of_Measure` = 'Tonnes' THEN Quantity*1000 WHEN `Unit_of_Measure` = 'Litres' THEN Quantity*0.000982 ELSE Quantity END), 2) AS Total, Material_Class FROM collections WHERE (collections_customer_group = '". $_SESSION['customer_group'] ."' AND collections_customer_site = '$site') GROUP BY Material_Class ORDER BY Total DESC LIMIT 7";
        }
      
      }
  }

//$sqlTypes = "SELECT SUM(Quantity) AS Total, Material_Description FROM collections WHERE collections_customer_group = '". $_SESSION['customer_group'] ."' GROUP BY Material_Description ORDER BY Total DESC LIMIT 7";
$resultTypes = mysqli_query($db, $sqlTypes);
//$rowTypes = mysqli_fetch_array($resultTypes);
//$rowsTest = [];
//print_r($rowTypes);
//$test = mysqli_fetch_assoc($db->query($sqlTypes));
//print_r($test);
// while ($resultTest = mysqli_fetch_assoc($db->query($sqlTypes)))
// {
//     $rowsTest[] = [
//         "Description"=>$resultTypes['Material_Description'],
//         "Total"=>$resultTypes['Total']
//         ];
// }
// var_dump($rowsTest);

//DECLARE YOUR ARRAY WHERE YOU WILL KEEP YOUR RECORD SETS
$data_array=array();
$rowCount = mysqli_num_rows($resultTypes);

//STORE ALL THE RECORD SETS IN THAT ARRAY 
while ($row = mysqli_fetch_array($resultTypes, MYSQLI_ASSOC)) 
{
    array_push($data_array,$row);
}

//printf("Result set has %d rows.\n",$rowCount);

mysqli_free_result($resultTypes);


//TEST TO SEE THE RESULT OF THE ARRAY 
echo '<pre>';
//print_r($data_array);
echo '</pre>';
//print_r($data_array[0]['Total']);
// while ($rowTypes = mysqli_fetch_array($resultTypes)) {
//   echo '<pre>';
//   print_r ($rowTypes);
//   echo '</pre>';
// }

for ($x = 0; $x <= $rowCount; $x++) {
  //echo "<br>The number is: $x <br>";
}
?>
          
                <?php if ($_SESSION['country'] == 'Workspace') { ?>
                <div class="metric-row" style="display:none">
                <?php } else { ?>
                <div class="metric-row"> 
                <?php } ?>
                    <div class="col-lg">
                      <div class="metric-row metric-flush">

                      <?php for ($x = 0; $x < $rowCount; $x++) { ?>
                          <!-- metric column -->
                          <div class="col">
                          <!-- .metric -->
                          <a href="#" class="metric metric-bordered align-items-center">
                            <?php if($_SESSION['customer_group'] == 'Stryker Ireland') { ?>
                            <h2 class="metric-label"><?php echo $data_array[$x]['Material_Description'];?> (KG)</h2>
                            <?php } else if($_SESSION['customer_group'] == 'Workspace') { ?>
                            <h2 class="metric-label"><?php echo "Charity Donations";?>  (GBP)</h2>
                            <?php } else { ?>
                              <h2 class="metric-label"><?php echo $data_array[$x]['Material_Class']; ?> (KG)</h2>
                            <?php } ?>
                            <p class="metric-value h3">




                              <sub><i class="fas fa-recycle fa-spin"></i></sub> <span class="value">

                                  <?php
                                
                                  if ($data_array[$x]['Total'] > 0) {echo number_format($data_array[$x]['Total'], 2,'.', ',');} else {echo 0;}
                                                      
                                  ?>

                              </span>
                            </p>
                          </a> <!-- /.metric -->
                        </div><!-- /metric column -->
                        <?php } ?>

                        <?php if($_SESSION['customer_group'] !== 'Workspace') { ?>
                        <div class="col">
                          <!-- .metric -->
                          <a href="#" class="metric metric-bordered align-items-center">   
                                
                          <div class="metric-badge">
                          <h2 class="metric-label">Landfill (kg)</h2>
                          </div>
                              <p class="metric-value h2">
                              <sub><i class="oi oi-trash"></i></sub> <span style="color:green" class="value">0</span>
                              </p>

                              </span>
                            </p>
                          </a> <!-- /.metric -->
                        </div><!-- /metric column -->
                        <?php } ?>

                       </div><!-- /metric row -->
                    </div><!-- /.section-block -->
                 </div><!-- /.page-section -->
              </div><!-- end of div for reloading the squares -->

                 <?php } elseif ($_SESSION['country'] == 'Test') { ?>

                  <div class="metric-row">
                    <div class="col-lg-9">
                      <div class="metric-row metric-flush">

                        <!-- metric column -->
                        <div class="col">
                          <!-- .metric -->
                          <a href="#" class="metric metric-bordered align-items-center">
                            <h2 class="metric-label">Recycled</h2>
                            <p class="metric-value h3">




                              <sub><i class="fas fa-recycle fa-spin"></i></sub> <span class="value">
                                


                                <?php

                                    


                                //check if anything in the get. empty after first login

                                           if (count($_GET) < 2){
                                               $site = "ALL";
                                                $customer = "ALL"; 
                                                }  
                                            else{
                                                $site = $_GET['mySite'];
                                                $customer = $_GET['myCustomer'];
                                              }
                                          
                                        $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');

                                         IF ($site == "ALL" AND $customer == "ALL")
                                          {  
                                           $sql = "SELECT SUM(Quantity) AS Total FROM collections WHERE (collections_customer_country= '". $_SESSION['country'] ."' AND Treatment_Method_Detail LIKE '%Recycl%')";
                                         }

                                
                                      
                                       IF ($customer !== "ALL" AND $site  == "ALL")
                                          {  
                                             $sql = "SELECT SUM(Quantity) AS Total FROM collections WHERE (collections_customer_country= '". $_SESSION['country'] ."' AND Treatment_Method_Detail LIKE '%Recycl%' AND collections_customer_number = '$customer')"; 
                                          
                                          }
                                       
                                       IF ($customer !== "ALL" AND $site  !== "ALL")
                                          {
                                           $sql = "SELECT SUM(Quantity) AS Total FROM collections WHERE (collections_customer_country= '". $_SESSION['country'] ."' AND Treatment_Method_Detail LIKE '%Recycle%' AND collections_customer_number = '$customer' AND collections_customer_site = '$site')";
                                          }


                                        
                                            $result = mysqli_query($db, $sql);
                                           
                                               while ($row = mysqli_fetch_array($result)) {
                                                       //echo "<option value='" .$row['waste_customer_name']."'> ".$row['waste_customer_name'] . "</option>"; 
                                                         $Total = $row['Total'];
                                                        IF ($Total > 0) {echo number_format($Total, 0,'.', ',');} ELSE {echo 0;}
                                                        
                                                    }
                                          ?>

                              </span>
                            </p>
                          </a> <!-- /.metric -->
                        </div><!-- /metric column -->
                        <!-- metric column -->
                        <div class="col">
                          <!-- .metric -->
                          <a href="#" class="metric metric-bordered align-items-center">
                            <h2 class="metric-label">Metals (kg)</h2>
                            <p class="metric-value h3">
                              <sub><i class="fas fa-cog fa-spin"></i></i></sub> <span class="value">
                                

                                  <?php

                                   

                                    $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');

                                     IF ($site == "ALL" AND $customer == "ALL"){
                                      $sql = "SELECT SUM(Quantity) AS Total FROM collections WHERE (collections_customer_country= '". $_SESSION['country'] ."' AND material_description = 'Metal')";

                                     }


                                    IF ($customer !== "ALL" AND $site  !== "ALL")
                                      {
                                      $sql = "SELECT SUM(Quantity) AS Total FROM collections WHERE (material_description = 'Metal'AND collections_customer_number = '$customer' AND collections_customer_site = '$site')";
                                      }
                                     

                                      IF ($customer !== "ALL" AND $site  == "ALL")
                                          {  
                                       $sql = "SELECT SUM(Quantity) AS Total FROM collections WHERE (material_description = 'Metal'AND collections_customer_number = '$customer')";
                                      }
                                                                    

                                    $result = mysqli_query($db, $sql);
                                   
                                       while ($row = mysqli_fetch_array($result)) {
                                        $Total = $row['Total'];
                                         IF ($Total > 0) {echo number_format($Total, 0,'.', ',');} ELSE {echo 0;}
                                                       
                                                
                                            }
                                  ?>


                              </span>
                            </p>
                          </a> <!-- /.metric -->
                        </div><!-- /metric column -->
                        <!-- metric column -->
                        <div class="col">
                          <!-- .metric -->
                          <a href="#" class="metric metric-bordered align-items-center">
                            <h2 class="metric-label">Energy Production (kg)</h2>
                            <p class="metric-value h3">
                              <sub><i class="fa fa-plug pulse"></i></sub> <span class="value">
                                
                                <?php
                                   
                                    
                                    $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
                                   


                                IF ($site == "ALL" AND $customer == "ALL")
                                {
                                   $sql = "SELECT SUM(Quantity) AS Total FROM collections WHERE (collections_customer_country= '". $_SESSION['country'] ."' AND RD_Codes_Treatment = 'R1 - Use as Fuel' )";
                                }

                                  IF ($customer !== "ALL" AND $site  !== "ALL")


                                      {
                                      $sql = "SELECT SUM(Quantity) AS Total FROM collections WHERE (collections_customer_country= '". $_SESSION['country'] ."' AND RD_Codes_Treatment = 'R1 - Use as Fuel' AND collections_customer_number = '$customer' AND collections_customer_site = '$site')";
                                    }
                                     
                                IF ($customer !== "ALL" AND $site  == "ALL")
                                      { 
                                      $sql = "SELECT SUM(Quantity) AS Total FROM collections WHERE (collections_customer_country= '". $_SESSION['country'] ."' AND RD_Codes_Treatment = 'R1 - Use as Fuel' AND collections_customer_number = '$customer')";
                                    }

                                    $result = mysqli_query($db, $sql);
                                   
                                       while ($row = mysqli_fetch_array($result)) {
                                               $Total = $row['Total'];
                                               IF ($Total > 0) {echo number_format($Total, 0,'.', ',');} ELSE {echo 0;}
                                            }
                                  ?>




                              </span>
                            </p>
                          </a> <!-- /.metric -->
                        </div><!-- /metric column -->
                      
 <!-- metric column -->
                        <div class="col">
                          <!-- .metric -->
                          <a href="#" class="metric metric-bordered align-items-center">
                            <h2 class="metric-label">Wood (kg)</h2>
                            <p class="metric-value h3">
                              <sub><i class="fas fa-cog fa-spin"></i></i></sub> <span class="value">
                                

                                  <?php

                                   
                                    $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
                                    

                                    IF ($site == "ALL" AND $customer == "ALL")
                                          { 
                                            $sql = "SELECT SUM(Quantity) AS Total FROM collections WHERE (collections_customer_country= '". $_SESSION['country'] ."' AND material_description = 'Wood')";
                                          }


                                    IF ($customer !== "ALL" AND $site  !== "ALL")
                                    {
                                    $sql = "SELECT SUM(Quantity) AS Total FROM collections WHERE (collections_customer_country= '". $_SESSION['country'] ."' AND material_description = 'Wood' AND collections_customer_number = '$customer' AND collections_customer_site = '$site')";
                                    }
                                    

                                    IF ($customer !== "ALL" AND $site  == "ALL")
                                    {
                                     $sql = "SELECT SUM(Quantity) AS Total FROM collections WHERE (collections_customer_country= '". $_SESSION['country'] ."' AND material_description = 'Wood' AND collections_customer_number = '$customer')";
                                    }

                                    $result = mysqli_query($db, $sql);
                                   
                                       while ($row = mysqli_fetch_array($result)) {
                                               $Total = $row['Total'];
                                               IF ($Total > 0) {echo number_format($Total, 0,'.', ',');} ELSE {echo 0;}
                                            }
                                  ?>


                              </span>
                            </p>
                          </a> <!-- /.metric -->
                        </div><!-- /metric column -->

 <div class="col">
                          <!-- .metric -->
                          <a href="#" class="metric metric-bordered align-items-center">
                            <h2 class="metric-label">WEE Items (kg)</h2>
                            <p class="metric-value h3">
                              <sub><i class="fas fa-cog fa-spin"></i></i></sub> <span class="value">
                                

                                  <?php
                                   
                                    $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');

                                    IF ($site == "ALL" AND $customer == "ALL")
                                          {  
                                            $sql = "SELECT SUM(Quantity) AS Total FROM collections WHERE (collections_customer_country= '". $_SESSION['country'] ."' AND material_description = 'WEE Items')";
                                          }
                                    
                                     IF ($customer !== "ALL" AND $site  !== "ALL")
                                    {
                                    $sql = "SELECT SUM(Quantity) AS Total FROM collections WHERE (collections_customer_country= '". $_SESSION['country'] ."' AND material_description = 'WEE Items' AND collections_customer_number = '$customer' AND collections_customer_site = '$site')";
                                    }  
                                     IF ($customer !== "ALL" AND $site  == "ALL")
                                    {
                                     $sql = "SELECT SUM(Quantity) AS Total FROM collections WHERE (collections_customer_country= '". $_SESSION['country'] ."' AND material_description = 'WEE Items' AND collections_customer_number = '$customer')";
                                    }                   


                                    $result = mysqli_query($db, $sql);
                                   
                                       while ($row = mysqli_fetch_array($result)) {
                                                $Total = $row['Total'];
                                                IF ($Total > 0) {echo number_format($Total, 0,'.', ',');} ELSE {echo 0;}
                                            }
                                  ?>


                              </span>
                            </p>
                          </a> <!-- /.metric -->
                        </div><!-- /metric column -->

                        <div class="col">
                          <!-- .metric -->
                          <a href="#" class="metric metric-bordered align-items-center">
                            <h2 class="metric-label">Mixed (kg)</h2>
                            <p class="metric-value h3">
                              <sub><i class="fas fa-cog fa-spin"></i></i></sub> <span class="value">
                                

                                  <?php
                                    $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');

                                    IF ($site == "ALL" AND $customer == "ALL")
                                          {   $sql = "SELECT SUM(Quantity) AS Total FROM collections WHERE (collections_customer_country= '". $_SESSION['country'] ."' AND material_description = 'Mixed' )";
                                        }
                                   
                                IF ($customer !== "ALL" AND $site  !== "ALL")

                                    {
                                    $sql = "SELECT SUM(Quantity) AS Total FROM collections WHERE (collections_customer_country= '". $_SESSION['country'] ."' AND material_description = 'Mixed' AND collections_customer_number = '$customer' AND collections_customer_site = '$site')";
                                     }
                                  IF ($customer !== "ALL" AND $site  == "ALL")
                                     { 
                                     $sql = "SELECT SUM(Quantity) AS Total FROM collections WHERE (collections_customer_country= '". $_SESSION['country'] ."' AND material_description = 'Mixed' AND collections_customer_number = '$customer')";
                                    }


                                    $result = mysqli_query($db, $sql);
                                   
                                       while ($row = mysqli_fetch_array($result)) {
                                                $Total = $row['Total'];
                                                IF ($Total > 0) {echo number_format($Total, 0,'.', ',');} ELSE {echo 0;}
                                            }
                                  ?>


                              </span>
                            </p>
                          </a> <!-- /.metric -->
                        </div><!-- /metric column -->

                        


                        <div class="col">
                          <!-- .metric -->
                          <a href="#" class="metric metric-bordered align-items-center">
                            <h2 class="metric-label">Plastics (kg)</h2>
                            <p class="metric-value h3">
                              <sub><i class="fas fa-cog fa-spin"></i></i></sub> <span class="value">
                                

                                  <?php
                                    $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');

                                    IF ($site == "ALL" AND $customer == "ALL")
                                          {   $sql = "SELECT SUM(Quantity) AS Total FROM collections WHERE (collections_customer_country= '". $_SESSION['country'] ."' AND material_description = 'Plastics' )";
                                        }
                                   
                                IF ($customer !== "ALL" AND $site  !== "ALL")

                                    {
                                    $sql = "SELECT SUM(Quantity) AS Total FROM collections WHERE (collections_customer_country= '". $_SESSION['country'] ."' AND material_description = 'Plastics' AND collections_customer_number = '$customer' AND collections_customer_site = '$site')";
                                     }
                                  IF ($customer !== "ALL" AND $site  == "ALL")
                                     { 
                                     $sql = "SELECT SUM(Quantity) AS Total FROM collections WHERE (collections_customer_country= '". $_SESSION['country'] ."' AND material_description = 'Plastics' AND collections_customer_number = '$customer')";
                                    }


                                    $result = mysqli_query($db, $sql);
                                   
                                       while ($row = mysqli_fetch_array($result)) {
                                                $Total = $row['Total'];
                                               IF ($Total > 0) {echo number_format($Total, 0,'.', ',');} ELSE {echo 0;}
                                            }
                                  ?>


                              </span>
                            </p>
                          </a> <!-- /.metric -->
                        </div><!-- /metric column -->


                         <div class="col">
                          <!-- .metric -->
                          <a href="#" class="metric metric-bordered align-items-center">
                           
                          
                             
                                
                          <div class="metric-badge">
                          <h2 class="metric-label">Landfill (kg)</h2>
                          </div>
                              <p class="metric-value h2">
                              <sub><i class="oi oi-trash"></i></sub> <span style="color:green" class="value">0</span>
                            </p>
                                 


                              </span>
                            </p>
                          </a> <!-- /.metric -->
                        </div><!-- /metric column -->





                      </div>
                    </div><!-- metric column -->
                    
                  </div><!-- /metric row -->
                 <?php } ?>

                </div><!-- /.section-block -->
               </div><!-- /.page-section -->

<!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->

 <!-- grid row -->
                <div class="row">

                <?php if ($_SESSION['customer_group']=='Stryker Ireland') { ?>

                    <!-- grid column -->
                    <div class="col-12 col-lg-12 col-xl-4">
                    <!-- .card -->
                   
                    <div class="card card-fluid">
                      <!-- .card-body -->
                      <div class="card-body">
                        <h3 class="card-title mb-4"> Total by Cost</h3>
                         <div id="chart-container-new" style="height: 292px">
                           <canvas id="graphCanvas3"></canvas>
                          </div>
                         </div>
                      </div><!-- /.card-body -->
                    </div><!-- /.card -->

                <?php } else { ?>

                    <!-- grid column -->
                    <div class="col-12 col-lg-12 col-xl-4" id="Graph1" name="Graph1">
                    <!-- .card -->
                   
                    <div class="card card-fluid">
                      <!-- .card-body -->
                      <div class="card-body">
                        <h3 class="card-title mb-4"> Total by Material Type (KG)</h3>
                         <div id="chart-container" style="height: 292px">
                           <canvas id="graphCanvas"></canvas>
                          </div>
                         </div>
                      </div><!-- /.card-body -->
                    </div><!-- /.card -->

                <?php } ?>

                <?php if ($_SESSION['country']=='Workspace') { ?>

                    <!-- grid column -->
                    <div class="col-12 col-lg-12 col-xl-4">
                    <!-- .card -->

                    <div class="card card-fluid">
                      <!-- .card-body -->
                      <div class="card-body">
                        <h3 class="card-title mb-4"> No. of Items Re-Used</h3>
                        <div id="chart-container-reuse" style="height: 292px">
                          <canvas id="graphCanvas5"></canvas>
                          </div>
                        </div>
                      </div><!-- /.card-body -->
                    </div><!-- /.card -->

                    <?php } else { ?>

                     <div class="col-12 col-lg-12 col-xl-4">
                    <!-- .card -->
                   
                    <div class="card card-fluid">
                      <!-- .card-body -->
                      <div class="card-body">
                        <h3 class="card-title mb-4"> Recycled by Material (KG)</h3>
                         <div id="chart-containe1" style="height: 292px">
                           <canvas id="graphCanvas1"></canvas>
                          </div>
                         </div>
                      </div><!-- /.card-body -->
                    </div><!-- /.card -->

                  <?php } ?>
                 
                  <!-- grid column -->

                  <?php if ($_SESSION['customer_group']=='Workspace') { ?>

                    <!-- grid column -->
                    <div class="col-12 col-lg-12 col-xl-4">
                    <!-- .card -->

                    <div class="card card-fluid">
                      <!-- .card-body -->
                      <div class="card-body">
                        <h3 class="card-title mb-4"> Waste Removed (Kg)</h3>
                        <div id="chart-container-wr" style="height: 292px">
                          <canvas id="graphCanvas4"></canvas>
                          </div>
                        </div>
                      </div><!-- /.card-body -->
                    </div><!-- /.card -->

                    <?php } else { ?>
                 
                    <div class="col-12 col-lg-12 col-xl-4">
                    <!-- .card -->
                   
                    <div class="card card-fluid">
                      <!-- .card-body -->
                      <div class="card-body">
                        <h3 class="card-title mb-4"> Recycled by Waste Producer (KG)</h3>
                         <div id="chart-containe2" style="height: 292px">
                           <canvas id="graphCanvas2"></canvas>
                          </div>
                         </div>
                      </div><!-- /.card-body -->
                    </div><!-- /.card -->

                    <?php } ?>
                 
                  <!-- grid column -->
                 
                </div>

<!--- @@@@@@@@@@@@@@@@@@ jim Start @@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->

 <p class="lead">
  <span class="font-weight-bold">Charity Donations</span> 
 </p>

<!-- .page-section -->
              <div class="page-section" style="display:none">
                <!-- .section-block -->
                <div class="section-block">
                  <!-- metric row -->
                  <div class="metric-row">
                    <div class="col-lg-9">
                      <div class="metric-row metric-flush">
                        <!-- metric column -->
                        <div class="col">
                          <!-- .metric -->
                          <a href="#" class="metric metric-bordered align-items-center">
                            <h2 class="metric-label">Chairs</h2>
                            <p class="metric-value h3">




                              <sub><i class="fas fa-recycle fa-spin"></i></sub> <span class="value">
                                


                                <?php

                                    


                                //check if anything in the get. empty after first login

                                           if (count($_GET) < 2){
                                               $site = "ALL";
                                                $customer = "ALL"; 
                                                }  
                                            else{
                                                $site = $_GET['mySite'];
                                                $customer = $_GET['myCustomer'];
                                              }
                                          
                                        $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');

                                         IF ($site == "ALL" AND $customer == "ALL")
                                          {  
                                           $sql = "SELECT SUM(Quantity) AS Total FROM collections WHERE (collections_customer_country= '". $_SESSION['country'] ."' AND Material_Description = 'Chairs' AND RD_Codes_Treatment = 'C1 - Donated to Charity')";
                                         }

                                
                                      
                                       IF ($customer !== "ALL" AND $site  == "ALL")
                                          {  
                                             $sql = "SELECT SUM(Quantity) AS Total FROM collections WHERE (collections_customer_country= '". $_SESSION['country'] ."' AND Material_Description = 'Chairs' AND RD_Codes_Treatment = 'C1 - Donated to Charity' AND collections_customer_number = '$customer')"; 
                                          
                                          }
                                       
                                       IF ($customer !== "ALL" AND $site  !== "ALL")
                                          {
                                           $sql = "SELECT SUM(Quantity) AS Total FROM collections WHERE (collections_customer_country= '". $_SESSION['country'] ."' AND Material_Description = 'Chairs' AND RD_Codes_Treatment = 'C1 - Donated to Charity' AND collections_customer_number = '$customer' AND collections_customer_site = '$site')";
                                          }


                                        
                                            $result = mysqli_query($db, $sql);
                                           
                                               while ($row = mysqli_fetch_array($result)) {
                                                       //echo "<option value='" .$row['waste_customer_name']."'> ".$row['waste_customer_name'] . "</option>"; 
                                                         $Total = $row['Total'];
                                                        IF ($Total > 0) {echo number_format($Total, 0,'.', ',');} ELSE {echo 0;};
                                                    }
                                          ?>

                              </span>
                            </p>
                          </a> <!-- /.metric -->
                        </div><!-- /metric column -->
                        <!-- metric column -->
                        <div class="col">
                          <!-- .metric -->
                          <a href="#" class="metric metric-bordered align-items-center">
                            <h2 class="metric-label">Desks</h2>
                            <p class="metric-value h3">
                              <sub><i class="fas fa-cog fa-spin"></i></i></sub> <span class="value">
                                

                                  <?php

                                   

                                    $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');

                                     IF ($site == "ALL" AND $customer == "ALL"){
                                      $sql = "SELECT SUM(Quantity) AS Total FROM collections WHERE (collections_customer_country= '". $_SESSION['country'] ."' AND Material_Description = 'Desks' AND RD_Codes_Treatment = 'C1 - Donated to Charity')";

                                     }


                                    IF ($customer !== "ALL" AND $site  !== "ALL")
                                      {
                                      $sql = "SELECT SUM(Quantity) AS Total FROM collections WHERE (collections_customer_country= '". $_SESSION['country'] ."' AND Material_Description = 'Desks' AND RD_Codes_Treatment = 'C1 - Donated to Charity' AND collections_customer_number = '$customer' AND collections_customer_site = '$site')";
                                      }
                                     

                                      IF ($customer !== "ALL" AND $site  == "ALL")
                                          {  
                                       $sql = "SELECT SUM(Quantity) AS Total FROM collections WHERE (collections_customer_country= '". $_SESSION['country'] ."' AND Material_Description = 'Desks' AND RD_Codes_Treatment = 'C1 - Donated to Charity' AND collections_customer_number = '$customer')";
                                      }
                                                                    

                                    $result = mysqli_query($db, $sql);
                                   
                                       while ($row = mysqli_fetch_array($result)) {
                                        $Total = $row['Total'];
                                         IF ($Total > 0) {echo number_format($Total, 0,'.', ',');} ELSE {echo 0;};            
                                                
                                            }
                                  ?>


                              </span>
                            </p>
                          </a> <!-- /.metric -->
                        </div><!-- /metric column -->
                        <!-- metric column -->
                        <div class="col">
                          <!-- .metric -->
                          <a href="#" class="metric metric-bordered align-items-center">
                            <h2 class="metric-label">Filing Cabinets</h2>
                            <p class="metric-value h3">
                              <sub><i class="fa fa-plug pulse"></i></sub> <span class="value">
                                
                                <?php
                                   
                                    
                                    $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
                                   


                                IF ($site == "ALL" AND $customer == "ALL")
                                {
                                   $sql = "SELECT SUM(Quantity) AS Total FROM collections WHERE (collections_customer_country= '". $_SESSION['country'] ."' AND Material_Description = 'Filing Cabinets' AND RD_Codes_Treatment = 'C1 - Donated to Charity' )";
                                }

                                  IF ($customer !== "ALL" AND $site  !== "ALL")


                                      {
                                      $sql = "SELECT SUM(Quantity) AS Total FROM collections WHERE (collections_customer_country= '". $_SESSION['country'] ."' AND Material_Description = 'Filing Cabinets' AND RD_Codes_Treatment = 'C1 - Donated to Charity' AND collections_customer_number = '$customer' AND collections_customer_site = '$site')";
                                    }
                                     
                                IF ($customer !== "ALL" AND $site  == "ALL")
                                      { 
                                      $sql = "SELECT SUM(Quantity) AS Total FROM collections WHERE (collections_customer_country= '". $_SESSION['country'] ."' AND Material_Description = 'Filing Cabinets' AND RD_Codes_Treatment = 'C1 - Donated to Charity' AND collections_customer_number = '$customer')";
                                    }

                                    $result = mysqli_query($db, $sql);
                                   
                                       while ($row = mysqli_fetch_array($result)) {
                                               $Total = $row['Total'];
                                             IF ($Total > 0) {echo number_format($Total, 0,'.', ',');} ELSE {echo 0;}
                                            ;
                                            }
                                  ?>




                              </span>
                            </p>
                          </a> <!-- /.metric -->
                        </div><!-- /metric column -->
                      
 <!-- metric column -->
                        <div class="col">
                          <!-- .metric -->
                          <a href="#" class="metric metric-bordered align-items-center">
                            <h2 class="metric-label">Pedestals</h2>
                            <p class="metric-value h3">
                              <sub><i class="fas fa-cog fa-spin"></i></i></sub> <span class="value">
                                

                                  <?php

                                   
                                    $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
                                    

                                    IF ($site == "ALL" AND $customer == "ALL")
                                          { 
                                            $sql = "SELECT SUM(Quantity) AS Total FROM collections WHERE (collections_customer_country= '". $_SESSION['country'] ."' AND Material_Description = 'Pedestals' AND RD_Codes_Treatment = 'C1 - Donated to Charity')";
                                          }


                                    IF ($customer !== "ALL" AND $site  !== "ALL")
                                    {
                                    $sql = "SELECT SUM(Quantity) AS Total FROM collections WHERE (collections_customer_country= '". $_SESSION['country'] ."' AND Material_Description = 'Pedestals' AND RD_Codes_Treatment = 'C1 - Donated to Charity' AND collections_customer_number = '$customer' AND collections_customer_site = '$site')";
                                    }
                                    

                                    IF ($customer !== "ALL" AND $site  == "ALL")
                                    {
                                     $sql = "SELECT SUM(Quantity) AS Total FROM collections WHERE (collections_customer_country= '". $_SESSION['country'] ."' AND Material_Description = 'Pedestals' AND RD_Codes_Treatment = 'C1 - Donated to Charity' AND collections_customer_number = '$customer')";
                                    }

                                    $result = mysqli_query($db, $sql);
                                   
                                       while ($row = mysqli_fetch_array($result)) {
                                               $Total = $row['Total'];
                                               IF ($Total > 0) {echo number_format($Total, 0,'.', ',');} ELSE {echo 0;}
                                              ;
                                            }
                                  
                                  ?>


                              </span>
                            </p>
                          </a> <!-- /.metric -->
                        </div><!-- /metric column -->

 <div class="col">
                          <!-- .metric -->
                          <a href="#" class="metric metric-bordered align-items-center">
                            <h2 class="metric-label">Monitor Stands</h2>
                            <p class="metric-value h3">
                              <sub><i class="fas fa-cog fa-spin"></i></i></sub> <span class="value">
                                

                                  <?php
                                   
                                    $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');

                                    IF ($site == "ALL" AND $customer == "ALL")
                                          {  
                                            $sql = "SELECT SUM(Quantity) AS Total FROM collections WHERE (collections_customer_country= '". $_SESSION['country'] ."' AND Material_Description = 'Monitor Stands' AND RD_Codes_Treatment = 'C1 - Donated to Charity')";
                                          }
                                    
                                     IF ($customer !== "ALL" AND $site  !== "ALL")
                                    {
                                    $sql = "SELECT SUM(Quantity) AS Total FROM collections WHERE (collections_customer_country= '". $_SESSION['country'] ."' AND Material_Description = 'Monitor Stands' AND RD_Codes_Treatment = 'C1 - Donated to Charity' AND collections_customer_number = '$customer' AND collections_customer_site = '$site')";
                                    }  
                                     IF ($customer !== "ALL" AND $site  == "ALL")
                                    {
                                     $sql = "SELECT SUM(Quantity) AS Total FROM collections WHERE (collections_customer_country= '". $_SESSION['country'] ."' AND Material_Description = 'Monitor Stands' AND RD_Codes_Treatment = 'C1 - Donated to Charity' AND collections_customer_number = '$customer')";
                                    }                   


                                    $result = mysqli_query($db, $sql);
                                   
                                       while ($row = mysqli_fetch_array($result)) {
                                                $Total = $row['Total'];
                                                IF ($Total > 0) {echo number_format($Total, 0,'.', ',');} ELSE {echo 0;}
                                                ;
                                            }
                                  ?>


                              </span>
                            </p>
                          </a> <!-- /.metric -->
                        </div><!-- /metric column -->

                       
                        





                      </div>
                    </div><!-- metric column -->
                    
                  </div><!-- /metric row -->
                </div><!-- /.section-block -->
               </div><!-- /.page-section -->


<!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->


<!-- Testing New Charity Boxes -->

<div id="donationsDiv" name="donationsDiv">

<?php

if (count($_GET) < 2){
  $site = "ALL";
  $customer = "ALL"; 
  }  
elseif (count($_GET) == 5) {
  $site = $_GET['mySite'];
  $customer = $_GET['myCustomer'];
  $start = $_GET['myStart'];
  $end = $_GET['myEnd'];

$db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');

if($_SESSION['customer_group'] == 'Workspace') {

  if ($site == "ALL" AND $customer == "ALL")
  {
  $sqlTest = "SELECT SUM(lookup_charity_donations.avg_value*`collections_quantity_not_kg`) AS 'Total' FROM collections INNER JOIN lookup_charity_donations ON collections.Material_Description = lookup_charity_donations.description WHERE collections_customer_country = '". $_SESSION['country'] ."' AND STR_TO_DATE(Colletion_Date, '%d/%m/%Y') BETWEEN '$start' AND '$end'";   
  }
  
  if ($customer !== "ALL" AND $site  == "ALL")
  {  
  $sqlTest = "SELECT SUM(lookup_charity_donations.avg_value*`collections_quantity_not_kg`) AS 'Total' FROM collections INNER JOIN lookup_charity_donations ON collections.Material_Description = lookup_charity_donations.description WHERE collections_customer_group = '". $_SESSION['customer_group'] ."' AND STR_TO_DATE(Colletion_Date, '%d/%m/%Y') BETWEEN '$start' AND '$end'";   
  }
  
  if ($customer !== "ALL" AND $site  !== "ALL")
  {
  $sqlTest = "SELECT SUM(lookup_charity_donations.avg_value*`collections_quantity_not_kg`) AS 'Total' FROM collections INNER JOIN lookup_charity_donations ON collections.Material_Description = lookup_charity_donations.description WHERE (collections_customer_group = '". $_SESSION['customer_group'] ."' AND collections_customer_site = '$site' AND STR_TO_DATE(Colletion_Date, '%d/%m/%Y') BETWEEN '$start' AND '$end')";   
  }
  
} else { 
  IF ($site == "ALL" AND $customer == "ALL")
  {  
      $sqlTest = "SELECT Material_Description, SUM(collections_quantity_not_kg) AS Total FROM collections WHERE collections_customer_country= '". $_SESSION['country'] ."' AND Material_Description IN (SELECT description FROM lookup_charity_donations) AND STR_TO_DATE(Colletion_Date, '%d/%m/%Y') BETWEEN '$start' AND '$end' GROUP BY Material_Description ORDER BY Total LIMIT 5";
  }
  IF ($customer !== "ALL" AND $site  !== "ALL")
  {
    $sqlTest = "SELECT Material_Description, SUM(collections_quantity_not_kg) AS Total FROM collections WHERE collections_customer_country= '". $_SESSION['country'] ."' AND Material_Description IN (SELECT description FROM lookup_charity_donations) AND collections_customer_number = '$customer' AND collections_customer_site = '$site' AND STR_TO_DATE(Colletion_Date, '%d/%m/%Y') BETWEEN '$start' AND '$end' GROUP BY Material_Description ORDER BY Total LIMIT 5";
  }
  IF ($customer !== "ALL" AND $site  == "ALL")
  {
    $sqlTest = "SELECT Material_Description, SUM(collections_quantity_not_kg) AS Total FROM collections WHERE collections_customer_country= '". $_SESSION['country'] ."' AND Material_Description IN (SELECT description FROM lookup_charity_donations) AND collections_customer_number = '$customer' AND STR_TO_DATE(Colletion_Date, '%d/%m/%Y') BETWEEN '$start' AND '$end' GROUP BY Material_Description ORDER BY Total LIMIT 5";
  }
}

} else {

  $site = $_GET['mySite'];
  $customer = $_GET['myCustomer'];

  if($_SESSION['customer_group'] == 'Workspace') {

    if ($site == "ALL" AND $customer == "ALL")
    {
    $sqlTest = "SELECT SUM(lookup_charity_donations.avg_value*`collections_quantity_not_kg`) AS 'Total' FROM collections INNER JOIN lookup_charity_donations ON collections.Material_Description = lookup_charity_donations.description WHERE collections_customer_country = '". $_SESSION['country'] ."'";   
    }
    
    if ($customer !== "ALL" AND $site  == "ALL")
    {  
    $sqlTest = "SELECT SUM(lookup_charity_donations.avg_value*`collections_quantity_not_kg`) AS 'Total' FROM collections INNER JOIN lookup_charity_donations ON collections.Material_Description = lookup_charity_donations.description WHERE collections_customer_group = '". $_SESSION['customer_group'] ."'";   
    }
    
    if ($customer !== "ALL" AND $site  !== "ALL")
    {
    $sqlTest = "SELECT SUM(lookup_charity_donations.avg_value*`collections_quantity_not_kg`) AS 'Total' FROM collections INNER JOIN lookup_charity_donations ON collections.Material_Description = lookup_charity_donations.description WHERE (collections_customer_group = '". $_SESSION['customer_group'] ."' AND collections_customer_site = '$site')";   
    }
    
  } else { 
    IF ($site == "ALL" AND $customer == "ALL")
    {  
        $sqlTest = "SELECT Material_Description, SUM(collections_quantity_not_kg) AS Total FROM collections WHERE collections_customer_country= '". $_SESSION['country'] ."' AND Material_Description IN (SELECT description FROM lookup_charity_donations) GROUP BY Material_Description ORDER BY Total LIMIT 5";
    }
    IF ($customer !== "ALL" AND $site  !== "ALL")
    {
      $sqlTest = "SELECT Material_Description, SUM(collections_quantity_not_kg) AS Total FROM collections WHERE collections_customer_country= '". $_SESSION['country'] ."' AND Material_Description IN (SELECT description FROM lookup_charity_donations) AND collections_customer_number = '$customer' AND collections_customer_site = '$site' GROUP BY Material_Description ORDER BY Total LIMIT 5";
    }
    IF ($customer !== "ALL" AND $site  == "ALL")
    {
      $sqlTest = "SELECT Material_Description, SUM(collections_quantity_not_kg) AS Total FROM collections WHERE collections_customer_country= '". $_SESSION['country'] ."' AND Material_Description IN (SELECT description FROM lookup_charity_donations) AND collections_customer_number = '$customer' GROUP BY Material_Description ORDER BY Total LIMIT 5";
    }
  }

}

$resultTypes = mysqli_query($db, $sqlTest);

//DECLARE YOUR ARRAY WHERE YOU WILL KEEP YOUR RECORD SETS
$data_array=array();
$rowCount = mysqli_num_rows($resultTypes);

//STORE ALL THE RECORD SETS IN THAT ARRAY 
while ($row = mysqli_fetch_array($resultTypes, MYSQLI_ASSOC)) 
{
    array_push($data_array,$row);
}

//printf("Result set has %d rows.\n",$rowCount);

mysqli_free_result($resultTypes);


//TEST TO SEE THE RESULT OF THE ARRAY 
echo '<pre>';
//print_r($data_array);
echo '</pre>';

for ($x = 0; $x <= $rowCount; $x++) {
  //echo "<br>The number is: $x <br>";
}
?>
                <?php if ($_SESSION['country'] == 'Workspace') { ?>
                <div class="metric-row">
                <?php } else { ?>
                <div class="metric-row" style="display:none"> 
                <?php } ?>
                    <div class="col-lg">
                      <div class="metric-row metric-flush">

                      <?php for ($x = 0; $x < $rowCount; $x++) { ?>
                          <!-- metric column -->
                          <div class="col">
                          <!-- .metric -->
                          <a href="#" class="metric metric-bordered align-items-center">
                          <?php if ($_SESSION['country'] == 'Workspace') { ?>
                            <h2 class="metric-label">Charity Donations (GBP)</h2>
                          <?php } else { ?>
                            <h2 class="metric-label"><?php echo $data_array[$x]['Material_Description'];?> (Units)</h2>
                          <?php } ?>
                            <p class="metric-value h3">

                              <sub><i class="fas fa-recycle fa-spin"></i></sub> <span class="value">

                                  <?php
                                
                                  if ($data_array[$x]['Total'] > 0) {echo number_format($data_array[$x]['Total'], 2,'.', ',');} else {echo 0;}
                                                      
                                  ?>

                              </span>
                            </p>
                          </a> <!-- /.metric -->
                        </div><!-- /col -->
                        <?php } ?>

                    </div><!-- /.metric-row metric-flush -->
                 </div><!-- /col-lg-9 -->
              </div><!-- metric-row end of div for reloading the squares -->
          </div>

<!-- End Testing -->

 <!-- grid row -->
                <div class="row">
                  <!-- grid column -->
                  <div class="col-12 col-lg-12 col-xl-4">
                    <!-- .card -->
                   
                    <div class="card card-fluid">
                      <!-- .card-body -->
                      <div class="card-body">
                        <h3 class="card-title mb-4"> Donated Furniture Units</h3>
                         <div id="chart-container" style="height: 292px">
                           <canvas id="charityCanvas1"></canvas>
                          </div>
                         </div>
                      </div><!-- /.card-body -->
                    </div><!-- /.card -->

                    <div class="col-12 col-lg-12 col-xl-4">
                    <!-- .card -->
                   
                    
                   
                    <div class="card card-fluid">
                      <!-- .card-body -->
                      <div class="card-body">
                        <h3 class="card-title mb-4"> Number of Donations by Charity</h3>
                         <div id="chart-containe3" style="height: 292px">
                           <canvas id="charityCanvas3"></canvas>
                          </div>
                         </div>
                      </div><!-- /.card-body -->
                    </div><!-- /.card -->

                     <div class="col-12 col-lg-12 col-xl-4">
                    <!-- .card -->
                   
                    
                   
                    <div class="card card-fluid" id="charityDiv">
                      <!-- .card-body -->
                      <div class="card-body">
                        <h3 class="card-title mb-4"> Total Charity Units by Site</h3>
                         <div id="chart-containe2" style="height: 292px">
                           <canvas id="charityCanvas2"></canvas>
                          </div>
                         </div>
                      </div><!-- /.card-body -->
                    </div><!-- /.card -->


                 
                  <!-- grid column -->
                 
                </div>

               


<!--- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->


<!-- @@@@@@@@@@@@@@@@@@@ jim end @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->

<!--- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->





             
            
            </div><!-- /.page-inner -->
          </div><!-- /.page -->
        </div><!-- .app-footer -->

<!--  @@@@@@@@@@@@@@@  MAIN AREA ENDS  HERE @@@@@@@@@@@@@@@  -->


<?php 
require APPROOT . '/views/inc/index_footer.php'; 
require APPROOT . '/views/inc/date_picker.js'; 
?>
<!-- <script src="<?php echo URLROOT; ?>/assets/javascript/pages/date_picker.js"></script> -->
<script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>