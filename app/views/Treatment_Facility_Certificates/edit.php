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
                    <h2>Edit License or Permit</h2>
                    <form action="<?php echo URLROOT; ?>/Treatment_Facility_Certificates/edit/<?php echo $data['treatment_facility_certificates_key']; ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="treatment_facility_certificates_key">Treatment Facility Certificate Key: <sup>*</sup></label>
                            <input type="text" name="treatment_facility_certificates_key" readonly="readonly" class="form-control form-control-lg <?php echo (!empty($data['treatment_facility_certificates_key_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['treatment_facility_certificates_key']; ?>">
                            <span class="invalid-feedback"><?php echo $data['treatment_facility_certificates_key_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="treatment_facility_certificates_facility_key">Treatment Facility:</label>
                            <select name="treatment_facility_certificates_facility_key" data-toggle="selectpicker" data-live-search="true" data-width="100%">
                              <?php
                              echo "<option value='" . $data['treatment_facility_certificates_facility_key'] . "'>". $data['treatment_facility_certificates_facility_key'] . "</option>";
                              $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
                              $sql = "SELECT treatment_facility_name FROM treatment_facility WHERE treatment_facility_country = '" . $_SESSION['country'] . "' ORDER BY treatment_facility_name ASC";
                              $result = mysqli_query($db, $sql);
                              echo "<option value=0>Please Select</option>";
                              while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $row['treatment_facility_name'] . "'>" . $row['treatment_facility_name'] . "</option>";
                              }
                              echo "</select>";
                              ?>
                              <div class="invalid-feedback"> Valid Treatment Facility is required. </div>
                        </div>
                        <div class="form-group">
                            <label for="treatment_facility_certificates_date">Date: <sup>*</sup></label>
                            <input type="text" name="treatment_facility_certificates_date" class="form-control form-control-lg <?php echo (!empty($data['treatment_facility_certificates_date_err'])) ? 'is-invalid' : ''; ?>" data-toggle="flatpickr" data-alt-input="true" data-alt-format="F j, Y" data-date-format="Y-m-d" value="<?php echo $data['treatment_facility_certificates_date']; ?>">
                            <span class="invalid-feedback"><?php echo $data['treatment_facility_certificates_date_err']; ?></span>
                        </div>
                        <div>
                        <?php echo "Documentation:" ?>
                            <div class="custom-file" id="customFile">
                                <input type="file" class="custom-file-input <?php echo (!empty($data['treatment_facility_certificates_docs_err'])) ? 'is-invalid' : ''; ?>" id="file" name="file[]" aria-describedby="fileHelp" multiple>
                                <label class="custom-file-label" for="file">
                                    Select file...
                                </label>
                                <span class="invalid-feedback"><?php echo $data['treatment_facility_certificates_docs_err']; ?></span> 
                            </div>
                            <br>
                            <?php
                            $TFCKey = $data['treatment_facility_certificates_key'];
                            $conn = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
                            $query3 = "SELECT file_name FROM tfc_docs WHERE treatment_facility_certificates_key='$TFCKey'";
                            $run3 = mysqli_query($conn, $query3);
                            $rows = mysqli_fetch_all($run3);
                                foreach ($rows as $row) { ?>
                                 <div>
                                <a href="<?php echo URLROOT; ?>/Treatment_Facility_Certificates/download?file=<?php echo current($row) ?>">Download <?php echo current($row) ?></a>
                                <a class="btn btn-sm btn-icon btn-secondary far fa-trash-alt" href="<?php echo URLROOT; ?>/Treatment_Facility_Certificates/delete_file?key=<?php echo $TFCKey?>&file=<?php echo current($row)?>" onclick="confirmation(event)"></a>
                                <!-- <a class="btn btn-sm btn-icon btn-secondary" href="delete/" onclick="confirmation(event)"><i class="far fa-trash-alt"></i></a><br> -->
                                </div>
                            <?php } ?>
                        </div>
                        <input type="submit" name="submit" class="btn btn-success" value="Submit">
                    </form>
                </div>

            </div><!-- /.page-section -->
        </div><!-- /.page-inner -->
    </div><!-- /.page -->
    </div><!-- .app-footer -->


    <?php
    require APPROOT . '/views/inc/footer.php';
    ?>