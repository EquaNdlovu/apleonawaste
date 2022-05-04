<?php
require APPROOT . '/views/inc/header.php'; 
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
                <h1 class="page-title"> Add Collections </h1>
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
                        <form id="stepper-form" name="stepperForm" action="<?php echo URLROOT; ?>/collections/add" method="post">
                          <!-- .content -->
                          <div id="test-l-1" class="content dstepper-none fade">
                            <!-- fieldset -->
                            <fieldset>
                              <legend>Customer Details</legend> 

                              <!-- .form-group -->
                              <div class="form-group mb-4">
                              <label class="control-label" for="collections_customer">Customer</label>
                               <select name="collections_customer" data-toggle="selectpicker" data-width="100%">
                                  <option value=""> Please Select... </option>
                                  <option value="Stryker - Annagrove"> Stryker - Annagrove </option>
                                  <option value="Stryker - Banta"> Stryker - Banta </option>
                                  <option value="Stryker - Innovation Centre"> Stryker - Innovation Centre </option>
                               </select>
                              </div>
                              <!-- /.form-group -->


                              <!-- .form-group -->
                              <div class="form-group mb-4">
                              <label class="control-label" for="collections_customer_group">Customer Group</label>
                               <select name="collections_customer_group" data-toggle="selectpicker" data-width="100%" >
                                  <option value=""> Please Select... </option>
                                  <option value="Stryker - Limerick"> Stryker - Limerick </option>
                                  <option value="Stryker - Cork "> Stryker - Cork </option>
                                </select>
                              </div>
                              <!-- /.form-group -->
                              
                             


                             <!-- .form-group -->
                              <div class="form-group mb-4">
                                <div class="form-label-group">
                                  <input type="text" id="Customer_Waste_Producer" name="Customer_Waste_Producer" class="form-control" value="<?php echo $data['Customer_Waste_Producer']; ?>" autocomplete="off" data-parsley-group="fieldset01" required=""> <label for="Customer_Waste_Producer">Waste Producer</label>
                                </div><small class="form-text text-muted"></small>
                                <div class="invalid-feedback"> Please select a valid Waste Producer</div>
                              </div><!-- /.form-group -->
                              
                              <!-- .form-group -->
                              <div class="form-group mb-4">
                                <div class="form-label-group">
                                  <input type="text" id="collections_address" name="collections_address" class="form-control" value="<?php echo $data['collections_address'];?>" autocomplete="off" data-parsley-group="fieldset01" required=""> <label for="collections_address">Collection Address</label>
                                </div><small class="form-text text-muted"></small>
                                <div class="invalid-feedback"> Please select a valid Collection Address</div>
                              </div><!-- /.form-group -->

                               <!-- .form-group -->
                              <div class="form-group mb-4">
                                <div class="form-label-group">
                                  <input type="text" id="Customer_Waste_Producer" name="Customer_Waste_Producer" class="form-control" value="<?php echo $data['Customer_Waste_Producer']; ?>" autocomplete="off" data-parsley-group="fieldset01" required=""> <label for="Customer_Waste_Producer">Overall Customer</label>
                                </div><small class="form-text text-muted"></small>
                                <div class="invalid-feedback"> Please select a valid Overall Customer</div>
                              </div><!-- /.form-group -->

                               <!-- .form-group -->
                               <div class="form-group mb-4">
                               <div class="form-label-group">
                                <input name="Colletion_Date" type="text" class="form-control" value="<?php echo $data['Colletion_Date']; ?>" data-toggle="flatpickr" data-alt-input="true" data-alt-format="F j, Y" data-date-format="Y-m-d"> <label for="Colletion_Date">Collection Date</label>
                                </div><small class="form-text text-muted"></small>
                                <div class="invalid-feedback"> Please select a valid Date</div>
                              </div><!-- /.form-group -->

                              
                               <!-- .form-group -->
                              <div class="form-group mb-4">
                                <div class="form-label-group">
                                  <input type="text" id="Transaction_Type" name="Transaction_Type" class="form-control" value="<?php echo $data['Transaction_Type']; ?>" autocomplete="off" data-parsley-group="fieldset01" required=""> <label for="Transaction_Type">Customer Reference</label>
                                </div><small class="form-text text-muted"></small>
                                <div class="invalid-feedback"> Please select a valid Transaction Type</div>
                              </div><!-- /.form-group -->


                               <!-- .form-group -->
                              <div class="form-group mb-4">
                                <div class="form-label-group">
                                  <input type="text" id="Order_Status" name="Order_Status" class="form-control" value="<?php echo $data['Order_Status']; ?>" autocomplete="off" data-parsley-group="fieldset01" required=""> <label for="Order_Status">Order Status</label>
                                </div><small class="form-text text-muted"></small>
                                <div class="invalid-feedback"> Please select a valid Order Status</div>
                              </div><!-- /.form-group -->


                              <hr class="mt-5">
                              <!-- .d-flex -->
                              <div class="d-flex">
                                <p></p><button type="button" class="next btn btn-primary ml-auto" data-validate="fieldset01">Next step</button>
                              </div><!-- /.d-flex -->
                            </fieldset><!-- /fieldset -->
                          </div><!-- /.content -->
                          <!-- .content -->
                        

                          <div id="test-l-2" class="content dstepper-none fade">
                            <!-- fieldset -->
                            <fieldset>
                             

                              <legend>Material</legend> <!-- .row -->
                              





                              <div class="row">
                                <!-- grid column -->
                                <div class="col-md-6 mb-4">
                                  <div class="form-label-group">
                                    <input type="text" id="Material_Description" class="form-control" name="Material_Description"  value="<?php echo $data['Material_Description']; ?>" data-parsley-group="fieldset02" required=""> <label for="Material_Description">Material Description</label>
                                  </div>
                                  <div class="invalid-feedback"> Valid material description is required. </div>
                                </div><!-- /grid column -->
                                <!-- grid column -->
                                <div class="col-md-6 mb-4">
                                  <div class="form-label-group">
                                    <input type="text" id="Quantity" class="form-control" name="Quantity" value="Quantity" data-parsley-group="fieldset02" required=""> <label for="Quantity">Quantity - Weights</label>
                                  </div>
                                  <div class="invalid-feedback"> Valid Quantity is required. </div>
                                </div><!-- /grid column -->
                              </div><!-- /.row -->

                              <div class="row">
                                <!-- grid column -->
                                <div class="col-md-6 mb-4">
                                  <div class="form-label-group">
                                    <input type="text" id="Material_Detail" class="form-control" name="Material_Detail" value="Material Analysis Detail" data-parsley-group="fieldset02" required=""> <label for="Material_Detail">Material Analysis Detail</label>
                                  </div>
                                  <div class="invalid-feedback"> Valid Material Analysis Detail is required. </div>
                                </div><!-- /grid column -->
                                <!-- grid column -->
                                <div class="col-md-6 mb-4">
                                  <div class="form-label-group">
                                    <input type="text" id="Unit_of_Measure" class="form-control" name="Unit_of_Measure" value="Unit of Measure" data-parsley-group="fieldset02" required=""> <label for="Unit_of_Measure">Unit of Measure</label>
                                  </div>
                                  <div class="invalid-feedback"> Valid Unit of Measure is required. </div>
                                </div><!-- /grid column -->
                              </div><!-- /.row -->

                               <div class="row">
                                <!-- grid column -->
                                <div class="col-md-6 mb-4">
                                  <div class="form-label-group">
                                    <input type="text" id="Material_UN_Code" class="form-control" name="Material_UN_Code" value="Material UN Code" data-parsley-group="fieldset02" required=""> <label for="Material_UN_Code">Material UN Code</label>
                                  </div>
                                  <div class="invalid-feedback"> Valid Material UN Code is required. </div>
                                </div><!-- /grid column -->
                                <!-- grid column -->
                                <div class="col-md-6 mb-4">
                                  <div class="form-label-group">
                                    <input type="text" id="collections_quantity_not_kg" class="form-control" name="collections_quantity_not_kg" value="Quantity other than Weight" data-parsley-group="fieldset02" required=""> <label for="collections_quantity_not_kg">Quantity other than Weight</label>
                                  </div>
                                  <div class="invalid-feedback"> Valid Quantity is required. </div>
                                </div><!-- /grid column -->
                              </div><!-- /.row -->


                              <div class="row">
                                <!-- grid column -->
                                <div class="col-md-6 mb-4">
                                  <div class="form-label-group">
                                    <input type="text" id="Indication_of_Danger" class="form-control" name="Indication_of_Danger" value="Indication of Danger" data-parsley-group="fieldset02" required=""> <label for="Indication_of_Danger">Indication of Danger</label>
                                  </div>
                                  <div class="invalid-feedback"> Valid Indication of Danger is required. </div>
                                </div><!-- /grid column -->
                                <!-- grid column -->
                                <div class="col-md-6 mb-4">
                                  <div class="form-label-group">
                                    <input type="text" id="collections_not_kg_UOM" class="form-control" name="collections_not_kg_UOM" value="Unit of Measure" data-parsley-group="fieldset02" required=""> <label for="collections_not_kg_UOM">Unit of Measure</label>
                                  </div>
                                  <div class="invalid-feedback"> Valid UOM is required. </div>
                                </div><!-- /grid column -->
                              </div><!-- /.row -->

                               <div class="row">
                                <!-- grid column -->
                                <div class="col-md-6 mb-4">
                                  <div class="form-label-group">
                                    <input type="text" id="Material_Dangerous_Goods_Label" class="form-control" name="Material_Dangerous_Goods_Label" value="Class" data-parsley-group="fieldset02" required=""> <label for="Material_Dangerous_Goods_Label">Class</label>
                                  </div>
                                  <div class="invalid-feedback"> Valid Class is required. </div>
                                </div><!-- /grid column -->
                                <!-- grid column -->
                                <div class="col-md-6 mb-4">
                                  <div class="form-label-group">
                                    <input type="text" id="Material_Packaging_Group" class="form-control" name="Material_Packaging_Group" value="Material Packing Group" data-parsley-group="fieldset02" required=""> <label for="Material_Packaging_Group">Material Packing Group</label>
                                  </div>
                                  <div class="invalid-feedback"> Material Packing Group </div>
                                </div><!-- /grid column -->
                              </div><!-- /.row -->

                              <div class="row">
                                <!-- grid column -->
                                <div class="col-md-6 mb-4">
                                  <div class="form-label-group">
                                    <input type="text" id="EWC" class="form-control" name="EWC" value="EWC" data-parsley-group="fieldset02" required=""> <label for="EWC">EWC</label>
                                  </div>
                                  <div class="invalid-feedback"> Valid EWC is required. </div>
                                </div><!-- /grid column -->
                               
                              </div><!-- /.row -->





                              <hr class="mt-5">
                              <div class="d-flex">
                                <button type="button" class="prev btn btn-secondary">Previous</button> <button type="button" class="next btn btn-primary ml-auto" data-validate="fieldset02">Next step</button>
                              </div>
                            </fieldset><!-- /fieldset -->
                          </div><!-- /.content -->
                          <!-- .content -->
                        

                          <div id="test-l-3" class="content dstepper-none fade">
                            <!-- fieldset -->
                            <fieldset>
                              <legend>Costs / Rebates</legend> <!-- .custom-control -->

                               <div class="row">
                                <!-- grid column -->
                                <div class="col-md-6 mb-4">
                                  <div class="form-label-group">
                                    <input type="text" id="Currency" class="form-control" name="Currency" value="Currency" data-parsley-group="fieldset02" required=""> <label for="Currency">Currency</label>
                                  </div>
                                  <div class="invalid-feedback"> Valid currency is required. </div>
                                </div><!-- /grid column -->
                                <!-- grid column -->
                                <div class="col-md-6 mb-4">
                                  <div class="form-label-group">
                                    <input type="text" id="Treatment_Cost" class="form-control" name="Treatment_Cost" value="Treatment Cost" data-parsley-group="fieldset02" required=""> <label for="Treatment_Cost">Treatment Cost</label>
                                  </div>
                                  <div class="invalid-feedback"> Valid Treatment Cost is required. </div>
                                </div><!-- /grid column -->
                              </div><!-- /.row -->

                              <div class="row">
                                <!-- grid column -->
                                <div class="col-md-6 mb-4">
                                  <div class="form-label-group">
                                    <input type="text" id="Consulting_Cost" class="form-control" name="Consulting_Cost" value="Packaging Cost" data-parsley-group="fieldset02" required=""> <label for="Consulting_Cost">Packaging Cost</label>
                                  </div>
                                  <div class="invalid-feedback"> Valid Packaging Cost is required. </div>
                                </div><!-- /grid column -->
                                <!-- grid column -->
                                <div class="col-md-6 mb-4">
                                  <div class="form-label-group">
                                    <input type="text" id="Transport_Cost" class="form-control" name="Transport_Cost" value="Transport Cost" data-parsley-group="fieldset02" required=""> <label for="Transport_Cost">Transport Cost</label>
                                  </div>
                                  <div class="invalid-feedback"> Valid Transport Cost is required. </div>
                                </div><!-- /grid column -->
                              </div><!-- /.row -->

                               <div class="row">
                                <!-- grid column -->
                                <div class="col-md-6 mb-4">
                                  <div class="form-label-group">
                                    <input type="text" id="Other_Cost" class="form-control" name="Other_Cost" value="Other Cost" data-parsley-group="fieldset02" required=""> <label for="Other_Cost">Other Cost</label>
                                  </div>
                                  <div class="invalid-feedback"> Valid Other Cost is required. </div>
                                </div><!-- /grid column -->
                                <!-- grid column -->
                                <div class="col-md-6 mb-4">
                                  <div class="form-label-group">
                                    <input type="text" id="Total_Cost" class="form-control" name="Total_Cost" value="Total Cost" data-parsley-group="fieldset02" required=""> <label for="Total_Cost">Total Cost</label>
                                  </div>
                                  <div class="invalid-feedback"> Valid Total Cost is required. </div>
                                </div><!-- /grid column -->
                              </div><!-- /.row -->

                             
                              <hr class="mt-5">
                              <div class="d-flex">
                                <button type="button" class="prev btn btn-secondary">Previous</button> <button type="button" class="next btn btn-primary ml-auto" data-validate="fieldset03">Next step</button>
                              </div>
                            </fieldset><!-- /fieldset -->
                          </div><!-- /.content -->
                          <!-- .content -->
                          <div id="test-l-4" class="content dstepper-none fade">
                            <!-- fieldset -->
                            <fieldset>
                              <legend>Disposal</legend> <!-- .card -->
                             
                              <div class="row">
                                <!-- grid column -->
                                <div class="col-md-6 mb-4">
                                  <div class="form-label-group">
                                    <input type="text" id="Waste_Vendor" class="form-control" name="Waste_Vendor" value="Waste Broker" data-parsley-group="fieldset02" required=""> <label for="Waste_Vendor">Waste Broker</label>
                                  </div>
                                  <div class="invalid-feedback"> Valid Waste Broker is required. </div>
                                </div><!-- /grid column -->
                                <!-- grid column -->
                                <div class="col-md-6 mb-4">
                                  <div class="form-label-group">
                                    <input type="text" id="Waste_Collector" class="form-control" name="Waste_Collector" value="Waste Collector" data-parsley-group="fieldset02" required=""> <label for="Waste_Collector">Waste Collector</label>
                                  </div>
                                  <div class="invalid-feedback"> Valid Waste Collector is required. </div>
                                </div><!-- /grid column -->
                              </div><!-- /.row -->

                              <div class="row">
                                <!-- grid column -->
                                <div class="col-md-6 mb-4">
                                  <div class="form-label-group">
                                    <input type="text" id="Treatment_Facility" class="form-control" name="Treatment_Facility" value="Treatment Facility" data-parsley-group="fieldset02" required=""> <label for="Treatment_Facility">Treatment Facility</label>
                                  </div>
                                  <div class="invalid-feedback"> Valid Treatment Facility is required. </div>
                                </div><!-- /grid column -->
                                <!-- grid column -->
                                <div class="col-md-6 mb-4">
                                  <div class="form-label-group">
                                    <input type="text" id="Treatment_Method_Detail" class="form-control" name="Treatment_Method_Detail" value="Treatment Method Detail" data-parsley-group="fieldset02" required=""> <label for="Treatment_Method_Detail">Treatment Method Detail</label>
                                  </div>
                                  <div class="invalid-feedback"> Valid Treatment Method Detail is required. </div>
                                </div><!-- /grid column -->
                              </div><!-- /.row -->

                               <div class="row">
                                <!-- grid column -->
                                <div class="col-md-6 mb-4">
                                  <div class="form-label-group">
                                    <input type="text" id="Container_Type" class="form-control" name="Container_Type" value="Packaging Container Description" data-parsley-group="fieldset02" required=""> <label for="Container_Type">Packaging Container Description</label>
                                  </div>
                                  <div class="invalid-feedback"> Valid Packaging Container Description is required. </div>
                                </div><!-- /grid column -->
                                <!-- grid column -->
                                <div class="col-md-6 mb-4">
                                  <div class="form-label-group">
                                    <input type="text" id="Container_Quantity" class="form-control" name="Container_Quantity" value="Packaging Container Units" data-parsley-group="fieldset02" required=""> <label for="Container_Quantity">Packaging Container Units</label>
                                  </div>
                                  <div class="invalid-feedback"> Valid Packaging Container Units is required. </div>
                                </div><!-- /grid column -->
                              </div><!-- /.row -->


                               <div class="row">
                                <!-- grid column -->
                                <div class="col-md-6 mb-4">
                                  <div class="form-label-group">
                                    <input type="text" id="RD_Codes_Storage" class="form-control" name="RD_Codes_Storage" value="RD Codes Installation" data-parsley-group="fieldset02" required=""> <label for="RD_Codes_Storage">RD Codes Installation</label>
                                  </div>
                                  <div class="invalid-feedback"> Valid RD Codes Installation is required. </div>
                                </div><!-- /grid column -->
                                <!-- grid column -->
                                <div class="col-md-6 mb-4">
                                  <div class="form-label-group">
                                    <input type="text" id="RD_Codes_Treatment" class="form-control" name="RD_Codes_Treatment" value="RD Codes End Treatment" data-parsley-group="fieldset02" required=""> <label for="RD_Codes_Treatment">RD Codes End Treatment</label>
                                  </div>
                                  <div class="invalid-feedback"> Valid RD Codes End Treatment is required. </div>
                                </div><!-- /grid column -->
                              </div><!-- /.row -->


                              <div class="row">
                                <!-- grid column -->
                                <div class="col-md-6 mb-4">
                                  <div class="form-label-group">
                                    <input type="text" id="Delivery_Number_Docket_Number" class="form-control" name="Delivery_Number_Docket_Number" value="Vendor Delivery Number" data-parsley-group="fieldset02" required=""> <label for="Delivery_Number_Docket_Number">Vendor Delivery Number</label>
                                  </div>
                                  <div class="invalid-feedback"> Valid Vendor Delivery Number is required. </div>
                                </div><!-- /grid column -->
                                <!-- grid column -->
                                <div class="col-md-6 mb-4">
                                  <div class="form-label-group">
                                    <input type="text" id="Container_ID_No" class="form-control" name="Container_ID_No" value="Packaging Container Reference ID" data-parsley-group="fieldset02" required=""> <label for="Container_ID_No">Packaging Container Reference ID</label>
                                  </div>
                                  <div class="invalid-feedback"> Valid Packaging Container Reference ID is required. </div>
                                </div><!-- /grid column -->
                              </div><!-- /.row -->

                              <hr class="mt-5">
                              <div class="d-flex">
                                <button type="button" class="prev btn btn-secondary">Previous</button> 
                                <button type="button" class="next btn btn-primary ml-auto" data-validate="fieldset01">Next step</button>
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
                                  <input type="text" id="colletions_WTF_number" name="colletions_WTF_number" class="form-control" value="WTF Number" autocomplete="off" data-parsley-group="fieldset01" required=""> <label for="colletions_WTF_number">WTF Number</label>
                                </div><small class="form-text text-muted"></small>
                                <div class="invalid-feedback"> Please select a valid WTF Number </div>
                              </div><!-- /.form-group -->

                              <div class="form-group mb-4">
                                <div class="form-label-group">
                                  <input type="text" id="TFS_Number" name="TFS_Number" class="form-control" value="TFS Number" autocomplete="off" data-parsley-group="fieldset01" required=""> <label for="TFS_Number">TFS Number</label>
                                </div><small class="form-text text-muted"></small>
                                <div class="invalid-feedback"> Please select a valid TFS Number </div>
                              </div><!-- /.form-group -->

                              <div class="form-group mb-4">
                                <div class="form-label-group">
                                  <input type="text" id="TFS_Load_Number" name="TFS_Load_Number" class="form-control" value="TFS Load Number" autocomplete="off" data-parsley-group="fieldset01" required=""> <label for="TFS_Load_Number">TFS Load Number</label>
                                </div><small class="form-text text-muted"></small>
                                <div class="invalid-feedback"> Please select a valid TFS Load Number </div>
                              </div><!-- /.form-group -->

                              <div class="form-group mb-4">
                                <div class="form-label-group">
                                  <input type="text" id="collections_comments" name="collections_comments" class="form-control" value="Comments" autocomplete="off" data-parsley-group="fieldset01" required=""> <label for="collections_comments">Comments</label>
                                </div><small class="form-text text-muted"></small>
                                <div class="invalid-feedback"> Please enter a valid Comment</div>
                              </div><!-- /.form-group -->

                             <!-- .form-group -->
                              <div class="form-group mb-4">
                                <div class="form-label-group">
                                 <input type="file" class="custom-file-input" name="collections_cert_scan" id="collections_cert_scan" value="Cert Scan" autocomplete="off" data-parsley-group="fieldset01" required="">
                                        <label class="custom-file-label" for="collections_cert_scan">Choose file</label>
                                    </div><small class="form-text text-muted"></small>
                                <div class="invalid-feedback"> Please select a valid file</div>
                              </div><!-- /.form-group -->

                              <hr class="mt-5">
                              <div class="d-flex">
                                
                              <button type="button" class="prev btn btn-secondary">Previous</button>
                               <button type="submit" class="submit btn btn-primary ml-auto" data-validate="agreement">Submit</button>
                             
                             
                                 

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
