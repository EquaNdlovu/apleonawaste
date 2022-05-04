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

  <a href="<?php echo URLROOT; ?>/sites" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
  <div class="card card-body bg-light mt-5">
    <h2>Edit Sites</h2>
    <form action="<?php echo URLROOT; ?>/sites/edit/<?php echo $data['waste_site_key']; ?>" method="post">
      <div class="form-group" style="display:none">
        <label for="waste_site_country">Country <sup>*</sup></label>
        <input type="text" name="waste_site_country" class="form-control form-control-lg <?php echo (!empty($data['waste_site_country_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['waste_site_country']; ?>">
        <span class="invalid-feedback"><?php echo $data['waste_site_country_err']; ?></span>
      </div>

<div class="form-group">
        <label for="waste_site_customer">Customer <sup>*</sup></label>
        <select id="waste_site_customer" name="waste_site_customer" data-toggle="selectpicker" data-width="100%">
        <?php
                $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
                $sql = "SELECT waste_customer_key, waste_customer_name FROM wm_customer WHERE waste_customer_country = '" . $_SESSION['country'] . "' ORDER BY waste_customer_key ASC";
                $result = mysqli_query($db, $sql);
                echo "<option value='" . $data['waste_site_customer'] . "'>". $data['waste_site_customer'] . "</option>";
                 echo "<option value=0>Please Select</option>";
                     while ($row = mysqli_fetch_array($result)) {
                      echo "<option value='" .$row['waste_customer_name']."'> ".$row['waste_customer_name'] . "</option>"; 
                       }
                       echo "</select>";
              ?>
        <span class="invalid-feedback"><?php echo $data['waste_site_customer_err']; ?></span>
      </div>


<div class="form-group">
        <label for="waste_site_name">Site<sup>*</sup></label>
        <input type="text" name="waste_site_name" class="form-control form-control-lg <?php echo (!empty($data['waste_site_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['waste_site_name']; ?>">
        <span class="invalid-feedback"><?php echo $data['waste_site_name_err']; ?></span>
      </div>


<div class="form-group">
        <label for="waste_site_address">Address<sup>*</sup></label>
        <input type="text" name="waste_site_address" class="form-control form-control-lg <?php echo (!empty($data['waste_site_address_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['waste_site_address']; ?>">
        <span class="invalid-feedback"><?php echo $data['waste_site_address_err']; ?></span>
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
