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

                <div>
                    <a href="<?php echo URLROOT; ?>/License_Certificates/add" class="btn btn-dark">Add Certificate</a>
                    <br><br>
                </div>

                <table class="table table-bordered">
                    <tr>
                        <th>Key</th>
                        <th>Vendor</th>
                        <th>Expiry Date</th>
                        <th>Type</th>
                        <th>Docs</th>
                    </tr>
                    <?php foreach ($data['License_Certificate'] as $License_Certificates) : 
                        if (($License_Certificates->license_certificates_country) == $_SESSION['country']) { ?>
                        <tr>
                            <td><?php echo $License_Certificates->license_certificates_key; ?></td>
                            <td><?php echo $License_Certificates->license_certificates_vendor; ?></td>
                            <td><?php echo $License_Certificates->license_certificates_date; ?></td>
                            <td><?php echo $License_Certificates->license_certificates_type; ?></td>
                            <td><?php echo $License_Certificates->license_certificates_docs; ?></td>
                            <td><a href="<?php echo URLROOT; ?>/License_Certificates/edit/<?php echo $License_Certificates->license_certificates_key; ?>" class="btn btn-dark">Edit</a></td>
                        <?php } 
                        endforeach; ?>
                </table>


            </div><!-- /.page-section -->
        </div><!-- /.page-inner -->
    </div><!-- /.page -->
    </div><!-- .app-footer -->

    <?php
    require APPROOT . '/views/inc/footer.php';
    ?>