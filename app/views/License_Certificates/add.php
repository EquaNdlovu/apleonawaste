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

                <a href="<?php echo URLROOT; ?>/License_Certificates" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
                <div class="card card-body bg-light mt-5">
                    <h2>Add Certificate</h2>
                    <!--<button id=demo onclick="partyTime()">Party Time</button>-->
                    <p>Attach a Certificate with this form</p>
                    <form action="<?php echo URLROOT; ?>/License_Certificates/add" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="license_certificates_vendor">Vendor: <sup>*</sup></label>
                            <input type="text" name="license_certificates_vendor" class="form-control form-control-lg <?php echo (!empty($data['license_certificates_vendor_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['license_certificates_vendor']; ?>">
                            <span class="invalid-feedback"><?php echo $data['license_certificates_vendor_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="license_certificates_date">Date: <sup>*</sup></label>
                            <input type="date" name="license_certificates_date" class="form-control form-control-lg <?php echo (!empty($data['license_certificates_date_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['license_certificates_date']; ?>">
                            <span class="invalid-feedback"><?php echo $data['license_certificates_date_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="license_certificates_type">Type: <sup>*</sup></label>
                            <input type="text" name="license_certificates_type" class="form-control form-control-lg <?php echo (!empty($data['license_certificates_type_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['license_certificates_type']; ?>">
                            <span class="invalid-feedback"><?php echo $data['license_certificates_type_err']; ?></span>
                        </div>
                        <?php echo "Documentation:" ?>
                        <div class="custom-file" id="customFile">
                            <input type="file" class="custom-file-input <?php echo (!empty($data['license_certificates_docs_err'])) ? 'is-invalid' : ''; ?>" id="file" name="file[]" aria-describedby="fileHelp" multiple>
                            <label class="custom-file-label" for="file">
                                Select file...
                            </label>
                            <span class="invalid-feedback"><?php echo $data['license_certificates_docs_err']; ?></span>
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