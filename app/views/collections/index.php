
<?php
require APPROOT . '/views/inc/header.php'; 
require APPROOT . '/views/inc/top_menu.php';
require APPROOT . '/views/inc/side_menu.php';  
?>


<?php
        $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
        if ($_SESSION['customer_group'] != '') {
          //$sql = "SELECT * FROM `collections` WHERE `collections_customer_group` = '". $_SESSION['customer_group'] ."' ORDER BY `Colletion_Date` DESC";
          $sql = "SELECT GROUP_CONCAT(collections_files.file_name) AS 'files', collections.* FROM `collections` LEFT JOIN collections_files ON collections.collections_key = collections_files.collections_key WHERE `collections_customer_group` = '". $_SESSION['customer_group'] ."' GROUP BY collections.collections_key ORDER BY `Colletion_Date` DESC";
        } else {
          $sql = "SELECT * FROM `collections` WHERE `collections_customer_country` = '". $_SESSION['country'] ."' ORDER BY `Colletion_Date` DESC";
        }
        $result = mysqli_query($db, $sql);
        $customerArray= array();
        while ($row = mysqli_fetch_array($result)) {
           array_push($customerArray, array('collections_key'=>$row['collections_key'],
                                            'collections_customer_country'=>$row['collections_customer_country'],
                                            'collections_workorder'=>$row['collections_workorder'],
                                            'collections_customer_site'=>$row['collections_customer_site'],
                                            'collections_customer_number'=>$row['collections_customer_number'],
                                            'Customer_Waste_Producer'=>$row['Customer_Waste_Producer'],
                                            'collections_address'=>$row['collections_address'],
                                            'Colletion_Date'=>$row['Colletion_Date'],
                                            'Order_Status'=>$row['Order_Status'],
                                            'Transaction_Type'=>$row['Transaction_Type'],
                                            'Material_Detail'=>$row['Material_Detail'],
                                            'Material_Description'=>$row['Material_Description'],
                                            'Material_UN_Code'=>$row['Material_UN_Code'],
                                            'Material_Dangerous_Goods_Label'=>$row['Material_Dangerous_Goods_Label'],
                                            'Material_Packaging_Group'=>$row['Material_Packaging_Group'],
                                            'Quantity'=>$row['Quantity'],
                                            'Unit_of_Measure'=>$row['Unit_of_Measure'],
                                            'Treatment_Cost'=>$row['Treatment_Cost'],
                                            'Transport_Cost'=>$row['Transport_Cost'],
                                            'Packaging_Cost'=>$row['Packaging_Cost'],
                                            'Consulting_Cost'=>$row['Consulting_Cost'],
                                            'Other_Cost'=>$row['Other_Cost'],
                                            'Total_Cost'=>$row['Total_Cost'],
                                            'Currency'=>$row['Currency'],
                                            'EWC'=>$row['ewc_parent'],
                                            'Indication_of_Danger'=>$row['Indication_of_Danger'],
                                            'ENVision_Description'=>$row['ENVision_Description'],
                                            'ENVision_Disposal'=>$row['ENVision_Disposal'],
                                            'Delivery_Number_Docket_Number'=>$row['Delivery_Number_Docket_Number'],
                                            'Waste_Vendor'=>$row['Waste_Vendor'],
                                            'Waste_Collector'=>$row['Waste_Collector'],
                                            'Treatment_Facility'=>$row['Treatment_Facility'],
                                            'Treatment_Method_Detail'=>$row['Treatment_Method_Detail'],
                                            'TFS_Number'=>$row['TFS_Number'],
                                            'TFS_Load_Number'=>$row['TFS_Load_Number'],
                                            'RD_Codes_Storage'=>$row['RD_Codes_Storage'],
                                            'RD_Codes_Treatment'=>$row['RD_Codes_Treatment'],
                                            'Container_Type'=>$row['Container_Type'],
                                            'Container_ID_No'=>$row['Container_ID_No'],
                                            'Container_Quantity'=>$row['Container_Quantity'],
                                            'collections_quantity_not_kg'=>$row['collections_quantity_not_kg'],
                                            'collections_not_kg_UOM'=>$row['collections_not_kg_UOM'],
                                            'TFS_Number'=>$row['TFS_Number'],
                                            'colletions_WTF_number'=>$row['colletions_WTF_number'],
                                            //'collections_cert_scan'=>$row['collections_cert_scan'],
                                            'collections_cert_scan'=>$row['files'],
                                            'collections_customer_group'=>$row['collections_customer_group'],
                                            'collections_customer'=>$row['collections_customer'],
                                            'collections_comments'=>$row['collections_comments'] ));
                                                       
        }

        $jsonArray = json_encode(array('data' => $customerArray), JSON_INVALID_UTF8_IGNORE);
       
          
     if (file_put_contents("assets/data/jimmy.json", $jsonArray))
      echo "JSON file created successfully...";
      else 
      echo "Oops! Error creating json file...";

  

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

              <input type="hidden" id="customer_group" name="customer_group" value="<?php echo $_SESSION['customer_group']; ?>"/>
              <?php //echo var_dump($_SESSION); ?>

                  <!-- Below code is to change edit button on collections page to redirect to Irish version -->
                  <?php $countrystring = $_SESSION['country'] ?>
                   <?php if ($countrystring == 'IE') { ?>
                   <div id="tempCountry" style="display:none"><?php echo '_'.$_SESSION['country'];?></div>     
                   <?php } else { ?>
                   <div id="tempCountry" style="display:none"><?php echo ''?></div>   
                   <?php } ?>
                   
               <header class="page-title-bar">
                <!-- .breadcrumb -->
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                      <a href="#"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Collections</a>
                    </li>
                  </ol>
                </nav><!-- /.breadcrumb -->
                <!-- floating action -->
                <button type="button" class="btn btn-success btn-floated"><span class="fa fa-plus"></span></button> <!-- /floating action -->
                <!-- title and toolbar -->
                <div class="d-md-flex align-items-md-start">
                  <h1 class="page-title mr-sm-auto"> Waste Collections </h1><!-- .btn-toolbar -->
                  <div id="dt-buttons" class="btn-toolbar"></div><!-- /.btn-toolbar -->
                </div><!-- /title and toolbar -->
              </header><!-- /.page-title-bar -->
              
   <!-- .page-section -->
              <div class="page-section">
                <!-- .card -->
                <div class="card card-fluid">
                  <!-- .card-header -->
                  <div class="card-header">
                    <!-- .nav-tabs -->
                    <ul class="nav nav-tabs card-header-tabs">
                      
                    </ul><!-- /.nav-tabs -->
                  </div><!-- /.card-header -->
                  <!-- .card-body -->
                  <div class="card-body">
                    <!-- .form-group -->
                    <div class="form-group">
                      <!-- .input-group -->
                      <div class="input-group input-group-alt">
                        <!-- .input-group-prepend -->
                        <div class="input-group-prepend">
                          <select id="filterBy" class="custom-select">
                            <option value='' selected> Filter By </option>
                            <!-- <option value="1"> Waste Producer </option>
                            <option value="2"> Address </option>
                            <option value="3"> Date </option>
                            <option value="4"> Material Description </option>
                            <option value="5"> UN Code </option>
                            <option value="5"> Cost </option> -->
                          </select>
                        </div><!-- /.input-group-prepend -->
                        <!-- .input-group -->
                        <div class="input-group has-clearable">
                          <button id="clear-search" type="button" class="close" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times-circle"></i></span></button>
                          <div class="input-group-prepend">
                            <span class="input-group-text"><span class="oi oi-magnifying-glass"></span></span>
                          </div><input id="table-search" type="text" class="form-control" placeholder="Search Collections">
                        </div><!-- /.input-group -->
                      </div><!-- /.input-group -->
                    </div><!-- /.form-group -->

                    <?php if($_SESSION['customer_group'] == 'Stryker Ireland') { ?>

                                          <!-- .table -->
                    <table id="myTable"  class="table table-striped table-bordered display nowrap" style="width:100%">
                      <!-- thead -->
                      <thead>
                        <tr>
                          <th colspan="2" style="min-width: 320px;">
                            <div class="thead-dd dropdown"> </div>
                            
                            </div>
                          </th>
                         </tr>
                         <tr> 
                          <th></th>
                          <th>Country</th>
                          <th>Customer</th>
                          <th>Site</th>
                          <th>Work Order</th>
                          <th>Waste Producer</th>
                          <th>Address</th>
                          <th>Date</th>
                          <th>Order Status</th>
                          <th>Material Description</th>
                          <th>Material Analysis Detail</th>
                          <th>Quantity</th>
                          <th>UOM</th>
                          <th>Quantity other than weight</th>
                          <th>UOM</th>
                          <th>Indication of Danger</th>
                          <th>Currency</th>
                          <th>EWC</th>
                          <th>Treatment Cost</th>
                          <th>Transport Cost</th>
                          <th>Packaging Cost</th>
                          <th>Other Cost</th>
                          <th>Total Cost</th>
                          <th>Broker</th>
                          <th>Collector</th>
                          <th>Treatment Facility</th>
                          <th>Treatment Method Detail</th>
                          <th>Container Quantity</th>
                          <th>Container Type</th>
                          <th>RD</th>
                          <th>WTF</th>
                          <th>TFS</th>
                          <th>Documents</th>
                          <th style="width:100px; min-width:100px;"> &nbsp; </th>
                        </tr>
                      </thead><!-- /thead -->
                      <!-- tbody -->
                      <tbody>
                        <!-- create empty row to passing html validator -->
                        <tr>

                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                      </tbody><!-- /tbody -->
                    </table><!-- /.table -->

                    <?php } else if ($_SESSION['customer_group'] == 'Abbott Ireland') { ?>

                                          <!-- .table -->
                    <table id="myTable"  class="table table-striped table-bordered display nowrap" style="width:100%">
                      <!-- thead -->
                      <thead>
                        <tr>
                          <th colspan="2" style="min-width: 320px;">
                            <div class="thead-dd dropdown"> </div>
                            
                            </div>
                          </th>
                         </tr>
                         <tr> 
                          <th></th>
                          <th>Country</th>
                          <th>Customer</th>
                          <th>Site</th>
                          <th>Work Order</th>
                          <th>Waste Producer</th>
                          <th>Address</th>
                          <th>Date</th>
                          <th>Order Status</th>
                          <th>Material Description</th>
                          <th>Material Analysis Detail</th>
                          <th>Quantity</th>
                          <th>UOM</th>
                          <th>Quantity</th>
                          <th>UOM</th>
                          <th>Indication of Danger</th>
                          <th>ENVision Description</th>
                          <th>ENVision Disposal</th>
                          <th>EWC</th>
                          <th>Broker</th>
                          <th>Collector</th>
                          <th>Treatment Facility</th>
                          <th>Treatment Method Detail</th>
                          <th>Containers</th>
                          <th>RD</th>
                          <th>WTF</th>
                          <th style="width:100px; min-width:100px;"> &nbsp; </th>
                        </tr>
                      </thead><!-- /thead -->
                      <!-- tbody -->
                      <tbody>
                        <!-- create empty row to passing html validator -->
                        <tr>

                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                      </tbody><!-- /tbody -->
                    </table><!-- /.table -->

                   <?php } else { ?>

                    <!-- .table -->
                    <table id="myTable"  class="table table-striped table-bordered display nowrap" style="width:100%">
                    <!-- thead -->
                    <thead>
                    <tr>
                    <th colspan="2" style="min-width: 320px;">
                    <div class="thead-dd dropdown"> </div>

                    </div>
                    </th>
                    </tr>
                    <tr> 
                    <th></th>
                    <th>Country</th>
                    <th>Customer</th>
                    <th>Site</th>
                    <th>Work Order</th>
                    <th>Waste Producer</th>
                    <th>Address</th>
                    <th>Date</th>
                    <th>Order Status</th>
                    <th>Material Description</th>
                    <th>Material Analysis Detail</th>
                    <th>Quantity</th>
                    <th>UOM</th>
                    <th>Quantity</th>
                    <th>UOM</th>
                    <th>Indication of Danger</th>
                    <th>EWC</th>
                    <th>Broker</th>
                    <th>Collector</th>
                    <th>Treatment Facility</th>
                    <th>Treatment Method Detail</th>
                    <th>Containers</th>
                    <th>RD</th>
                    <th>WTF</th>
                    <th style="width:100px; min-width:100px;"> &nbsp; </th>
                    </tr>
                    </thead><!-- /thead -->
                    <!-- tbody -->
                    <tbody>
                    <!-- create empty row to passing html validator -->
                    <tr>

                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    </tr>
                    </tbody><!-- /tbody -->
                    </table><!-- /.table -->

                    <?php } ?>

                  </div><!-- /.card-body -->
                </div><!-- /.card -->
                <hr class="my-5">
               
              </div><!-- /.page-section -->
           
    
  </div><!-- /.page-section -->
            </div><!-- /.page-inner -->
          </div><!-- /.page -->
        </div><!-- .app-footer -->  


