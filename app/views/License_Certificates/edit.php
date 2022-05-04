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
                    <h2>Edit Certificate</h2>
                    <form action="<?php echo URLROOT; ?>/License_Certificates/edit/<?php echo $data['license_certificates_key']; ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="license_certificates_key">Certificate Key: <sup>*</sup></label>
                            <input type="text" name="license_certificates_key" readonly="readonly" class="form-control form-control-lg <?php echo (!empty($data['license_certificates_key_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['license_certificates_key']; ?>">
                            <span class="invalid-feedback"><?php echo $data['license_certificates_key_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="license_certificates_vendor">Vendor: <sup>*</sup></label>
                            <input type="text" name="license_certificates_vendor" readonly="readonly" class="form-control form-control-lg <?php echo (!empty($data['license_certificates_vendor_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['license_certificates_vendor']; ?>">
                            <span class="invalid-feedback"><?php echo $data['license_certificates_vendor_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="license_certificates_date">Date: <sup>*</sup></label>
                            <input type="date" name="license_certificates_date" readonly="readonly" class="form-control form-control-lg <?php echo (!empty($data['license_certificates_date_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['license_certificates_date']; ?>">
                            <span class="invalid-feedback"><?php echo $data['license_certificates_date_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="license_certificates_type">Type: <sup>*</sup></label>
                            <input type="text" name="license_certificates_type" class="form-control form-control-lg <?php echo (!empty($data['license_certificates_type_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['license_certificates_type']; ?>">
                            <span class="invalid-feedback"><?php echo $data['license_certificates_type_err']; ?></span>
                        </div>
                        <?php echo "Documentation:" ?>
                        <?php
                        $LCKey = $data['license_certificates_key'];
                        $conn = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
                        $query2 = "SELECT license_certificates_docs FROM license_certificates WHERE license_certificates_key='$LCKey'";
                        $run2 = mysqli_query($conn, $query2);
                        $rows = mysqli_fetch_assoc($run2);
                        if ($rows['license_certificates_docs'] === NULL or $rows['license_certificates_docs'] === '') { ?>
                            <div class="custom-file" id="customFile">
                                <input type="file" class="custom-file-input <?php echo (!empty($data['license_certificates_docs_err'])) ? 'is-invalid' : ''; ?>" id="file" name="file[]" aria-describedby="fileHelp" multiple>
                                <label class="custom-file-label" for="file">
                                    Select file...
                                </label>
                                <span class="invalid-feedback"><?php echo $data['license_certificates_docs_err']; ?></span>
                            </div>
                            <br>
                            <?php
                        } else {
                            $str = $rows['license_certificates_docs'];
                            $str_arr = explode(",", $rows['license_certificates_docs']);
                            foreach ($str_arr as $value) {
                            ?>
                                <div>
                                    <a href="<?php echo URLROOT; ?>/license_certificates/download?file=<?php echo $value ?>">Download <?php echo $value ?></a><br>
                                </div>
                            <?php
                            } ?>
                            <a href="<?php echo URLROOT; ?>/license_certificates/delete_file?key=<?php echo $LCKey ?>&file=<?php echo $str ?>" onclick="confirmation(event)">Delete All Files</a><br>
                        <?php
                        }
                        ?>
                        <br>

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