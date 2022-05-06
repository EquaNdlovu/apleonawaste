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



  <a href="<?php echo URLROOT; ?>/uns" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
  <div class="card card-body bg-light mt-5">
    <h2>Add Un</h2>
    <p>Create a Un with this form</p>
    <form action="<?php echo URLROOT; ?>/uns/add" method="post">
      <div class="form-group">
        <label for="un_code">un_code: <sup>*</sup></label>
        <input type="text" name="un_code" class="form-control form-control-lg <?php echo (!empty($data['un_code_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['un_code']; ?>">
        <span class="invalid-feedback"><?php echo $data['un_code_err']; ?></span>
      </div>
      <div class="form-group">
        <label for="un_code_description">un_code_description: <sup>*</sup></label>
        <input type="text" name="un_code_description" class="form-control form-control-lg <?php echo (!empty($data['un_code_description_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['un_code_description']; ?>">
        <span class="invalid-feedback"><?php echo $data['un_code_description_err']; ?></span>
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

