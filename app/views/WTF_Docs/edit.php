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
                    <h2>Edit WTF Documentation</h2>
                    <form action="<?php echo URLROOT; ?>/WTF_Docs/edit/<?php echo $data['wtf_key']; ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="wtf_key">WTF Key: <sup>*</sup></label>
                            <input type="text" name="wtf_key" readonly="readonly" class="form-control form-control-lg <?php echo (!empty($data['wtf_key_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['wtf_key']; ?>">
                            <span class="invalid-feedback"><?php echo $data['wtf_key_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="wtf_client">WTF Client: <sup>*</sup></label>
                            <input type="text" name="wtf_client" readonly="readonly" class="form-control form-control-lg <?php echo (!empty($data['wtf_client_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['wtf_client']; ?>">
                            <span class="invalid-feedback"><?php echo $data['wtf_client_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="wtf_site">WTF Site: <sup>*</sup></label>
                            <input type="text" name="wtf_site" readonly="readonly" class="form-control form-control-lg <?php echo (!empty($data['wtf_site_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['wtf_site']; ?>">
                            <span class="invalid-feedback"><?php echo $data['wtf_site_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="wtf_date">WTF Date: <sup>*</sup></label>
                            <input type="date" name="wtf_date" data-date-format="Y-m-d" class="form-control form-control-lg <?php echo (!empty($data['wtf_date_err'])) ? 'is-invalid' : ''; ?>" data-toggle="flatpickr" data-alt-input="true" data-alt-format="F j, Y" data-date-format="Y-m-d" value="<?php echo $data['wtf_date']; ?>">
                            <span class="invalid-feedback"><?php echo $data['wtf_date_err']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="wtf_number">WTF Number: <sup>*</sup></label>
                            <input type="text" name="wtf_number" readonly="readonly" class="form-control form-control-lg <?php echo (!empty($data['wtf_number_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['wtf_number']; ?>">
                            <span class="invalid-feedback"><?php echo $data['wtf_number_err']; ?></span>
                        </div>

                            <?php
                                //$str = $rows['wtf_documentation'];
                                //$str_arr = explode (",", $rows['wtf_documentation']);
                                //foreach ($str_arr as $value) {
                            ?>
        
                        <div>
                        <?php echo "Documentation:" ?>
                            <div class="custom-file" id="customFile">
                                <input type="file" class="custom-file-input <?php echo (!empty($data['wtf_documentation_err'])) ? 'is-invalid' : ''; ?>" id="file" name="file[]" aria-describedby="fileHelp" multiple>
                                <label class="custom-file-label" for="file">
                                    Select file...
                                </label>
                                <span class="invalid-feedback"><?php echo $data['wtf_documentation_err']; ?></span> 
                            </div>
                            <br>
                            <?php
                            $WTFKey = $data['wtf_key'];
                            $conn = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
                            $query3 = "SELECT file_name FROM wtf_files WHERE wtf_files_docs_key='$WTFKey'";
                            $run3 = mysqli_query($conn, $query3);
                            $rows = mysqli_fetch_all($run3);
                                foreach ($rows as $row) { ?>
                                 <div>
                                <a href="<?php echo URLROOT; ?>/WTF_Docs/download?file=<?php echo current($row) ?>">Download <?php echo current($row) ?></a>
                                <a class="btn btn-sm btn-icon btn-secondary far fa-trash-alt" href="<?php echo URLROOT; ?>/WTF_Docs/delete_file?key=<?php echo $WTFKey?>&file=<?php echo current($row)?>" onclick="confirmation(event)"></a>
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