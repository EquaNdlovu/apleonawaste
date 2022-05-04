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

  <a href="<?php echo URLROOT; ?>/ewcs" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
  <div class="card card-body bg-light mt-5">
    <h2>Edit Supplier</h2>
    <form action="<?php echo URLROOT; ?>/ewcs/edit/<?php echo $data['ewc_key']; ?>" method="post">
      <div class="form-group">
        <label for="ewc_code_numberic">ewc_code_numberic: <sup>*</sup></label>
        <input type="text" name="ewc_code_numberic" class="form-control form-control-lg <?php echo (!empty($data['ewc_code_numberic_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['ewc_code_numberic']; ?>">
        <span class="invalid-feedback"><?php echo $data['ewc_code_numberic_err']; ?></span>
      </div>
      <div class="form-group">
        <label for="ewc_code">ewc_code: <sup>*</sup></label>
        <input type="text" name="ewc_code" class="form-control form-control-lg <?php echo (!empty($data['ewc_code_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['ewc_code']; ?>">
        <span class="invalid-feedback"><?php echo $data['ewc_code_err']; ?></span>
      </div>
      <div class="form-group">
        <label for="ewc_description">ewc_description: <sup>*</sup></label>
        <input type="text" name="ewc_description" class="form-control form-control-lg <?php echo (!empty($data['ewc_description_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['ewc_description']; ?>">
        <span class="invalid-feedback"><?php echo $data['ewc_description_err']; ?></span>
      </div>
      <div class="form-group">
        <label for="ewc_indication_of_danger">ewc_indication_of_danger: <sup>*</sup></label>
        <input type="text" name="ewc_indication_of_danger" class="form-control form-control-lg <?php echo (!empty($data['ewc_indication_of_danger_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['ewc_indication_of_danger']; ?>">
        <span class="invalid-feedback"><?php echo $data['ewc_indication_of_danger_err']; ?></span>
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
