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


  <a href="<?php echo URLROOT; ?>/customers" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
  <div class="card card-body bg-light mt-5">
    <h2>Edit Customer</h2>
    <form action="<?php echo URLROOT; ?>/customers/edit/<?php echo $data['waste_customer_key']; ?>" method="post">
   
    <div class="form-group" style="display:none">
        <label for="waste_customer_country">Country <sup>*</sup></label>
        <input type="text" name="waste_customer_country" class="form-control form-control-lg <?php echo (!empty($data['waste_customer_country_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['waste_customer_country']; ?>">
        <span class="invalid-feedback"><?php echo $data['x']; ?></span>
    </div>

    <div class="form-group">
        <label for="waste_customer_name">Customer Name <sup>*</sup></label>
        <input type="text" name="waste_customer_name" class="form-control form-control-lg <?php echo (!empty($data['waste_customer_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['waste_customer_name']; ?>">
        <span class="invalid-feedback"><?php echo $data['x']; ?></span>
    </div>

    <div class="form-group" style="display:none">
        <label for="waste_customer_address">Address <sup>*</sup></label>
        <input type="text" name="waste_customer_address" class="form-control form-control-lg <?php echo (!empty($data['waste_customer_address_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['waste_customer_address']; ?>">
        <span class="invalid-feedback"><?php echo $data['x']; ?></span>
    </div>

    <div class="form-group" style="display:none">
        <label for="waste_customer_group">Group <sup>*</sup></label>
        <input type="text" name="waste_customer_group" class="form-control form-control-lg <?php echo (!empty($data['waste_customer_group_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['waste_customer_group']; ?>">
        <span class="invalid-feedback"><?php echo $data['x']; ?></span>
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
