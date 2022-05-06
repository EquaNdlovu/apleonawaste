<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
                  <div class="steps steps-" id="steps steps-" role="tablist">
                    <ul>
                      <!-- added style="pointer-events: none;" to disable the tab navigation -->
                      <li class="step" data-target="#test-l-1" style="pointer-events: none;">
                        <a href="#" class="step-trigger" tabindex="-1"><span class="step-indicator step-indicator-icon"><i class="oi oi-person"></i></span> <span class="d-none d-sm-inline">Customer</span></a>
                      </li>
                      <li class="step" data-target="#test-l-2" style="pointer-events: none;">
                        <a href="#" class="step-trigger" tabindex="-1"><span class="step-indicator step-indicator-icon"><i class="oi oi-account-login"></i></span> <span class="d-none d-sm-inline">Material</span></a>
                      </li>
                      <!-- /.hide costs and rebates-->
                      <li class="step" data-target="#test-l-3" style="pointer-events: none;">
                        <a href="#" class="step-trigger" tabindex="-1"><span class="step-indicator step-indicator-icon"><i class="oi oi-credit-card"></i></span> <span class="d-none d-sm-inline">Cost/Rebates</span></a>
                      </li>
                      <li class="step" data-target="#test-l-4" style="pointer-events: none;">
                        <a href="#" class="step-trigger" tabindex="-1"><span class="step-indicator step-indicator-icon"><i class="oi oi-account-login"></i></span> <span class="d-none d-sm-inline">Disposal</span></a>
                      </li>
                      <li class="step" data-target="#test-l-5" style="pointer-events: none;">
                        <a href="#" class="step-trigger" tabindex="-1"><span class="step-indicator step-indicator-icon"><i class="oi oi-check"></i></span> <span class="d-none d-sm-inline">Documents</span></a>
                      </li>
                    </ul>
                  </div><!-- /.steps -->
                </div><!-- /.card-header -->

                <!-- .card-body -->
                <div class="card-body">
                  <form id="stepper-form" name="stepperForm" action="<?php echo URLROOT; ?>/collections/add_IE" method="post" enctype="multipart/form-data">
                    <!-- .content -->
                    <div id="test-l-1" class="content dstepper-none fade">
                      <!-- fieldset -->
                      <fieldset>
                        <legend>Customer Details</legend>

                        <div class="d-flex">
                          <p></p><button type="button" class="next btn btn-primary ml-auto" data-validate="fieldset01">Next step</button>
                        </div><!-- /.d-flex -->

                        <?php if($_SESSION['doc_error'] == 'Documentation Error: File Already Exists') {

                            echo "<script type='text/javascript'>fileAlreadyExists();</script>";
                            $_SESSION['doc_error'] = '';

                        } elseif($_SESSION['doc_error'] == 'Documentation Error: File size is too large, 10MB Maximum') {

                            echo "<script type='text/javascript'>fileSizeError();</script>";
                            $_SESSION['doc_error'] = '';

                        } else {

                        }
                        ?>

                        <!-- .form-group -->
                        <div class="form-group mb-4">
                          <label class="control-label" for="collections_customer_country">Country</label>
                          <select name="collections_customer_country" id="collections_customer_country" data-toggle="selectpicker" data-width="100%">
                            <?php
                            $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
                            $sql = "SELECT waste_country_key, waste_country_name FROM wm_country ORDER BY waste_country_name ASC";
                            $result = mysqli_query($db, $sql);
                            //echo "<option value=0>Please Select</option>";
                            echo "<option value='" . $_SESSION['country'] . "'> " . $_SESSION['country'] . "</option>";
                            //while ($row = mysqli_fetch_array($result)) {
                            //   echo "<option value='" .$row['waste_country_name']."'> ".$row['waste_country_name'] . "</option>"; 
                            //   }
                            echo "</select>";
                            ?>
                        </div>
                        <!-- /.form-group -->


                        <!-- .form-group -->
                        <div class="form-group mb-4">
                          <div class="form-label-group">
                            <label class="control-label" for="collections_workorder">Work Order</label>
                            <input type="text" id="collections_workorder" name="collections_workorder" class="form-control" autocomplete="off" data-parsley-group="fieldset01">
                          </div>
                          <div class="invalid-feedback"> Please select a valid Order </div>
                        </div>
                        <!-- /.form-group -->

                        <!-- .form-group -->
                        <div class="form-group mb-4">
                          <div>
                          <label class="control-label" for="collections_customer_number">Customer</label>
                          <select id="collections_customer_number" name="collections_customer_number" data-toggle="selectpicker" data-width="100%" required="" data-parsley-group="fieldset01" onChange='getCustomerGroup(this.value); getCustomerSite(this.value); getWasteProducer(this.value); getCustomerAddress(this.value); makeFreeText();'>
                          <?php if($data['collections_customer_number']) { ?>
                          <option value="<?php echo $data['collections_customer_number'] ?>"><?php echo $data['collections_customer_number'] ?></option>
                          <?php } ?>

                            <?php
                            $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
                            if($_SESSION['customer_group'] !== '') {
                            $sql = "SELECT waste_customer_name FROM wm_customer WHERE waste_customer_group = '" . $_SESSION['customer_group'] . "'";
                            } else {
                            $sql = "SELECT waste_customer_name FROM wm_customer WHERE waste_customer_country = '" . $_SESSION['country'] . "'";
                            }
                            $result = mysqli_query($db, $sql);
                            //echo "<option value='" . $data['collections_customer_number'] . "'>". $data['collections_customer_number'] . "</option>";
                            echo "<option value=''>Please Select</option>";
                            while ($row = mysqli_fetch_array($result)) {
                              echo "<option value='" . $row['waste_customer_name'] . "'> " . $row['waste_customer_name'] . "</option>";
                            }
                            echo "</select>";
                            ?>
                            </div>
                            <div class="invalid-feedback"> Please select a Customer</div>
                        </div>
                        <!-- /.form-group -->


                        <!-- .form-group -->
                        <div class="form-group mb-4">
                          <label class="control-label" for="collections_customer_site">Site</label>
                          <div class="input-group">
                            <select id="collections_customer_site" name="collections_customer_site" data-toggle="selectpicker" data-live-search="true" data-width="100%" data-size="6" onChange='getWasteProducer(this.value); getCustomerAddress(this.value);'> 
                            <?php if($data['collections_customer_site']) { ?>
                               <option value="<?php echo $data['collections_customer_site'] ?>"><?php echo $data['collections_customer_site'] ?></option>
                            <?php } ?>
                            </select>
                          </div>
                        </div>

                        <!-- /.form-group -->

                        <!-- .form-group -->
                        <div class="form-group mb-4">
                          <label class="control-label" for="Customer_Waste_Producer">Waste Producer</label>
                          <select id="Customer_Waste_Producer" name="Customer_Waste_Producer" data-toggle="selectpicker" data-live-search="true" data-width="100%" data-size="6"  onChange='getCustomerAddress(this.value);'>
                          <?php if($data['Customer_Waste_Producer']) { ?>   
                             <option value="<?php echo $data['Customer_Waste_Producer'] ?>"><?php echo $data['Customer_Waste_Producer'] ?></option>
                          <?php } ?>
                          </select>
                        </div>
                        <!-- /.form-group -->



                        <!-- .form-group -->
                        <div class="form-group mb-4">
                          <label class="control-label" for="collections_address">Address / Region</label>
                          <select id="collections_address" name="collections_address" data-toggle="selectpicker" data-live-search="true" data-width="100%" data-size="6">
                          <?php if($data['collections_address']) { ?>
                            <option value="<?php echo $data['collections_address'] ?>"><?php echo $data['collections_address'] ?></option>
                          <?php } ?>
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
                        <div class="form-group mb-4" style="display: none;">
                          <div class="form-label-group">
                            <label class="control-label" for="Order_Status">Order Status</label>
                            <select id="Order_Status" name="Order_Status" class="form-control" autocomplete="off" data-parsley-group="fieldset01" value="Order_Status" required="">
                              <option value="Complete">Complete</option>
                              <option value="In Progress">In Progress</option>
                            </select>
                          </div><small class="form-text text-muted"></small>
                          <div class="invalid-feedback"> Please select a valid Order Status</div>
                        </div><!-- /.form-group -->


                        <!--  .form-group -->
                        <div class="invisible">
                          <!--  .start invisible -->
                          <div class="form-group mb-4">
                            <label class="control-label" for="collections_customer">Overall Customer</label>
                            <select class="custom-select" id="collections_customer" name="collections_customer" data-width="100%">

                            </select>
                          </div>
                        </div><!--  .end invisible -->
                        <!-- /.form-group -->


                        <!--  .form-group -->

                        <div class="invisible">
                          <div class="form-group mb-4">
                            <label class="control-label" for="Transaction_Type">Customer Ref / Transaction Type</label>
                            <select name="Transaction_Type" data-toggle="selectpicker" data-width="100%">
                              <option value="NA"> Please Select... </option>
                              <option value="Waste">Waste</option>
                              <option value="Transport">Transport</option>
                              <option value="Manpower">Manpower</option>
                              <option value="Consumables">Consumables</option>
                            </select>
                          </div>
                        </div>
                        <!-- /.form-group -->


                        <div class="d-flex">
                          <p></p><button type="button" class="next btn btn-primary btn-lg ml-auto" data-validate="fieldset01">Next step</button>
                        </div><!-- /.d-flex -->
                      </fieldset><!-- /fieldset -->
                    </div><!-- /.content -->
                    <!-- .content -->


                    <div id="test-l-2" class="content dstepper-none fade">
                      <!-- fieldset -->
                      <fieldset>

                        <legend>Material</legend> <!-- .row -->

                        <div class="d-flex">
                        <!-- style="margin:auto" -->
                            <button type="button" class="prev btn btn-secondary">Previous</button> <button type="button" class="next btn btn-primary ml-auto" data-validate="fieldset02">Next step</button>
                        </div>
                        <br><br>

                        <div class="row" style="display:none">

                          <div class="ml-3">
                            <div class="form-group">
                            <label class="d-block">Please check the box if waste is hazardous</label>
                            <div class="custom-control custom-control-inline custom-checkbox">
                            <input type="checkbox" value="" id="hazardous_checkbox" name="hazardous_checkbox" class="custom-control-input" onchange="showHazardousCheckboxFields()"><label class="custom-control-label" for="hazardous_checkbox"></label>
                            </div>
                            </div>
                          </div><!-- /grid column -->
                        </div>

                        <div class="row">

                          <!-- grid column -->
                          <!-- <div class="col-md-6 mb-4">
                            <div class="form-label-group">
                              <label class="control-label" for="Material_Description">Material Description</label>

                              <select id="Material_Description" name="Material_Description" class="form-control" autocomplete="off" data-parsley-group="fieldset02" value="Material_Description" required="">
                                  <option value="">Please select</option>
                                <optgroup label="Recycling">
                                  <option value="Wood">Wood</option>
                                  <option value="Metal">Metal</option>
                                  <option value="Mixed">Mixed</option>
                                  <option value="Plastics">Plastic</option>
                                  <option value="WEE Items">WEE Items</option>
                                  <option value="Foams">Foams</option>
                                  <option value="Fabrics">Fabrics</option>
                                </optgroup>
                                <optgroup label="Charity Donations">
                                  <option value="Fabrics">Chairs</option>
                                  <option value="Fabrics">Desks</option>
                                  <option value="Fabrics">Filing Cabinets</option>
                                  <option value="Fabrics">Pedestals</option>
                                  <option value="Fabrics">Monitor Stands</option>
                                </optgroup>
                                <optgroup label="Hazardous">
                                  <option value="Hazardous">Hazardous</option>
                                  <option value="Test 1">Test 1</option>
                                </optgroup>

                              </select>
                            </div>
                            <div class="invalid-feedback"> Valid material description is required. </div>
                          </div> -->
                          <!-- /grid column -->

                          <!-- grid column -->
                          <div class="col-md-6 mb-4" id="IE_MD">
                            <div class="form-group">
                              <label class="control-label" for="Material_Description">Material Description</label>
                              <select id="Material_Description" name="Material_Description" class="selectpicker" data-live-search="true" data-width="100%" data-size="6" data-parsley-group="fieldset02">
                              <?php if($data['Material_Description']) { ?>
                              <option value="<?php echo $data['Material_Description'] ?>"><?php echo $data['Material_Description'] ?></option>
                              <?php } ?>
                              <?php
                              $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
                              $sql = "SELECT description FROM lookup_material_description WHERE customer = '" . $_SESSION['customer_group'] . "'";
                              $result = mysqli_query($db, $sql);
                              echo "<option value=''>Please Select</option>";
                              while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $row['description'] . "'> " . $row['description'] . "</option>";
                              }
                              echo "</select>";
                              ?>
                              </div>
                            <div class="invalid-feedback"> Valid material description is required. </div>
                          </div>
                          <!-- /grid column -->

                          <!-- grid column -->
                          <div class="col-md-6 mb-4" id="Stryker_MD">
                            <div class="form-group" id="Stryker_MD_Content">
                            <label class="control-label" for="Material_Description">Material Description</label>
                              <input type="text" id="Material_Description" class="form-control" name="Material_Description" value="<?php echo $data['Material_Description'] ?>" data-parsley-group="fieldset02">
                            </div>
                            <div class="invalid-feedback"> Valid Material Description is required. </div>
                          </div>
                          <!-- /grid column -->


                        <!-- grid column -->
                        <div class="col-md-6 mb-4" id="IE_MAD">
                            <div class="form-group">
                              <label class="control-label" for="Material_Detail">Material Analysis Detail</label>
                              <select id="Material_Detail" name="Material_Detail" class="selectpicker" data-live-search="true" data-width="100%" data-size="6" data-parsley-group="fieldset02">
                              <?php if($data['Material_Detail']) { ?>
                              <option value="<?php echo $data['Material_Detail'] ?>"><?php echo $data['Material_Detail'] ?></option>
                              <?php } ?>
                              <?php
                              $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
                              $sql = "SELECT description FROM lookup_material_analysis_detail WHERE customer = '" . $_SESSION['customer_group'] . "'";
                              $result = mysqli_query($db, $sql);
                              echo "<option value=''>Please Select</option>";
                              while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $row['description'] . "'> " . $row['description'] . "</option>";
                              }
                              echo "</select>";
                              ?>
                              </div>
                            <div class="invalid-feedback"> Valid Material Analysis Detail is required. </div>
                          </div>
                          <!-- /grid column -->

                          <!-- grid column -->
                          <div class="col-md-6 mb-4" id="Stryker_MAD">
                            <div class="form-group" id="Stryker_MAD_Content">
                            <label class="control-label" for="Material_Detail">Material Analysis Detail</label>
                              <input type="text" id="Material_Detail" class="form-control" name="Material_Detail" value="<?php echo $data['Material_Detail'] ?>" data-parsley-group="fieldset02">
                            </div>
                            <div class="invalid-feedback"> Valid Material Detail is required. </div>
                          </div>
                          <!-- /grid column -->
                          </div>

                        <div class="row">
                          <!-- grid column -->
                          <div class="col-md-6 mb-4" id="IE_MC">
                          <div class="form-group">
                              <label class="control-label" for="Material_Class">Material Class</label>
                              <select id="Material_Class" name="Material_Class" class="selectpicker" data-live-search="true" data-width="100%" data-size="6" data-parsley-group="fieldset02" onchange="showHazardousWasteFields()">
                              <?php if($data['Material_Class']) { ?>
                              <option value="<?php echo $data['Material_Class'] ?>"><?php echo $data['Material_Class'] ?></option>
                              <?php } ?>
                              <?php
                              $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
                              $sql = "SELECT description FROM lookup_material_class WHERE customer = '" . $_SESSION['customer_group'] . "'";
                              $result = mysqli_query($db, $sql);
                              echo "<option value=''>Please Select</option>";
                              while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $row['description'] . "'> " . $row['description'] . "</option>";
                              }
                              echo "</select>";
                              ?>
                              </div>
                            <div class="invalid-feedback"> Valid Material Class is required. </div>
                          </div>
                          <!-- /grid column -->

                          <!-- grid column -->
                          <div class="col-md-6 mb-4" id="Stryker_MC">
                            <div class="form-group" id="Stryker_MC_Content">
                            <label class="control-label" for="Material_Class">Class</label>
                              <input type="text" id="Material_Class" class="form-control" name="Class" value="<?php echo $data['Material_Class'] ?>" data-parsley-group="fieldset02">
                            </div>
                            <div class="invalid-feedback"> Valid Material Class is required. </div>
                          </div>
                          <!-- /grid column -->

                            <!-- grid column -->
                            <div class="col-md-6 mb-4">
                              <label class="control-label" for="Indication_of_Danger">Indication of Danger</label>
                              <div class="input-group">
                              <select id="Indication_of_Danger" name="Indication_of_Danger" class="form-control" autocomplete="off" data-parsley-group="fieldset02" value="Indication_of_Danger" required="">
                              <?php if($data['Indication_of_Danger']) { ?>
                                <option value="<?php echo $data['Indication_of_Danger'] ?>"><?php echo $data['Indication_of_Danger'] ?></option>
                              <?php } ?>
                                <option value="N">N</option>
                                <option value="Y">Y</option>

                              </select>
                            </div>
                          </div> 
                        </div>
                        <!-- /grid column -->


                        <div class="row">
                          <!-- grid column -->
                          <div class="col-md-6 mb-4" style="display:none">
                            <div class="form-label-group">
                              <input type="text" id="Material_Description_Alt" class="form-control" name="Material_Description_Alt" value="<?php echo $data['Material_Description_Alt'] ?>" data-parsley-group="fieldset02"> <label for="Material_Description_Alt">Material Description (Free Text)</label>
                            </div>
                            <div class="invalid-feedback"> Valid Material Description is required. </div>
                          </div><!-- /grid column -->
                          <!-- grid column -->
                          <div class="col-md-6 mb-4" style="display:none">
                            <div class="form-label-group">
                              <input type="text" id="Material_Detail_Alt" class="form-control" name="Material_Detail_Alt" value="<?php echo $data['Material_Detail_Alt'] ?>" data-parsley-group="fieldset02"> <label for="Material_Detail_Alt">Material Detail (Free Text)</label>
                            </div>
                            <div class="invalid-feedback"> Valid Material Detail is required. </div>
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
                        </div>
                        <!-- /.column -->

                        <div class="row">
                          <!-- grid column -->
                          <div class="col-md-6 mb-4">

                            <div class="form-label-group">
                            <?php if($data['Quantity']) { ?>
                              <input type="number" value="<?php echo $data['Quantity'] ?>" step=".01" id="Quantity" class="form-control" name="Quantity" data-parsley-group="fieldset02"> <label for="Quantity">Quantity - Weights</label>
                            <?php } else { ?>
                              <input type="number" value="0" step=".01" id="Quantity" class="form-control" name="Quantity" data-parsley-group="fieldset02"> <label for="Quantity">Quantity - Weights</label>
                            <?php } ?>
                            </div>
                            <div class="invalid-feedback"> Valid Quantity is required. </div>
                          </div>
                          <!-- /grid column -->

                          <!-- grid column -->
                          <div class="col-md-6 mb-4">
                            <div class="form-label-group">
                              <!-- <input type="text" id="Unit_of_Measure" class="form-control" name="Unit_of_Measure" value="" data-parsley-group="fieldset02"> <label for="Unit_of_Measure">Unit of Measure</label> -->
                              <label class="control-label" for="Unit_of_Measure">Unit of Measure</label>
                              <select id="Unit_of_Measure" name="Unit_of_Measure" class="form-control" autocomplete="off" data-parsley-group="fieldset02">
                              <?php if($data['Unit_of_Measure']) { ?>
                                <option value="<?php echo $data['Unit_of_Measure'] ?>"><?php echo $data['Unit_of_Measure'] ?></option>
                              <?php } ?>
                                <option value="">Please select</option>
                                <option value="KG">KG</option>
                                <option value="Tonnes">Tonnes</option>
                                <option value="Litres">Litres</option>

                              </select>
                            </div>
                            <div class="invalid-feedback"> Valid Unit of Measure is required. </div>
                          </div><!-- /grid column -->
                          
                        </div><!-- /.row -->


                        <div class="row">
                          <!-- grid column -->



                          <div class="col-md-6 mb-4">
                            <div class="form-label-group">
                            <?php if($data['collections_quantity_not_kg']) { ?>
                              <input type="number" value="<?php echo $data['collections_quantity_not_kg'] ?>" step=".01" id="collections_quantity_not_kg" class="form-control" name="collections_quantity_not_kg" data-parsley-group="fieldset02"> <label for="collections_quantity_not_kg">Quantity other than Weight (UN,PC,AU,Pallet,HR)</label>
                            <?php } else { ?>
                              <input type="number" value="0" step=".01" id="collections_quantity_not_kg" class="form-control" name="collections_quantity_not_kg" data-parsley-group="fieldset02"> <label for="collections_quantity_not_kg">Quantity other than Weight (UN,PC,AU,Pallet,HR)</label>
                            <?php } ?>
                            </div>
                            <div class="invalid-feedback"> Valid Quantity is required. </div>
                          </div><!-- /grid column -->

                          <div class="col-md-6 mb-4">
                            <div class="form-label-group">
                              <input type="text" id="collections_not_kg_UOM" class="form-control" name="collections_not_kg_UOM" value="<?php echo $data['collections_not_kg_UOM'] ?>" data-parsley-group="fieldset02"> <label for="collections_not_kg_UOM">Unit of Measure</label>
                            </div>
                            <div class="invalid-feedback"> Valid UOM is required. </div>
                          </div><!-- /grid column -->
                        </div><!-- /.row -->

                        <div class="row">
                          <!-- grid column -->
                          <div class="col-md-6 mb-4" id="Material_Packaging_div" style="display:none">
                            <div class="form-label-group">
                              <input type="text" id="Material_Packaging_Group" class="form-control" name="Material_Packaging_Group" data-parsley-group="fieldset02"> <label for="Material Packaging Group">Material Packaging Group</label>
                            </div>
                            <div class="invalid-feedback"> Valid Material Packaging Group is required. </div>
                          </div><!-- /grid column -->
                          <!-- grid column -->
                          <div class="col-md-6 mb-4" id="Material_UN_Code_div" style="display:none">
                            <div class="form-label-group">
                              <input type="text" id="Material_UN_Code" class="form-control" name="Material_UN_Code" data-parsley-group="fieldset02"><label for="Material_UN_Code">Material UN Code</label>
                            </div>
                            <div class="invalid-feedback"> Valid Material UN Code is required. </div>
                          </div>
                          <!-- column -->

                        </div><!-- /.row -->

                        <div class="row">
                          <!-- grid column -->
                        <?php if ($_SESSION['customer_group'] == 'Stryker Ireland') { ?>
                        <div class="col-md-6 mb-4" style="display:none">
                        <?php } else { ?>
                        <div class="col-md-6 mb-4"> 
                        <?php } ?>
                            <div class="form-label-group">
                              <input type="text" id="Container_Quantity" class="form-control" name="Container_Quantity" value="<?php echo $data['Container_Quantity'] ?>" data-parsley-group="fieldset02"> <label for="Container_Quantity">Packaging Container Units</label>
                            </div>
                            <div class="invalid-feedback"> Valid Packaging Container Units is required. </div>
                          </div>
                          <!-- /grid column -->
                          <!-- grid column -->
                          <div class="col-md-6 mb-4">
                            <div class="form-label-group">
                              <input type="text" id="Container_Type" class="form-control" name="Container_Type" value="<?php echo $data['Container_Type'] ?>" data-parsley-group="fieldset02"> <label for="Container_Type">Packaging Container Description</label>
                            </div>
                            <div class="invalid-feedback"> Valid Packaging Container Description is required. </div>
                          </div><!-- /grid column -->
                        </div><!-- /.row -->

                        <?php if ($_SESSION['customer_group'] == 'Abbott Ireland') { ?>
                        <div class="row">
                        <?php } else { ?>
                        <div class="row" style="display:none"> 
                        <?php } ?>
                        <!-- .form-group -->
                        <div class="col-md-6 mb-4">
                          <label class="control-label" for="ENVision_Description">ENVision Description</label>
                          <select name="ENVision_Description" data-toggle="selectpicker" data-width="100%" data-live-search="true" data-size="6">
                          <?php if($data['ENVision_Description']) { ?>
                              <option value="<?php echo $data['ENVision_Description'] ?>"><?php echo $data['ENVision_Description'] ?></option>
                              <?php } ?>
                              <?php
                              $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
                              $sql = "SELECT description FROM lookup_envision_description WHERE customer = '" . $_SESSION['customer_group'] . "'";
                              $result = mysqli_query($db, $sql);
                              echo "<option value=''>Please Select</option>";
                              while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $row['description'] . "'> " . $row['description'] . "</option>";
                              }
                              echo "</select>";
                              ?>
                        </div>
                        <!-- /.form-group -->
                        <div class="col-md-6 mb-4">
                          <label class="control-label" for="ENVision_Disposal">ENVision Disposal Route</label>
                          <select name="ENVision_Disposal" data-toggle="selectpicker" data-width="100%" data-size="6">
                          <?php if($data['ENVision_Disposal']) { ?>
                                <option <?php echo $data['ENVision_Disposal'] ?>></option>
                              <?php } ?>
                              <option value="">Please Select</option>
                              <option value="Recycled">Recycled</option>
                              <option value="Incinerated with Energy Recovery">Incinerated with Energy Recovery</option>
                              <option value="Beneficial Use">Beneficial Use</option>
                              </select>
                        </div>
                        <!-- /.form-group -->
                        </div>

                        <?php if ($_SESSION['customer_group'] == 'Abbott Ireland') { ?>
                        <div class="row">
                        <?php } else { ?>
                        <div class="row" style="display:none"> 
                        <?php } ?>
                        <!-- .form-group -->
                        <div class="col-md-6 mb-4">
                        <label class="control-label" for="weights_confirmed">Weights Confirmed?</label>
                          <select name="weights_confirmed" data-toggle="selectpicker" data-width="100%" data-size="6">
                          <?php if($data['weights_confirmed']) { ?>
                                <option value=<?php echo $data['weights_confirmed'] ?>></option>
                              <?php } ?>
                              <option value="">Please Select</option>
                              <option value="Confirmed">Confirmed</option>
                              <option value="Not Confirmed">Not Confirmed</option>
                              </select>
                        </div>
                        <!-- /.form-group -->
                        <div class="col-md-6 mb-4">
                          <label class="control-label" for="waste_type">Waste Type</label>
                          <select name="waste_type" data-toggle="selectpicker" data-width="100%" data-size="6">
                          <?php if($data['waste_type']) { ?>
                                <option value=<?php echo $data['waste_type'] ?>></option>
                              <?php } ?>
                              <option value="">Please Select</option>
                              <option value="Baseline">Baseline</option>
                              <option value="Project">Project</option>
                              </select>
                        </div>
                        <!-- /.form-group -->
                        </div>

                          <hr class="mt-5">
                          <div class="d-flex">
                            <button type="button" class="prev btn btn-secondary">Previous</button> <button type="button" class="next btn btn-primary ml-auto" data-validate="fieldset02">Next step</button>
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

                            <select id="Currency" name="Currency" class="form-control" autocomplete="off" data-parsley-group="fieldset03" value="Currency" required="">
                            <?php if($data['Currency']) { ?>
                              <option value="<?php echo $data['Currency'] ?>"><?php echo $data['Currency'] ?></option>
                            <?php } ?>
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
                            <input type="number" value= "<?php echo $data['Total_Cost'] ?>" step=".01" id="Total_Cost" class="form-control" name="Total_Cost" data-parsley-group="fieldset03" readonly="readonly"> <label for="Total_Cost">Total Cost</label>
                          </div>
                          <div class="invalid-feedback"> Valid Total Cost is required. </div>
                        </div><!-- /grid column -->


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

                        <div class="d-flex">
                          <button type="button" class="prev btn btn-secondary">Previous</button>
                          <button type="button" class="next btn btn-primary ml-auto" data-validate="fieldset04">Next step</button>
                        </div>
                        <br><br>

                        <div class="row">
                          <!-- grid column -->
                          <div class="col-md-6 mb-4">
                            <label class="control-label" for="Waste_Vendor">Waste Broker</label>
                            <select name="Waste_Vendor" data-toggle="selectpicker" data-live-search="true" data-width="100%" data-size="6">
                            <?php if($data['Waste_Vendor']) { ?>
                            <option value="<?php echo $data['Waste_Vendor'] ?>"><?php echo $data['Waste_Vendor'] ?></option>
                            <?php } ?>
                              <?php
                              $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
                              $sql = "SELECT waste_broker_name FROM waste_broker WHERE waste_broker_country = '" . $_SESSION['country'] . "' ORDER BY waste_broker_name ASC";
                              $result = mysqli_query($db, $sql);
                              echo "<option value=''>Please Select</option>";
                              while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $row['waste_broker_name'] . "'> " . $row['waste_broker_name'] . "</option>";
                              }
                              echo "</select>";
                              ?>

                              <div class="invalid-feedback"> Valid Waste Broker is required. </div>
                          </div><!-- /grid column -->


                          <!-- grid column -->
                          <div class="col-md-6 mb-4">
                            <label class="control-label" for="Waste_Collector">Waste Collector</label>
                            <select name="Waste_Collector" data-toggle="selectpicker" data-live-search="true" data-width="100%" data-size="6">
                            <?php if($data['Waste_Collector']) { ?>
                            <option value="<?php echo $data['Waste_Collector'] ?>"><?php echo $data['Waste_Collector'] ?></option>
                            <?php } ?>
                              <?php
                              $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
                              $sql = "SELECT waste_collector_name FROM waste_collector WHERE waste_collector_country = '" . $_SESSION['country'] . "' ORDER BY waste_collector_name ASC";
                              $result = mysqli_query($db, $sql);
                              echo "<option value=''>Please Select</option>";
                              while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $row['waste_collector_name'] . "'> " . $row['waste_collector_name'] . "</option>";
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
                            <select name="Treatment_Facility" data-toggle="selectpicker" data-live-search="true" data-width="100%" data-size="6">
                            <?php if($data['Treatment_Facility']) { ?>
                            <option value="<?php echo $data['Treatment_Facility'] ?>"><?php echo $data['Treatment_Facility'] ?></option>
                            <?php } ?>
                              <?php
                              $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
                              $sql = "SELECT treatment_facility_name FROM treatment_facility WHERE treatment_facility_country = '" . $_SESSION['country'] . "' ORDER BY treatment_facility_name ASC";
                              $result = mysqli_query($db, $sql);
                              echo "<option value=''>Please Select</option>";
                              while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $row['treatment_facility_name'] . "'> " . $row['treatment_facility_name'] . "</option>";
                              }
                              echo "</select>";
                              ?>


                              <div class="invalid-feedback"> Valid Treatment Facility is required. </div>
                          </div><!-- /grid column -->
                          <!-- grid column -->
                          <div class="col-md-6 mb-4">
                            <label class="control-label" for="RD_Codes_Treatment">RD Codes</label>
                            <select id="RD_Codes_Treatment" name="RD_Codes_Treatment" data-toggle="selectpicker" data-width="100%" data-live-search="true" data-size="6" onchange="showCharityDonated()">
                            <?php if($data['RD_Codes_Treatment']) { ?>
                             <option value="<?php echo $data['RD_Codes_Treatment'] ?>"><?php echo $data['RD_Codes_Treatment'] ?></option>
                            <?php } ?>
                              <?php
                              $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
                              $sql = "SELECT rd_name FROM recovery_disposal_rd_codes ORDER BY rd_name ASC";
                              $result = mysqli_query($db, $sql);
                              echo "<option value=''>Please Select</option>";
                              while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $row['rd_name'] . "'> " . $row['rd_name'] . "</option>";
                              }
                              echo "</select>";
                              ?>
                              <div class="invalid-feedback"> Valid RD Codes Treatment is required. </div>
                          </div><!-- /grid column -->
                        </div><!-- /.row -->

                        <div class="row">

                          <!-- grid column -->
                          <div class="col-md-6 mb-4" id="IE_TMD">
                            <div class="form-group">
                              <label class="control-label" for="Treatment_Method_Detail">Treatment Method Detail</label>
                              <select id="Treatment_Method_Detail" name="Treatment_Method_Detail" class="selectpicker" data-live-search="true" data-width="100%" data-size="6" data-parsley-group="fieldset04" value="">
                              <?php if($data['Treatment_Method_Detail']) { ?>
                              <option value="<?php echo $data['Treatment_Method_Detail'] ?>"><?php echo $data['Treatment_Method_Detail'] ?></option>
                              <?php } ?>
                              <?php
                              $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
                              $sql = "SELECT description FROM lookup_treatment_method_detail WHERE customer = '" . $_SESSION['customer_group'] . "'";
                              $result = mysqli_query($db, $sql);
                              echo "<option value=''>Please Select</option>";
                              while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $row['description'] . "'> " . $row['description'] . "</option>";
                              }
                              echo "</select>";
                              ?>
                              </div>
                            <div class="invalid-feedback"> Valid material description is required. </div>
                          </div>
                          <!-- /grid column -->

                          <!-- grid column -->
                          <div class="col-md-6 mb-4" id="Stryker_TMD">
                            <div class="form-group" id="Stryker_TMD_Content">
                            <label class="control-label" for="Treatment_Method_Detail">Treatment Method Detail</label>
                              <input type="text" id="Treatment_Method_Detail" class="form-control" name="Treatment_Method_Detail" value="<?php echo $data['Treatment_Method_Detail'] ?>" data-parsley-group="fieldset02">
                            </div>
                            <div class="invalid-feedback"> Valid Treatment Method Detail is required. </div>
                          </div>
                          <!-- /grid column -->

                          <!-- grid column -->
                          <div class="col-md-6 mb-4" id="Charity_Donated_div">
                          <label class="control-label" for="charity_donated_to">Charity Donated To</label>
                            <div class="form-group">
                              <select id="charity_donated_to" name="charity_donated_to" class="form-control" autocomplete="off" data-parsley-group="fieldset04">
                              <option value="<?php echo $data['charity_donated_to'] ?>"><?php echo $data['charity_donated_to'] ?></option>
                                <option value="">Please select</option>
                                <option value="St. Barnardos">St. Barnardos</option>
                                <option value="St. Vincents">St. Vincents</option>

                              </select>
                            </div>
                            <div class="invalid-feedback"> Valid Charity is required. </div>
                          </div>
                        </div><!-- /.row -->




                        <hr class="mt-5">
                        <div class="d-flex">
                          <button type="button" class="prev btn btn-secondary">Previous</button>
                          <button type="button" class="next btn btn-primary ml-auto" data-validate="fieldset04">Next step</button>
                        </div>
                      </fieldset><!-- /fieldset -->
                    </div><!-- /.content -->


                    <!-- .content -->
                    <div id="test-l-5" class="content dstepper-none fade">
                      <!-- fieldset -->
                      <fieldset>
                        <legend>Documents</legend> <!-- .card -->

                        <div class="d-flex">

                        <button type="button" class="prev btn btn-secondary">Previous</button>

                        </div>
                        <br><br>

                          <!-- grid column -->
                          <div class="form-group mb-4">
                            <div class="form-group">
                            <label class="control-label" for="Certificate_Number">Certificate Number</label>
                              <input type="text" id="Certificate_Number" class="form-control" name="Certificate_Number" value="<?php echo $data['Certificate_Number'] ?>" data-parsley-group="fieldset02">
                            </div>
                            <div class="invalid-feedback"> Valid Certificate Number is required. </div>
                          </div>

                        <div class="form-group mb-4">
                          <div class="form-label-group">
                            <input type="text" id="colletions_WTF_number" name="colletions_WTF_number" class="form-control" value="<?php echo $data['colletions_WTF_number'] ?>" autocomplete="off" data-parsley-group="fieldset05"> <label for="colletions_WTF_number">WTF Number</label>
                          </div><small class="form-text text-muted"></small>
                          <div class="invalid-feedback"> Please select a valid WTF Number </div>
                        </div><!-- /.form-group -->

                        <div class="form-group mb-4">
                          <div class="form-label-group">
                            <input type="text" id="TFS_Number" name="TFS_Number" class="form-control" value="<?php echo $data['TFS_Number'] ?>" autocomplete="off" data-parsley-group="fieldset05"> <label for="TFS_Number">TFS Number</label>
                          </div><small class="form-text text-muted"></small>
                          <div class="invalid-feedback"> Please select a valid TFS Number </div>
                        </div><!-- /.form-group -->

                        <!-- .form-group -->
                        <!-- <div class="form-group mb-4">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="collections_cert_scan" id="collections_cert_scan" multiple>
                            <label class="custom-file-label" for="collections_cert_scan">Choose files</label>
                          </div>
                        </div> -->

                        <!-- grid column -->
                        <div class="form-group mb-4">
                          <label for="collections_comments">Comments</label>
                          <textarea class="form-control" id="collections_comments" name="collections_comments" placeholder="Enter any additional comments here" rows="3"><?php echo $data['collections_comments'] ?></textarea>
                        </div><!-- /grid column -->

                        <?php echo "Documentation:" ?>
                        <div class="custom-file" id="customFile">
                            <input type="file" class="custom-file-input <?php echo (!empty($data['collections_cert_scan_err'])) ? 'is-invalid' : ''; ?>" id="file" name="file[]" aria-describedby="fileHelp" multiple>
                            <label class="custom-file-label" for="file">
                                Select file...
                            </label>
                            <span class="invalid-feedback"><?php echo $data['collections_cert_scan_err']; ?></span>
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
                    <strong>Congrats!</strong> You see the submit feedback.
                  </div>
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
  require APPROOT . '/views/inc/sweetalerts.js'; 
  ?>