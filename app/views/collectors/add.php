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



  <a href="<?php echo URLROOT; ?>/collectors" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
  <div class="card card-body bg-light mt-5">
    <h2>Add Collector</h2>
    <p>Create a Collector with this form</p>
    <form action="<?php echo URLROOT; ?>/collectors/add" method="post">
      <div class="form-group">
        <label for="waste_collector_name">Waste Collector Name: <sup>*</sup></label>
        <input type="text" name="waste_collector_name" class="form-control form-control-lg <?php echo (!empty($data['waste_collector_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['waste_collector_name']; ?>">
        <span class="invalid-feedback"><?php echo $data['waste_collector_name_err']; ?></span>
      </div>
      <div class="form-group">
        <label for="waste_collector_country">Waste Collector Country: <sup>*</sup></label>
        <input type="text" name="waste_collector_country" class="form-control form-control-lg <?php echo (!empty($data['waste_collector_country_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['waste_collector_country']; ?>">
        <span class="invalid-feedback"><?php echo $data['waste_collector_country_err']; ?></span>
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

