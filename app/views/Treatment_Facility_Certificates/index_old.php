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
                    <a href="<?php echo URLROOT; ?>/Treatment_Facility_Certificates/add" class="btn btn-dark">Add Treatment Facility Certificate</a>
                    <br><br>
                </div>

                <table class="table table-bordered">
                    <tr>
                        <th>Key</th>
                        <th>Facility Key</th>
                        <th>Date</th>
                        <th>Docs</th>
                    </tr>
                    <?php foreach ($data['Treatment_Facility_Certificate'] as $Treatment_Facility_Certificates) : 
                        if (($Treatment_Facility_Certificates->treatment_facility_certificates_country) == $_SESSION['country']) { ?>
                        <tr>
                            <td><?php echo $Treatment_Facility_Certificates->treatment_facility_certificates_key; ?></td>
                            <td><?php echo $Treatment_Facility_Certificates->treatment_facility_certificates_facility_key; ?></td>
                            <td><?php echo $Treatment_Facility_Certificates->treatment_facility_certificates_date; ?></td>
                            <td><?php echo $Treatment_Facility_Certificates->treatment_facility_certificates_docs; ?></td>
                            <td><a href="<?php echo URLROOT; ?>/Treatment_Facility_Certificates/edit/<?php echo $Treatment_Facility_Certificates->treatment_facility_certificates_key; ?>" class="btn btn-dark">Edit</a></td>
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