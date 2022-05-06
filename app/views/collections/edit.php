<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Setting Material Class Value as UK add form does not contain this field and it is referenced in additional.js -->
<?php $data['Material_Class'] = "" ?>

<?php
require APPROOT . '/views/inc/header.php'; 
require APPROOT . '/views/inc/cascading.js'; 
require APPROOT . '/views/inc/additional.js';
require APPROOT . '/views/inc/sweetalerts.js';
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
                <nav aria-label="breadcrumb">
                  
                </nav>
                <h1 class="page-title"> Edit Collections  <?php echo $data['collections_key']; ?> </h1>
                <p class="text-muted">Please enter the collection details below</p>
              </header>



              <!-- .page-section -->
              <div class="page-section">
                <!-- .section-block -->
                <div class="section-block">
                  <!-- Default Steps -->
                  <!-- .bs-stepper -->
                  <div id="stepper" class="bs-stepper">
                    <!-- .card -->
                    <div class="card">
                      <!-- .card-header -->
                      <div class="card-header">
                        <!-- .steps -->
                        <div class="steps steps-" role="tablist">
                          <ul>
                            <li class="step" data-target="#test-l-1">
                              <a href="#" class="step-trigger" tabindex="-1"><span class="step-indicator step-indicator-icon"><i class="oi oi-person"></i></span> <span class="d-none d-sm-inline">Customer</span></a>
                            </li>
                            <li class="step" data-target="#test-l-2">
                              <a href="#" class="step-trigger" tabindex="-1"><span class="step-indicator step-indicator-icon"><i class="oi oi-account-login"></i></span> <span class="d-none d-sm-inline">Material</span></a>
                            </li>
                          
                           <li class="step" data-target="#test-l-3">
                              <a href="#" class="step-trigger" tabindex="-1"><span class="step-indicator step-indicator-icon"><i class="oi oi-credit-card"></i></span> <span class="d-none d-sm-inline">Cost/Rebates</span></a>
                            </li>                       
                          
                            <li class="step" data-target="#test-l-4">
                              <a href="#" class="step-trigger" tabindex="-1"><span class="step-indicator step-indicator-icon"><i class="oi oi-account-login"></i></span> <span class="d-none d-sm-inline">Disposal</span></a>
                            </li>
                            <li class="step" data-target="#test-l-5">
                              <a href="#" class="step-trigger" tabindex="-1"><span class="step-indicator step-indicator-icon"><i class="oi oi-check"></i></span> <span class="d-none d-sm-inline">Documents</span></a>
                            </li>
                          </ul>
                        </div><!-- /.steps -->
                      </div><!-- /.card-header -->
                      <!-- .card-body -->
                      <div class="card-body">
                        <form id="stepper-form" name="stepperForm" 
                        action="<?php echo URLROOT; ?>/collections/edit/<?php echo $data['collections_key']; ?>" method="post" enctype="multipart/form-data">

                          <!-- .content -->
                          <div id="test-l-1" class="content dstepper-none fade">
                            <!-- fieldset -->
                            <fieldset>
                              <legend>Customer Details</legend> 

                              <div class="d-flex">
                              <input type="submit" class="btn btn-success" value="Submit">
                              <p></p><button type="button" class="next btn btn-primary ml-auto" data-validate="fieldset01">Next step</button>
                              </div><!-- /.d-flex -->                         
                           
                              <!-- .form-group -->
                              <div class="form-group mb-4">
                              <label class="control-label" for="collections_customer_country">Country</label>
                              <select name="collections_customer_country" id="collections_customer_country" data-toggle="selectpicker" data-width="100%">
                              <?php
                              echo "<option value=" . $data['collections_customer_country'] . ">". $data['collections_customer_country'] . "</option>";
 
                                $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
                                $sql = "SELECT waste_country_key, waste_country_name FROM wm_country ORDER BY waste_country_name ASC";
                                $result = mysqli_query($db, $sql);
                                
                                 while ($row = mysqli_fetch_array($result)) {
                                    echo "<option value='" .$row['waste_country_name']."'> ".$row['waste_country_name'] . "</option>"; 
                                    }
                                  echo "</select>";
                              ?>
                              </div>
                              <!-- /.form-group -->


                                 <!-- .form-group -->
                              <div class="form-group mb-4">
                                <div class="form-label-group">
                                   <label class="control-label" for="collections_workorder">Work Order</label>
                                  <input type="text" id="collections_workorder" name="collections_workorder" class="form-control" autocomplete="off" data-parsley-group="fieldset01" required="" value="<?php echo $data['collections_workorder']; ?>">
                                </div>
                                <div class="invalid-feedback"> Please select a valid Order </div>
                              </div><!-- /.form-group -->



                              <!-- .form-group -->
                              <div class="form-group mb-4">
                              <label class="control-label" for="collections_customer_number">Customer</label>
                              <select id="collections_customer_number" name="collections_customer_number" data-toggle="selectpicker" data-live-search="true" data-width="100%" data-size="6" onChange='getCustomerGroup(this.value); getWasteProducer(this.value); getCustomerSite(Customer_Waste_Producer.value); getCustomerAddress(this.value);'>                                 
                                <?php
                                $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
                                $sql = "SELECT waste_customer_name FROM wm_customer WHERE waste_customer_country = '" . $_SESSION['country'] . "'";
                                $result = mysqli_query($db, $sql);
                                echo "<option value='" . $data['collections_customer_number'] . "'>". $data['collections_customer_number'] . "</option>";
                                echo "<option value=0>Please Select</option>";
                                while ($row = mysqli_fetch_array($result)) {
                                  echo "<option value='" . $row['waste_customer_name'] . "'> " . $row['waste_customer_name'] . "</option>";
                                }
                                echo "</select>";
                                ?>
                              </div>
                              <!-- /.form-group -->

                              <!-- .form-group -->
                              <div class="form-group mb-4">
                              <label class="control-label" for="Customer_Waste_Producer">Waste Producer</label>
                              <div class="input-group">
                               <select id="Customer_Waste_Producer" name="Customer_Waste_Producer" data-toggle="selectpicker" data-live-search="true" data-width="100%" data-size="6" onChange='getCustomerSite(this.value);'>
                                 
                              <?php
                              echo "<option value='" . $data['Customer_Waste_Producer'] . "'>". $data['Customer_Waste_Producer'] . "</option>";
                              ?>   



                               </select>
                              </div>
                              </div>
                              <!-- /.form-group -->

                              <!-- .form-group -->
                              <div class="form-group mb-4">
                                <label class="control-label" for="collections_address">Programme</label>
                                  <div class="input-group">
                                  <select name=Collections_Programme id=Collections_Programme data-toggle="selectpicker" data-width="100%">
                                  <?php
                                     echo "<option value='" . $data['Collections_Programme'] . "'>". $data['Collections_Programme'] . "</option>";
                                  ?> 
                                      <option value="">Please Select</option>
                                      <option value="ROC">ROC</option>
                                  </select>
                                </div>
                              </div>
                              <!-- /.form-group -->


                              <!-- /.form-group -->
                              <div class="form-group mb-4">
                              <label class="control-label" for="collections_customer_site">Site</label>
                              <div class="input-group">
                              <select id="collections_customer_site" name="collections_customer_site" data-toggle="selectpicker" data-live-search="true" data-width="100%" data-size="6" onChange='getCustomerAddress(this.value);'> 
                                  <?php
                                  echo "<option value='" . $data['collections_customer_site'] . "'>". $data['collections_customer_site'] . "</option>";
                                  ?> 
                              </select>  
                              </div>
                            </div>

                              <!-- .form-group -->
                              

                               <!-- .form-group -->
                              <div class="form-group mb-4">
                              <label class="control-label" for="collections_address">Address / Region</label>
                               <select class="selectpicker" id="collections_address" name="collections_address" data-width="100%" >

                                <?php
                              echo "<option value='" . $data['collections_address'] . "'>". $data['collections_address'] . "</option>";
                              ?>   
      
                               </select>
                              </div>
                              <!-- /.form-group -->

                              <!-- .form-group -->
                              <div class="form-group mb-4" style="display:none">
                              <label class="control-label" for="collections_customer_group">Collections Customer Group</label>
                              <select id="collections_customer_group" name="collections_customer_group" class="custom-select" data-width="100%">
                              <option value="<?php echo $data['collections_customer_group'] ?>"><?php echo $data['collections_customer_group'] ?></option>
                              </select>
                              </div>
                              <!-- /.form-group -->

                              <!-- .form-group -->
                               <div class="form-group mb-4">
                               <div class="form-label-group">
                                <input name="Colletion_Date" type="text" class="form-control" value="<?php echo $data['Colletion_Date']; ?>" data-toggle="flatpickr" data-alt-input="true" data-alt-format="F j, Y" data-date-format="d/m/Y"> <label for="Colletion_Date">Collection Date</label>
                                </div><small class="form-text text-muted"></small>
                                <div class="invalid-feedback"> Please select a valid Date</div>
                              </div><!-- /.form-group -->


                               <!-- .form-group -->
                              <div class="form-group mb-4">
                                <div class="form-label-group">
                                 <label class="control-label" for="Order_Status">Order Status</label>
                                  <select id="Order_Status" name="Order_Status" class="form-control" autocomplete="off" data-parsley-group="fieldset01" value="Order_Status" required=""> 

                                      <?php
                                      echo "<option value='" . $data['Order_Status'] . "'>". $data['Order_Status'] . "</option>";
                                      ?>   
                                     <option value="Complete">Complete</option>
                                     <option value="In Progress">In Progress</option>
                                 </select>
                                </div><small class="form-text text-muted"></small>
                                <div class="invalid-feedback"> Please select a valid Order Status</div>
                              </div><!-- /.form-group -->

                              
                          


                             


                              <hr class="mt-5">
                              <!-- .d-flex -->
                              <div class="d-flex">
                              <input type="submit" class="btn btn-success" value="Submit">
                                <p></p><button type="button" class="next btn btn-primary ml-auto" data-validate="fieldset01">Next step</button>
                              </div><!-- /.d-flex -->
                            </fieldset><!-- /fieldset -->
                          </div><!-- /.content -->
                          <!-- .content -->
                        

                          <div id="test-l-2" class="content dstepper-none fade">
                            <!-- fieldset -->
                            <fieldset>
                             

                      <legend>Material</legend> <!-- .row -->
                              
                      <div class="d-flex">
                      <button type="button" class="prev btn btn-secondary">Previous</button> <input type="submit" class="btn btn-success" value="Submit">
                      <button type="button" class="next btn btn-primary ml-auto" data-validate="fieldset02">Next step</button>
                      </div>
                      <br><br>

                          <div class="row">
                
                          <!-- grid column -->
                          <div class="col-md-6 mb-4">
                              <label class="control-label" for="Material_Description">Material Description</label>
                              <div class="input-group">
                              <select id="Material_Description" name="Material_Description" data-toggle="selectpicker" data-live-search="true" data-width="100%" data-size="8" autocomplete="off" data-parsley-group="fieldset01" onchange="setEWCWorkspace(this.value);" required="">
                              <?php
                                           echo "<option hidden value='" . $data['Material_Description'] . "'>". $data['Material_Description'] . "</option>";
                              ?>
                                <option hidden value="">Please Select</option>
                                <optgroup label="Waste Type">
                                  <!-- <option value="Wood">Wood</option>
                                  <option value="Metal">Metal</option>
                                  <option value="General Waste">Mixed General Waste</option>
                                  <option value="Plastics">Plastic</option>
                                  <option value="WEE Items">WEE Items</option>
                                  <option value="Foams">Foams</option>
                                  <option value="Fabrics">Fabrics</option> -->
                                  <?php
                                  $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
                                  $sql = "SELECT description FROM lookup_material_description WHERE customer = '" . $_SESSION['country'] . "'";
                                  $result = mysqli_query($db, $sql);
                                  while ($row = mysqli_fetch_array($result)) {
                                  echo "<option value='" . $row['description'] . "'> " . $row['description'] . "</option>";
                                  }
                                  ?>
                                </optgroup>
                                <optgroup label="Charity Donations">
                                  <!-- <option value="Fabrics">Chairs</option>
                                  <option value="Fabrics">Desks</option>
                                  <option value="Fabrics">Filing Cabinets</option>
                                  <option value="Fabrics">Pedestals</option>
                                  <option value="Fabrics">Monitor Stands</option> -->
                                  <?php
                                  $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
                                  $sql = "SELECT description FROM lookup_charity_donations WHERE customer = '" . $_SESSION['country'] . "'";
                                  $result = mysqli_query($db, $sql);
                                  while ($row = mysqli_fetch_array($result)) {
                                  echo "<option value='" . $row['description'] . "'> " . $row['description'] . "</option>";
                                  }
                                  echo "</select>";
                                  ?>
                                </optgroup>

                              </select>
                            </div>
                            <div class="invalid-feedback"> Valid material description is required. </div>
                          </div><!-- /grid column -->
                                
                          <div class="col-md-6 mb-4">
                          <label class="control-label" for="Indication_of_Danger">Indication of Danger</label>
                            <div class="input-group">
                              <input type="text" id="Indication_of_Danger" class="form-control" name="Indication_of_Danger" value="N" data-parsley-group="fieldset02" required="">
                            </div>
                            <div class="invalid-feedback"> Valid Indication of Danger is required. </div>
                          </div><!-- /grid column -->
                                <!-- grid column -->
                                <div class="col-md-6 mb-4" style="display:none">
                                   <label class="control-label" for="Material_Detail">Material Analysis Detail</label>
                                   <div class="input-group">
                                      <select id="Material_Detail" name="Material_Detail" data-toggle="selectpicker" class="form-control" autocomplete="off" data-parsley-group="fieldset01" value="Material_Detail" required=""> 
                                         <?php
                                           echo "<option hidden value='" . $data['Material_Detail'] . "'>". $data['Material_Detail'] . "</option>";
                                         ?>  
                                            <option value="Recycling">Recycling</option>
                                            <option value="Electrical Items">Electrical Items</option>
                                            
                                   </select>
                                  </div>
                                  <div class="invalid-feedback"> Valid Material Analysis Detail is required. </div>
                                </div>
                               </div><!-- /.row -->
                                  

 

                              <div class="row">
                                <!-- grid column -->
                                <div class="col-md-6 mb-4">

                                    <div class="form-label-group">
                                    <input type="number" step=".01" id="Quantity" class="form-control" name="Quantity" data-parsley-group="fieldset02" required="" value="<?php echo $data['Quantity']; ?>" ><label for="Quantity">Quantity - Weights</label>
                                  </div>
                                  <div class="invalid-feedback"> Valid Quantity is required. </div>
                                </div><!-- /grid column -->
                             


                                  <!-- /grid column -->

                              

                                <!-- grid column -->
                                <div class="col-md-6 mb-4">
                                  <div class="form-label-group">
                                    <input type="text" id="Unit_of_Measure" class="form-control" name="Unit_of_Measure" data-parsley-group="fieldset02" required=""  value="<?php echo $data['Unit_of_Measure']; ?>"> <label for="Unit_of_Measure">Unit of Measure</label>
                                  </div>
                                  <div class="invalid-feedback"> Valid Unit of Measure is required. </div>
                                </div><!-- /grid column -->
                              </div><!-- /.row -->

                            





                              <div class="row">
                                <!-- grid column -->
                               
                               

                                <div class="col-md-6 mb-4">
                                  <div class="form-label-group">
                                   <input type="number" step=".01" id="collections_quantity_not_kg" class="form-control" name="collections_quantity_not_kg"  data-parsley-group="fieldset02" required="" 
                                   value="<?php echo $data['collections_quantity_not_kg']; ?>" > <label for="collections_quantity_not_kg">Quantity other than Weight</label>
                                  </div>
                                  <div class="invalid-feedback"> Valid Quantity is required. </div>
                                </div><!-- /grid column -->

                                <div class="col-md-6 mb-4">
                                  <div class="form-label-group">
                                    <input type="text" id="collections_not_kg_UOM" class="form-control" name="collections_not_kg_UOM" data-parsley-group="fieldset02" required="" value="<?php echo $data['collections_not_kg_UOM']; ?>" > <label for="collections_not_kg_UOM">Unit of Measure</label>
                                  </div>
                                  <div class="invalid-feedback"> Valid UOM is required. </div>
                                </div><!-- /grid column -->
                              </div><!-- /.row -->


                              <div class="row">
                          <!-- grid column -->
                          <div class="col-md-6 mb-4">
                            <label class="control-label" for=ewc_parent>EWC</label>
                            <div class="input-group">
                              <select name=ewc_parent id=ewc_parent data-toggle="selectpicker" data-live-search="true" data-width="100%" data-size="6" onchange="getChildEWC(this.value); showHazardousFieldsEWC()">
                                <option value="<?php echo $data['ewc_parent'] ?>"><?php echo $data['ewc_parent'] ?></option>
                                <?php
                                $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
                                $sql = "SELECT * FROM ewc_codes_updated WHERE LENGTH(ewc_numeric_id) > 5 ORDER BY ewc_key ASC";
                                $result = mysqli_query($db, $sql);
                                echo "<option value=''>Please Select</option>";
                                while ($row = mysqli_fetch_array($result)) {
                                  echo "<option value='" . $row['ewc_code_id'] . "'> " . $row['ewc_code_id'] . "</option>";
                                }
                                echo "</select>";
                                ?>
                            </div>
                          </div>

                          <div class="col-md-6 mb-4">
                            <label class="control-label" for=ewc_sub>EWC Description</label>
                            <div class="input-group">
                              <select id=ewc_sub class="custom-select" name=ewc_sub data-width="100%" readonly="readonly">
                                <option value="<?php echo $data['ewc_sub'] ?>"><?php echo $data['ewc_sub'] ?></option>
                                <option value=""></option>
                              </select>
                            </div>
                          </div>
                        </div><!-- /.row -->

                        <div class="row">
                          <!-- grid column -->
                          <div class="col-md-6 mb-4" style="display:none">
                            <div class="form-label-group">
                              <input type="text" id="Indication_of_Danger" class="form-control" name="Indication_of_Danger" value="N" data-parsley-group="fieldset02" required=""> <label for="Indication_of_Danger">Indication of Danger</label>
                            </div>
                            <div class="invalid-feedback"> Valid Indication of Danger is required. </div>
                          </div><!-- /grid column -->
                        </div>

                             

                              

                              <div class="row">
                                <!-- grid column -->
                                
                               
                              </div><!-- /.row -->





                              <hr class="mt-5">
                              <div class="d-flex">
                                <button type="button" class="prev btn btn-secondary">Previous</button> <input type="submit" class="btn btn-success" value="Submit">
                                <button type="button" class="next btn btn-primary ml-auto" data-validate="fieldset02">Next step</button>
                              </div>
                            </fieldset><!-- /fieldset -->
                          </div><!-- /.content -->
                          <!-- .content -->

                   <!-- .content -->
                   <div id="test-l-3" class="content dstepper-none fade">
                      <!-- fieldset -->
                      <fieldset>
                        <legend>Costs/Rebates</legend> <!-- .card -->

                        <div class="d-flex">
                          <button type="button" class="prev btn btn-secondary">Previous</button> <button type="button" class="next btn btn-primary ml-auto" data-validate="fieldset03">Next step</button>
                        </div>
                        <br><br>

                        <!-- grid column -->
                        <div class="col-md-6 offset-md-3 mb-4">
                          <div class="form-label-group">
                            <label class="control-label" for="Currency">Currency</label>

                            <select id="Currency" name="Currency" class="form-control" autocomplete="off" data-parsley-group="fieldset03">
                            <?php
                                echo "<option value=" . $data['Currency'] . ">". $data['Currency'] . "</option>";
                              ?> 
                              <option value="EUR">EUR</option>
                              <option value="GBP">GBP</option>

                            </select>
                          </div>
                          <div class="invalid-feedback"> Valid Currency is required. </div>
                        </div><!-- /grid column -->
                        <div class="col-md-6 offset-md-3 mb-4">

                          <div class="form-label-group">
                            <input type="number" value="<?php echo $data['Treatment_Cost'] ?>" step=".01" id="Treatment_Cost" class="form-control" name="Treatment_Cost" data-parsley-group="fieldset03" onChange="chPy();"> <label for="Treatment_Cost">Treatment Cost</label>
                          </div>
                          <div class="invalid-feedback"> Valid Treatment Cost is required. </div>
                        </div><!-- /grid column -->
                        <div class="col-md-6 offset-md-3 mb-4">

                          <div class="form-label-group">
                            <input type="number" value="<?php echo $data['Packaging_Cost'] ?>" step=".01" id="Packaging_Cost" class="form-control" name="Packaging_Cost" data-parsley-group="fieldset03" onChange="chPy();"> <label for="Packaging_Cost">Packaging Cost</label>
                          </div>
                          <div class="invalid-feedback"> Valid Packaging Cost is required. </div>
                        </div><!-- /grid column -->
                        <div class="col-md-6 offset-md-3 mb-4">

                          <div class="form-label-group">
                            <input type="number" value="<?php echo $data['Transport_Cost'] ?>" step=".01" id="Transport_Cost" class="form-control" name="Transport_Cost" data-parsley-group="fieldset03" onChange="chPy();"> <label for="Transport_Cost">Transport Cost</label>
                          </div>
                          <div class="invalid-feedback"> Valid Transport Cost is required. </div>
                        </div><!-- /grid column -->
                        <div class="col-md-6 offset-md-3 mb-4">

                          <div class="form-label-group">
                            <input type="number" value="<?php echo $data['Other_Cost'] ?>" step=".01" id="Other_Cost" class="form-control" name="Other_Cost" data-parsley-group="fieldset03" onChange="chPy();"> <label for="Other_Cost">Other Cost</label>
                          </div>
                          <div class="invalid-feedback"> Valid Other Cost is required. </div>
                        </div><!-- /grid column -->
                        <div class="col-md-6 offset-md-3 mb-4">

                          <div class="form-label-group">
                            <input type="number" value="<?php echo $data['Total_Cost'] ?>" step=".01" readonly="readonly" id="Total_Cost" class="form-control" name="Total_Cost" data-parsley-group="fieldset03"> <label for="Total_Cost">Total Cost</label>
                          </div>
                          <div class="invalid-feedback"> Valid Total Cost is required. </div>
                        </div><!-- /grid column -->


                        <hr class="mt-5">
                        <div class="d-flex">
                          <button type="button" class="prev btn btn-secondary">Previous</button> <input type="submit" class="btn btn-success" value="Submit"> 
                          <button type="button" class="next btn btn-primary ml-auto" data-validate="fieldset03">Next step</button>
                        </div>
                      </fieldset><!-- /fieldset -->
                    </div><!-- /.content -->

                          <!-- .content -->
                          <div id="test-l-4" class="content dstepper-none fade">
                            <!-- fieldset -->
                            <fieldset>
                              <legend>Disposal</legend> <!-- .card -->

                              <div class="d-flex">
                              <button type="button" class="prev btn btn-secondary">Previous</button> <input type="submit" class="btn btn-success" value="Submit">
                              <button type="button" class="next btn btn-primary ml-auto" data-validate="fieldset04">Next step</button>
                              </div>
                              <br><br>
                             
                              <div class="row">
                                <!-- grid column -->
                                <div class="col-md-6 mb-4">
                                  <label class="control-label" for="Waste_Vendor">Waste Broker</label>
                               <select name="Waste_Vendor" data-toggle="selectpicker" data-width="100%" >

                                <?php
                                      echo "<option value='" . $data['Waste_Vendor'] . "'>". $data['Waste_Vendor'] . "</option>";
                                
                                $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
                                $sql = "SELECT waste_broker_name FROM waste_broker WHERE waste_broker_country = '". $_SESSION['country'] ."' ORDER BY waste_broker_name ASC";
                                $result = mysqli_query($db, $sql);
                                echo "<option value=0>Please Select</option>";
                                 while ($row = mysqli_fetch_array($result)) {
                                    echo "<option value='" .$row['waste_broker_name']."'> ".$row['waste_broker_name'] . "</option>"; 
                                    }
                                  echo "</select>";
                              ?>
                                    
                                  <div class="invalid-feedback"> Valid Waste Broker is required. </div>
                                </div><!-- /grid column -->


                                 <!-- grid column -->
                                <div class="col-md-6 mb-4">
                                  <label class="control-label" for="Waste_Collector">Waste Collector</label>
                               <select name="Waste_Collector" data-toggle="selectpicker" data-width="100%" >

                                <?php
                                 echo "<option value='" . $data['Waste_Collector'] . "'>". $data['Waste_Collector'] . "</option>";
                                $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
                                $sql = "SELECT waste_collector_name FROM waste_collector WHERE waste_collector_country = '". $_SESSION['country'] ."' ORDER BY waste_collector_name ASC";
                                $result = mysqli_query($db, $sql);
                                echo "<option value=0>Please Select</option>";
                                 while ($row = mysqli_fetch_array($result)) {
                                    echo "<option value='" .$row['waste_collector_name']."'> ".$row['waste_collector_name'] . "</option>"; 
                                    }
                                  echo "</select>";
                              ?>
                                  <div class="invalid-feedback"> Valid Waste Collector is required. </div>
                                </div><!-- /grid column -->

                                                     

                                
                              </div><!-- /.row -->

                              <div class="row">
                                <!-- grid column -->
                                <div class="col-md-6 mb-4">
                                  <label class="control-label" for="Treatment_Facility">Treatment Facility</label>
                               <select name="Treatment_Facility" data-toggle="selectpicker" data-width="100%" >

                                 <?php
                                echo "<option value='" . $data['Treatment_Facility'] . "'>". $data['Treatment_Facility'] . "</option>";
                                $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
                                $sql = "SELECT treatment_facility_name FROM treatment_facility WHERE treatment_facility_country = '". $_SESSION['country'] ."' ORDER BY treatment_facility_name ASC";
                                $result = mysqli_query($db, $sql);
                                echo "<option value=0>Please Select</option>";
                                 while ($row = mysqli_fetch_array($result)) {
                                    echo "<option value='" .$row['treatment_facility_name']."'> ".$row['treatment_facility_name'] . "</option>"; 
                                    }
                                  echo "</select>";
                              ?>
                                   
                                    
                                  <div class="invalid-feedback"> Valid Treatment Facility is required. </div>
                                </div><!-- /grid column -->

                          <!-- grid column -->
                          <div class="col-md-6 mb-4">
                            <div class="form-group">
                              <label class="control-label" for="Treatment_Method_Detail">Treatment Method Detail</label>
                              <select id="Treatment_Method_Detail" name="Treatment_Method_Detail" class="selectpicker" data-live-search="true" data-width="100%" data-size="6" data-parsley-group="fieldset04" onchange="showCharityDonatedWorkspace()" value="">
                                <?php if ($data['Treatment_Method_Detail']) { ?>
                                  <option value="<?php echo $data['Treatment_Method_Detail'] ?>"><?php echo $data['Treatment_Method_Detail'] ?></option>
                                <?php } ?>
                                <?php
                                $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
                                $sql = "SELECT description FROM lookup_treatment_method_detail WHERE customer = '" . $_SESSION['country'] . "'";
                                $result = mysqli_query($db, $sql);
                                echo "<option hidden value='" . $data['Treatment_Method_Detail'] . "'>". $data['Treatment_Method_Detail'] . "</option>";
                                echo "<option value=''>Please Select</option>";
                                while ($row = mysqli_fetch_array($result)) {
                                  echo "<option value='" . $row['description'] . "'> " . $row['description'] . "</option>";
                                }
                                echo "</select>";
                                ?>
                            </div>
                            <div class="invalid-feedback"> Valid material description is required. </div>
                          </div>
                              </div>
                          <!-- grid column -->

                          <div class="row">
                          <!-- grid column -->
                          <div class="col-md-6 mb-4">

                          </div><!-- grid column -->
                          <!-- grid column -->
                          <div class="col-md-6 mb-4" id="Charity_Donated_div">
                            <label class="control-label" for="charity_donated_to">Charity Donated To</label>
                            <div class="form-group">
                              <select id="charity_donated_to" name="charity_donated_to" class="selectpicker" autocomplete="off" data-live-search="true" data-width="100%" data-size="6" data-parsley-group="fieldset04">
                              <?php if ($data['charity_donated_to']) { ?>
                                  <option value="<?php echo $data['charity_donated_to'] ?>"><?php echo $data['charity_donated_to'] ?></option>
                                <?php } ?>
                                <?php
                                $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
                                $sql = "SELECT description FROM lookup_charities WHERE customer = '" . $_SESSION['country'] . "'";
                                $result = mysqli_query($db, $sql);
                                echo "<option value=''>Please Select</option>";
                                while ($row = mysqli_fetch_array($result)) {
                                  echo "<option value='" . $row['description'] . "'> " . $row['description'] . "</option>";
                                }
                                echo "</select>";
                                ?>
                            </div>
                            <div class="invalid-feedback"> Valid Charity is required. </div>
                          </div>
                        </div><!-- /.row -->

                               <div class="row" style="display:none">
                                <!-- grid column -->
                                <div class="col-md-6 mb-4">
                                 
                                </div><!-- /grid column -->
                                <!-- grid column -->
                                <div class="col-md-6 mb-4">
                                  <div class="form-label-group">
                                    <input type="text" id="Container_Quantity" class="form-control" name="Container_Quantity" value="<?php echo $data['Container_Quantity']; ?>" data-parsley-group="fieldset02" required=""> <label for="Container_Quantity">Packaging Container Units</label>
                                  </div>
                                  <div class="invalid-feedback"> Valid Packaging Container Units is required. </div>
                                </div><!-- /grid column -->
                              </div><!-- /.row -->



                               <div class="row" style="display:none">
                                <!-- grid column -->
                                <div class="col-md-6 mb-4">
                                 
                                </div><!-- /grid column -->

                               <!-- grid column -->
                                <div class="col-md-6 mb-4">
                                  <label class="control-label" for="RD_Codes_Treatment">RD Codes</label>
                               <select name="RD_Codes_Treatment" data-toggle="selectpicker" data-width="100%" >
                                 <?php
                                  echo "<option value='" . $data['RD_Codes_Treatment'] . "'>". $data['RD_Codes_Treatment'] . "</option>";
                                $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
                                $sql = "SELECT rd_name FROM recovery_disposal_rd_codes ORDER BY rd_name ASC";
                                $result = mysqli_query($db, $sql);
                                echo "<option value=''>Please Select</option>";
                                 while ($row = mysqli_fetch_array($result)) {
                                    echo "<option value='" .$row['rd_name']."'> ".$row['rd_name'] . "</option>"; 
                                    }
                                  echo "</select>";
                              ?>
                                 <div class="invalid-feedback"> Valid RD Codes Treatment is required. </div>
                                </div><!-- /grid column -->

                               
                              </div><!-- /.row -->


                             

                              <hr class="mt-5">
                              <div class="d-flex">
                                <button type="button" class="prev btn btn-secondary">Previous</button> <input type="submit" class="btn btn-success" value="Submit">
                                <button type="button" class="next btn btn-primary ml-auto" data-validate="fieldset04">Next step</button>
                              </div>
                            </fieldset><!-- /fieldset -->
                          </div><!-- /.content -->


                          <!-- .content -->
                          <div id="test-l-5" class="content dstepper-none fade">
                            <!-- fieldset -->
                            <fieldset>
                              <legend>Documents</legend> <!-- .card -->
                             
                              <div class="form-group mb-4">
                                <div class="form-label-group">
                                  <input type="text" id="colletions_WTF_number" name="colletions_WTF_number" class="form-control" value="<?php echo $data['colletions_WTF_number']; ?>" autocomplete="off" data-parsley-group="fieldset01" required=""> <label for="colletions_WTF_number">WTF Number</label>
                                </div><small class="form-text text-muted"></small>
                                <div class="invalid-feedback"> Please select a valid WTF Number </div>
                              </div><!-- /.form-group -->

                                                        

                             <!-- .form-group -->
                             <div class="form-group mb-4" style="display:none">
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="collections_cert_scan" id="collections_cert_scan" multiple> 
                                    <label class="custom-file-label" for="collections_cert_scan">Choose files</label>
                                  </div>
                              </div>
                             
                              <!-- /.form-group -->

                        <div>
                        <?php echo "Documentation:" ?>
                            <div class="custom-file" id="customFile">
                                <input type="file" class="custom-file-input <?php echo (!empty($data['collections_cert_scan_err'])) ? 'is-invalid' : ''; ?>" id="file" name="file[]" aria-describedby="fileHelp" multiple>
                                <label class="custom-file-label" for="file">
                                    Select file...
                                </label>
                                <span class="invalid-feedback"><?php echo $data['collections_cert_Scan_err']; ?></span> 
                            </div>
                            <br>
                            <?php
                            $CollectionKey = $data['collections_key'];
                            $conn = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
                            $query3 = "SELECT file_name FROM collections_files WHERE collections_key='$CollectionKey'";
                            $run3 = mysqli_query($conn, $query3);
                            $rows = mysqli_fetch_all($run3);
                                foreach ($rows as $row) { ?>
                                 <div>
                                <a href="<?php echo URLROOT; ?>/collections/download?file=<?php echo current($row) ?>">Download <?php echo current($row) ?></a>
                                <a class="btn btn-sm btn-icon btn-secondary far fa-trash-alt" href="<?php echo URLROOT; ?>/collections/delete_file?key=<?php echo $CollectionKey?>&file=<?php echo current($row)?>" onclick="confirmation(event)"></a>
                                <!-- <a class="btn btn-sm btn-icon btn-secondary" href="delete/" onclick="confirmation(event)"><i class="far fa-trash-alt"></i></a><br> -->
                                </div>
                            <?php } ?>
                        </div>

                             


                              <hr class="mt-5">
                              <div class="d-flex">
                                
                              <button type="button" class="prev btn btn-secondary">Previous</button>
                               <input type="submit" class="btn btn-success" value="Submit">
                               
                               
                             
                             
                                 

                              </div>
                            </fieldset><!-- /fieldset -->
                          </div><!-- /.content -->


                        </form><!-- /form -->
                      </div><!-- /.card-body -->
                    </div><!-- /.card -->
                  </div><!-- /.bs-stepper -->
                  <!-- toasts container -->
                  <div aria-live="polite" aria-atomic="true">
                    <!-- Position it -->
                    <div style="position: fixed; top: 4.5rem; right: 1rem; z-index: 1050">
                      <!-- .toast -->
                      <div id="submitfeedback" class="toast bg-dark border-dark text-light fade hide" data-delay="3000" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header bg-primary text-white"> See your browser console </div>
                        <div class="toast-body">
                          <strong>Congrats!</strong> You see the submit feedback. </div>
                      </div><!-- /.toast -->
                    </div>
                  </div><!-- /toasts container -->
                </div><!-- /.section-block -->
                <hr class="my-5">
                <!-- .section-block -->
               </div><!-- /.page-section -->
            </div><!-- /.page-inner -->
          </div><!-- /.page -->
        </div><!-- .app-footer -->








 


              </div><!-- /.page-section -->
            </div><!-- /.page-inner -->
          </div><!-- /.page -->
        </div><!-- .app-footer -->






<?php 
require APPROOT . '/views/inc/footer.php'; 
?>