<!-- .app-footer -->
 <footer class="app-footer">
          
          <div class="copyright"> Copyright © 2021. All right reserved. </div>
        </footer><!-- /.app-footer -->
        <!-- /.wrapper -->
      </main><!-- /.app-main -->
    </div><!-- /.app -->
        
 <!-- BEGIN BASE JS -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/popper.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script> <!-- END BASE JS -->
    <!-- BEGIN PLUGINS JS -->
    <script src="assets/vendor/pace/pace.min.js"></script>
    <script src="assets/vendor/stacked-menu/stacked-menu.min.js"></script>
    <script src="assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables/extensions/buttons/dataTables.buttons.min.js"></script>
    <script src="assets/vendor/datatables/extensions/buttons/buttons.bootstrap4.min.js"></script>
    <script src="assets/vendor/datatables/extensions/buttons/buttons.html5.min.js"></script>
    <script src="assets/vendor/datatables/extensions/buttons/buttons.print.min.js"></script> <!-- END PLUGINS JS -->
    <!-- BEGIN THEME JS -->
    <script src="assets/javascript/theme.min.js"></script> <!-- END THEME JS -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="assets/javascript/pages/dataTables.bootstrap.js"></script>
    <script src="assets/javascript/pages/datatables-demo.js"></script> 
    <!-- Below are extensions to correctly sort by date in the desired date format dd/mm/yyyy -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
    <script src="//cdn.datatables.net/plug-ins/1.11.3/sorting/datetime-moment.js"></script>
    <script>
    $(document).ready(function() {

    var table = $('#myTable').DataTable();

    $.fn.dataTable.moment( 'DD/MM/YYYY' );

    } );
    </script>
    <!-- <script>
    $(document).ready(function (){
    var table = $('#myTable').dataTable({
       "order": [[ 7, 'desc' ]]
    });    
    });
    </script> -->
    <!-- END PAGE LEVEL JS --> 
    <!-- SweetAlert JS -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- End SweetAlert JS -->
<?php
require APPROOT . '/views/inc/sweetalerts.js'; 
?>
  </body>
</html>