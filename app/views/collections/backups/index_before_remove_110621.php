<?php
require APPROOT . '/views/inc/header.php'; 
require APPROOT . '/views/inc/top_menu.php';
require APPROOT . '/views/inc/side_menu.php';  
?>




<?php
        $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
        $sql = "Select * from collections WHERE collections_customer_country ='UK'";
        $result = mysqli_query($db, $sql);
        $customerArray= array();
        while ($row = mysqli_fetch_array($result)) {
           array_push($customerArray, array('collections_key'=>$row['collections_key'],
                                            'collections_customer_number'=>$row['collections_customer_number'],
                                            'Customer_Waste_Producer'=>$row['Customer_Waste_Producer'],
                                            'collections_address'=>$row['collections_address'],
                                            'Colletion_Date'=>$row['Colletion_Date'],
                                            'Order_Status'=>$row['Order_Status'],
                                            'Transaction_Type'=>$row['Transaction_Type'],
                                            'Material_Description'=>$row['Material_Description'],
                                            'Material_UN_Code'=>$row['Material_UN_Code'],
                                            'Material_Dangerous_Goods_Label'=>$row['Material_Dangerous_Goods_Label'],
                                            'Material_Packaging_Group'=>$row['Material_Packaging_Group'],
                                            'Quantity'=>$row['Quantity'],
                                            'Unit_of_Measure'=>$row['Unit_of_Measure'],
                                            'Treatment_Cost'=>$row['Treatment_Cost'],
                                            'Transport_Cost'=>$row['Transport_Cost'],
                                            'Consulting_Cost'=>$row['Consulting_Cost'],
                                            'Other_Cost'=>$row['Other_Cost'],
                                            'Total_Cost'=>$row['Total_Cost'],
                                            'Currency'=>$row['Currency'],
                                            'EWC'=>$row['EWC'],
                                            'Indication_of_Danger'=>$row['Indication_of_Danger'],
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
                                            'colletions_WTF_number'=>$row['colletions_WTF_number'],
                                            'collections_cert_scan'=>$row['collections_cert_scan'],
                                            'collections_customer_group'=>$row['collections_customer_group'],
                                            'collections_customer'=>$row['collections_customer'],
                                            'collections_comments'=>$row['collections_comments'] ));
                                                       
        }

        $jsonArray = json_encode(array('data' => $customerArray));
       
          
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
                      <li class="nav-item">
                        <a class="nav-link active show" data-toggle="tab" href="#tab1">All</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab2">Ongoing</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab3">Completed</a>
                      </li>
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
                            <option value="1"> Waste Producer </option>
                            <option value="2"> Address </option>
                            <option value="3"> Date </option>
                            <option value="4"> Material Description </option>
                            <option value="5"> UN Code </option>
                            <option value="5"> Cost </option>
                          </select>
                        </div><!-- /.input-group-prepend -->
                        <!-- .input-group -->
                        <div class="input-group has-clearable">
                          <button id="clear-search" type="button" class="close" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times-circle"></i></span></button>
                          <div class="input-group-prepend">
                            <span class="input-group-text"><span class="oi oi-magnifying-glass"></span></span>
                          </div><input id="table-search" type="text" class="form-control" placeholder="Search products">
                        </div><!-- /.input-group -->
                      </div><!-- /.input-group -->
                    </div><!-- /.form-group -->
                    <!-- .table -->
                    <table id="myTable"  class="table table-striped table-bordered display nowrap" style="width:100%">
                      <!-- thead -->
                      <thead>
                        <tr>
                          <th colspan="2" style="min-width: 320px;">
                            <div class="thead-dd dropdown">
                              <span class="custom-control custom-control-nolabel custom-checkbox"><input type="checkbox" class="custom-control-input" id="check-handle"> <label class="custom-control-label" for="check-handle"></label></span>
                              <div class="thead-btn" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="fa fa-caret-down"></span>
                              </div>
                              <div class="dropdown-menu">
                                <div class="dropdown-arrow"></div><a class="dropdown-item" href="#">Select all</a> <a class="dropdown-item" href="#">Unselect all</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item" href="#">Bulk remove</a> <a class="dropdown-item" href="#">Bulk edit</a> <a class="dropdown-item" href="#">Separate actions</a>
                              </div>
                            </div>
                          </th>
                         </tr>
                         <tr> 
                          <th></th>
                          <th> Waste Producer</th>
                          <th> Address </th>
                          <th> Date </th>
                          <th> Material Description </th>
                          <th> UN Code </th>
                          <th> Total Cost </th>
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
    <script src="assets/javascript/pages/datatables-demo.js"></script> <!-- END PAGE LEVEL JS --> 
  </body>
</html>