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

                <a href="<?php echo URLROOT; ?>/WTF_Docs" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
                <div class="card card-body bg-light mt-5">
                    <h2>Add Waste Transfer Documentation</h2>
                    <!-- <button id=demo onclick="partyTime()">Party Time</button> -->
                    <p>Attach WTF Documentation with this form</p>
                    <form action="<?php echo URLROOT; ?>/WTF_Docs/add" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="wtf_client">Client: <sup>*</sup></label>
                            <input type="text" name="wtf_client" class="form-control form-control-lg <?php echo (!empty($data['wtf_client_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['wtf_client']; ?>">
                            <span class="invalid-feedback"><?php echo $data['wtf_client_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="wtf_site">Site: <sup>*</sup></label>
                            <input type="text" name="wtf_site" class="form-control form-control-lg <?php echo (!empty($data['wtf_site_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['wtf_site']; ?>">
                            <span class="invalid-feedback"><?php echo $data['wtf_site_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="wtf_date">Date: <sup>*</sup></label>
                            <input type="date" name="wtf_date" class="form-control form-control-lg <?php echo (!empty($data['wtf_date_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['wtf_date']; ?>">
                            <span class="invalid-feedback"><?php echo $data['wtf_date_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="wtf_number">WTF Number: <sup>*</sup></label>
                            <input type="text" name="wtf_number" class="form-control form-control-lg <?php echo (!empty($data['wtf_number_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['wtf_number']; ?>">
                            <span class="invalid-feedback"><?php echo $data['wtf_number_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="wtf_owner">Owner (e-mail address for notifications): <sup>*</sup></label>
                            <input type="text" name="wtf_owner" class="form-control form-control-lg <?php echo (!empty($data['wtf_owner_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['wtf_owner']; ?>">
                            <span class="invalid-feedback"><?php echo $data['wtf_owner_err']; ?></span>
                        </div>
                        <div class="form-group" style="display:none">
                            <label for="wtf_country">Country: <sup>*</sup></label>
                            <input type="text" name="wtf_country" class="form-control form-control-lg <?php echo (!empty($data['wtf_country_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $_SESSION['country']; ?>" readonly>
                            <span class="invalid-feedback"><?php echo $data['wtf_country_err']; ?></span>
                        </div>
                        <div class="form-group" style="display:none">
                            <label for="wtf_customer">Country: <sup>*</sup></label>
                            <input type="text" name="wtf_customer" class="form-control form-control-lg <?php echo (!empty($data['wtf_customer_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $_SESSION['customer_group']; ?>" readonly>
                            <span class="invalid-feedback"><?php echo $data['wtf_customer_err']; ?></span>
                        </div>
                        <?php echo "Documentation:" ?>
                        <div class="custom-file" id="customFile">
                            <input type="file" class="custom-file-input <?php echo (!empty($data['wtf_documentation_err'])) ? 'is-invalid' : ''; ?>" id="file" name="file[]" aria-describedby="fileHelp" multiple>
                            <label class="custom-file-label" for="file">
                                Select file...
                            </label>
                            <span class="invalid-feedback"><?php echo $data['wtf_documentation_err']; ?></span>
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