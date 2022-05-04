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

                <a href="<?php echo URLROOT; ?>/Additional_Docs" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
                <div class="card card-body bg-light mt-5">
                    <h2>Edit Documentation</h2>
                    <form action="<?php echo URLROOT; ?>/Additional_Docs/edit/<?php echo $data['additional_docs_key']; ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="additional_docs_key">Document Key: <sup>*</sup></label>
                            <input type="text" name="additional_docs_key" readonly="readonly" class="form-control form-control-lg <?php echo (!empty($data['additional_docs_key_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['additional_docs_key']; ?>">
                            <span class="invalid-feedback"><?php echo $data['additional_docs_key_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="additional_docs_type">Type: <sup>*</sup></label>
                            <input type="text" name="additional_docs_type" class="form-control form-control-lg <?php echo (!empty($data['additional_docs_type_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['additional_docs_type']; ?>">
                            <span class="invalid-feedback"><?php echo $data['additional_docs_type_err']; ?></span>
                        </div>
                        <!-- grid column -->
                        <div class="form-group mb-4">
                          <label for="additional_docs_comments">Comments</label>
                          <textarea class="form-control" id="additional_docs_comments" name="additional_docs_comments" placeholder="Enter any comments here" rows="3"><?php echo $data['additional_docs_comments'] ?></textarea>
                        </div><!-- /grid column -->
                        <div class="form-group">
                            <label for="additional_docs_customer">Customer: <sup>*</sup></label>
                            <input type="text" name="additional_docs_customer" class="form-control form-control-lg <?php echo (!empty($data['additional_docs_customer_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['additional_docs_customer'] ?>" readonly>
                            <span class="invalid-feedback"><?php echo $data['additional_docs_customer_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="additional_docs_country">Country: <sup>*</sup></label>
                            <input type="text" name="additional_docs_country" class="form-control form-control-lg <?php echo (!empty($data['additional_docs_country_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['additional_docs_country']; ?>" readonly>
                            <span class="invalid-feedback"><?php echo $data['additional_docs_country_err']; ?></span>
                        </div>
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
                            $additionalKey = $data['additional_docs_key'];
                            $conn = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
                            $query = "SELECT file_name FROM additional_docs_files WHERE additional_docs_key = '$additionalKey'";
                            $run = mysqli_query($conn, $query);
                            $rows = mysqli_fetch_all($run);
                                foreach ($rows as $row) { ?>
                                 <div>
                                <a href="<?php echo URLROOT; ?>/Additional_Docs/download?file=<?php echo current($row) ?>">Download <?php echo current($row) ?></a>
                                <a class="btn btn-sm btn-icon btn-secondary far fa-trash-alt" href="<?php echo URLROOT; ?>/Additional_Docs/delete_file?key=<?php echo $additionalKey?>&file=<?php echo current($row)?>" onclick="confirmation(event)"></a>
                                <!-- <a class="btn btn-sm btn-icon btn-secondary" href="delete/" onclick="confirmation(event)"><i class="far fa-trash-alt"></i></a><br> -->
                                </div>
                            <?php } ?>
                        </div>
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