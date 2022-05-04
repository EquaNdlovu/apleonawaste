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

  <a href="<?php echo URLROOT; ?>/rds" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
  <div class="card card-body bg-light mt-5">
    <h2>Edit RD Code</h2>
    <form action="<?php echo URLROOT; ?>/rds/edit/<?php echo $data['rd_key']; ?>" method="post">
      <div class="form-group">
        <label for="rd_code">rd_code: <sup>*</sup></label>
        <input type="text" name="rd_code" class="form-control form-control-lg <?php echo (!empty($data['rd_code_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['rd_code']; ?>">
        <span class="invalid-feedback"><?php echo $data['rd_code_err']; ?></span>
      </div>
      <div class="form-group">
        <label for="rd_name">rd_name: <sup>*</sup></label>
        <input type="text" name="rd_name" class="form-control form-control-lg <?php echo (!empty($data['rd_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['rd_name']; ?>">
        <span class="invalid-feedback"><?php echo $data['rd_name_err']; ?></span>
      </div>
      <div class="form-group">
        <label for="rd_description">rd_description: <sup>*</sup></label>
        <input type="text" name="rd_description" class="form-control form-control-lg <?php echo (!empty($data['rd_description_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['rd_description']; ?>">
        <span class="invalid-feedback"><?php echo $data['rd_description_err']; ?></span>
      </div>

      <input type="submit" class="btn btn-success" value="Submit">
    </form>
  </div>

  </div><!-- /.page-section -->
            </div><!-- /.page-inner -->
          </div><!-- /.page -->
        </div><!-- .app-footer -->


<?php 
require APPROOT . '/views/inc/footer.php'; 
?>
