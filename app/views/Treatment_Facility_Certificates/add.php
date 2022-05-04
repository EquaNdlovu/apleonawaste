<?php
require APPROOT . '/views/inc/sweetalerts.js';
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

                <a href="<?php echo URLROOT; ?>/Treatment_Facility_Certificates" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
                <div class="card card-body bg-light mt-5">
                    <h2>Add Permit or License</h2>
                    <!--<button id=demo onclick="partyTime()">Party Time</button>-->
                    <p>Attach a Permit or License with this form</p>
                    <form action="<?php echo URLROOT; ?>/Treatment_Facility_Certificates/add" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="control-label" for="treatment_facility_certificates_facility_key">Treatment Facility:</label>&ensp;<span class="badge badge-danger">Required</span>
                            <select name="treatment_facility_certificates_facility_key" class="<?php echo (!empty($data['treatment_facility_certificates_facility_key_err'])) ? 'is-invalid' : ''; ?>" data-toggle="selectpicker" data-live-search="true" data-width="100%">
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
                              <span class="invalid-feedback"><?php echo $data['treatment_facility_certificates_facility_key_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="treatment_facility_certificates_date">Expiry Date: <sup></sup></label>
                            <input type="date" name="treatment_facility_certificates_date" class="form-control form-control-lg <?php echo (!empty($data['treatment_facility_certificates_date_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['treatment_facility_certificates_date']; ?>">
                            <span class="invalid-feedback"><?php echo $data['treatment_facility_certificates_date_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="treatment_facility_certificates_customer">Customer: <sup>*</sup></label>
                            <input type="text" name="treatment_facility_certificates_customer" class="form-control form-control-lg <?php echo (!empty($data['treatment_facility_certificates_customer_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $_SESSION['customer_group']; ?>" readonly>
                            <span class="invalid-feedback"><?php echo $data['treatment_facility_certificates_customer_err']; ?></span>
                        </div>
                        <div class="form-group" style="display:none">
                            <label for="treatment_facility_certificates_country">Country: <sup>*</sup></label>
                            <input type="text" name="treatment_facility_certificates_country" class="form-control form-control-lg <?php echo (!empty($data['treatment_facility_certificates_country_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $_SESSION['country']; ?>" readonly>
                            <span class="invalid-feedback"><?php echo $data['treatment_facility_certificates_country_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="treatment_facility_certificates_owner">Owner (e-mail address for notifications): <sup>*</sup></label>
                            <input type="text" name="treatment_facility_certificates_owner" class="form-control form-control-lg <?php echo (!empty($data['treatment_facility_certificates_owner_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['treatment_facility_certificates_owner']; ?>">
                            <span class="invalid-feedback"><?php echo $data['treatment_facility_certificates_owner_err']; ?></span>
                        </div>
                        <?php echo "Documentation:" ?>
                        <div class="custom-file" id="customFile">
                                <input type="file" class="custom-file-input <?php echo (!empty($data['treatment_facility_certificates_docs_err'])) ? 'is-invalid' : ''; ?>" id="file" name="file[]" aria-describedby="fileHelp" multiple>
                                <label class="custom-file-label" for="file">
                                    Select file...
                                </label>
                                <span class="invalid-feedback"><?php echo $data['treatment_facility_certificates_docs_err']; ?></span> 
                                </div>
                                <br><br>
                        <input type="submit" name="submit" class="btn btn-success" value="Submit">
                    </form>


                </div><!-- /.page-section -->
            </div><!-- /.page-inner -->
        </div><!-- /.page -->
    </div><!-- .app-footer -->


    <?php
    require APPROOT . '/views/inc/footer.php';
    ?>