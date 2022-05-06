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

  <a href="<?php echo URLROOT; ?>/suppliers" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
  <div class="card card-body bg-light mt-5">
    <h2>Edit Supplier</h2>
    <form action="<?php echo URLROOT; ?>/suppliers/edit/<?php echo $data['supplier_key']; ?>" method="post">
      <div class="form-group">
        <label for="supplier_name">supplier_name: <sup>*</sup></label>
        <input type="text" name="supplier_name" class="form-control form-control-lg <?php echo (!empty($data['supplier_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['supplier_name']; ?>">
        <span class="invalid-feedback"><?php echo $data['supplier_name_err']; ?></span>
      </div>
      <div class="form-group">
        <label for="supplier_address">supplier_address: <sup>*</sup></label>
        <input type="text" name="supplier_address" class="form-control form-control-lg <?php echo (!empty($data['supplier_address_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['supplier_address']; ?>">
        <span class="invalid-feedback"><?php echo $data['supplier_address_err']; ?></span>
      </div>
      <div class="form-group">
        <label for="supplier_contact_name">supplier_contact_name: <sup>*</sup></label>
        <input type="text" name="supplier_contact_name" class="form-control form-control-lg <?php echo (!empty($data['supplier_contact_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['supplier_contact_name']; ?>">
        <span class="invalid-feedback"><?php echo $data['supplier_contact_name_err']; ?></span>
      </div>
      <div class="form-group">
        <label for="supplier_contact_number">supplier_contact_number: <sup>*</sup></label>
        <input type="text" name="supplier_contact_number" class="form-control form-control-lg <?php echo (!empty($data['supplier_contact_number_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['supplier_contact_number']; ?>">
        <span class="invalid-feedback"><?php echo $data['supplier_contact_number_err']; ?></span>
      </div>
      <div class="form-group">
        <label for="supplier_contact_email">supplier_contact_email: <sup>*</sup></label>
        <input type="text" name="supplier_contact_email" class="form-control form-control-lg <?php echo (!empty($data['supplier_contact_email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['supplier_contact_email']; ?>">
        <span class="invalid-feedback"><?php echo $data['supplier_contact_email_err']; ?></span>
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
