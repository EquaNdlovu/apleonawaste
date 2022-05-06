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

        <a href="<?php echo URLROOT; ?>/certificates/index" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
        <div class="card card-body bg-light mt-5">
          <h2>Edit Permit/Certificate</h2>
          <p>Edit a Permit for a Collector with this form</p>
          <form action="<?php echo URLROOT; ?>/certificates/edit/<?php echo $data['collector_certificates_key']; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="collector_certificates_collector_key">Collector Key: <sup>*</sup></label>
              <input type="text" readonly="readonly" name="collector_certificates_collector_key" class="form-control form-control-lg <?php echo (!empty($data['collector_certificates_collector_key_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['collector_certificates_collector_key']; ?>">
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
            <?php echo "Permit Documentation:" ?>
            <?php
            $permitKey = $data['collector_certificates_key'];
            $conn = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
            $query2 = "SELECT collector_certificates_file FROM collector_certificates WHERE collector_certificates_key='$permitKey'";
            $run2 = mysqli_query($conn, $query2);
            $rows = mysqli_fetch_assoc($run2);
            if ($rows['collector_certificates_file'] === NULL OR $rows['collector_certificates_file'] === '') { ?>
              <div class="custom-file" id="customFile">
                <input type="file" class="custom-file-input <?php echo (!empty($data['collector_certificates_file_err'])) ? 'is-invalid' : ''; ?>" id="file" name="file" aria-describedby="fileHelp">
                <label class="custom-file-label" for="file">
                Select file...
                </label>
                <span class="invalid-feedback"><?php echo $data['collector_certificates_file_err']; ?></span>
              </div> 
            <?php } else {
            foreach ($rows as $value) {
            ?>
              <a href="<?php echo URLROOT; ?>/certificates/download?file=<?php echo $value ?>">Download <?php echo $value ?></a><br>
              <a href="<?php echo URLROOT; ?>/certificates/delete_file?key=<?php echo $permitKey?>&file=<?php echo $value?>" onclick="confirmation(event)">Delete All Files</a><br>
            <?php
            }
           }
            ?>
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