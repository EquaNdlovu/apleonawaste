
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
                <div class="d-flex flex-column flex-md-row">
                  <p class="lead">
                    <span class="font-weight-bold">Hi, <?php echo $_SESSION['user_name'];  ?></span> <span class="d-block text-muted">Here's what's going on</span>
                  </p>

                  <!-- <?php echo var_dump($_SESSION); ?> -->

                  <div class="ml-auto">
                    <!-- .dropdown -->
                   
                  </div>
                </div>

                
                   
                <div class="form-group">
                <label class="control-label" for="rangeDatepicker2">Select a Date Range</label>

                 <input id="rangeDatepicker2" class="form-control">
                </div><!-- /.form-group --> 





              </header><!-- /.page-title-bar -->
<!--- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  -->

<!-- .page-section -->
              <div class="page-section">
                <!-- .section-block -->
                <div class="section-block">
                  <!-- metric row -->

<p class="lead">
  <span class="font-weight-bold">Collections</span> 
</p>
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
                                           $sql = "SELECT SUM(Quantity) AS Total FROM collections WHERE (collections_customer_country= '". $_SESSION['country'] ."' AND Treatment_Method_Detail = 'Recycle')";
                                         }

                                
                                      
                                       IF ($customer !== "ALL" AND $site  == "ALL")
                                          {  
                                             $sql = "SELECT SUM(Quantity) AS Total FROM collections WHERE (collections_customer_country= '". $_SESSION['country'] ."' AND Treatment_Method_Detail = 'Recycle' AND collections_customer_number = '$customer')"; 
                                          
                                          }
                                       
                                       IF ($customer !== "ALL" AND $site  !== "ALL")
                                          {
                                           $sql = "SELECT SUM(Quantity) AS Total FROM collections WHERE (collections_customer_country= '". $_SESSION['country'] ."' AND Treatment_Method_Detail = 'Recycle' AND collections_customer_number = '$customer' AND collections_customer_site = '$site')";
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
                </div><!-- /.section-block -->
               </div><!-- /.page-section -->

<!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->

 <!-- grid row -->
                <div class="row">
                  <!-- grid column -->
                  <div class="col-12 col-lg-12 col-xl-4">
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
                 
                  <!-- grid column -->

                 
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
                 
                  <!-- grid column -->
                 
                </div>

<!--- @@@@@@@@@@@@@@@@@@ jim Start @@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->

 <p class="lead">
  <span class="font-weight-bold">Charity Donations</span> 
 </p>

<!-- .page-section -->
              <div class="page-section">
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

 <!-- grid row -->
                <div class="row">
                  <!-- grid column -->
                  <div class="col-12 col-lg-12 col-xl-4">
                    <!-- .card -->
                   
                    <div class="card card-fluid">
                      <!-- .card-body -->
                      <div class="card-body">
                        <h3 class="card-title mb-4"> Total Charity Units by Type</h3>
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
                        <h3 class="card-title mb-4"> Total Charity Units by Site</h3>
                         <div id="chart-containe2" style="height: 292px">
                           <canvas id="charityCanvas2"></canvas>
                          </div>
                         </div>
                      </div><!-- /.card-body -->
                    </div><!-- /.card -->

                    <div class="col-12 col-lg-12 col-xl-4">
                    <!-- .card -->
                   
                    
                   
                    <div class="card card-fluid">
                      <!-- .card-body -->
                      <div class="card-body">
                        <h3 class="card-title mb-4"> Donations by Charity</h3>
                         <div id="chart-containe3" style="height: 292px">
                           <canvas id="charityCanvas3"></canvas>
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
?>
