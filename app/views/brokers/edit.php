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

  <a href="<?php echo URLROOT; ?>/brokers" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
  <div class="card card-body bg-light mt-5">
    <h2>Edit Broker</h2>
    <form action="<?php echo URLROOT; ?>/brokers/edit/<?php echo $data['waste_broker_key']; ?>" method="post">
      <div class="form-group">
        <label for="waste_broker_name">Waste Broker Name: <sup>*</sup></label>
        <input type="text" name="waste_broker_name" class="form-control form-control-lg <?php echo (!empty($data['waste_broker_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['waste_broker_name']; ?>">
        <span class="invalid-feedback"><?php echo $data['waste_broker_name_err']; ?></span>
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
