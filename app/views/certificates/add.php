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


                <a href="<?php echo URLROOT; ?>/certificates/index" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
                <div class="card card-body bg-light mt-5">
                    <h2>Add Permit/Certificate</h2>
                    <p>Attach a Permit or a Collector with this form</p>
                    <form action="<?php echo URLROOT; ?>/certificates/add" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="collector_certificates_collector_key">Collector Name: <sup>*</sup></label>
                            <input type="text" readonly="readonly" name="collector_certificates_collector_key" class="form-control form-control-lg <?php echo (!empty($data['collector_certificates_collector_key_err'])) ? 'is-invalid' : ''; ?>" placeholder="<?php echo $_SESSION['collectorKey']; ?>" value="<?php echo $_SESSION['collectorKey']; ?>">
                            <span class="invalid-feedback"><?php echo $data['collector_certificates_collector_key_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="collector_certificates_type">Permit Type: <sup>*</sup></label>
                            <input type="text" name="collector_certificates_type" class="form-control form-control-lg <?php echo (!empty($data['collector_certificates_type_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['collector_certificates_type']; ?>">
                            <span class="invalid-feedback"><?php echo $data['collector_certificates_type_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="collector_certificates_permit_no">Permit Number: <sup>*</sup></label>
                            <input type="text" name="collector_certificates_permit_no" class="form-control form-control-lg <?php echo (!empty($data['collector_certificates_permit_no_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['collector_certificates_permit_no']; ?>">
                            <span class="invalid-feedback"><?php echo $data['collector_certificates_permit_no_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="collector_certificates_date">Expiry Date: <sup>*</sup></label>
                            <input type="date" name="collector_certificates_date" class="form-control form-control-lg <?php echo (!empty($data['collector_certificates_date_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['collector_certificates_date']; ?>">
                            <span class="invalid-feedback"><?php echo $data['collector_certificates_date_err']; ?></span>
                        </div>
                        <?php echo "Please Attach Permit:" ?>
                        <div class="custom-file" id="customFile">
                            <input type="file" class="custom-file-input <?php echo (!empty($data['collector_certificates_file_err'])) ? 'is-invalid' : ''; ?>" id="file" name="file" aria-describedby="fileHelp">
                            <label class="custom-file-label" for="file">
                                Select file...
                            </label>
                            <span class="invalid-feedback"><?php echo $data['collector_certificates_file_err']; ?></span>
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