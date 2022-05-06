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
    <h2>Add Customer</h2>
    <p>Please complete the details below</p>
    <form action="<?php echo URLROOT; ?>/customers/add" method="post">
      <div class="form-group">
        <label for="waste_customer_country">Customer Country <sup>*</sup></label>

        <select name="waste_customer_country" data-toggle="selectpicker" data-width="100%">
                              <?php
                                $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
                                $sql = "SELECT waste_country_key, waste_country_name FROM wm_country ORDER BY waste_country_name ASC";
                                $result = mysqli_query($db, $sql);
                                echo "<option value='" .$_SESSION['country']."'> ".$_SESSION['country'] . "</option>";
                                //  while ($row = mysqli_fetch_array($result)) {
                                //     echo "<option value='" .$row['waste_country_name']."'> ".$row['waste_country_name'] . "</option>"; 
                                //     }
                                  echo "</select>";
                              ?>

        
      </div>

     
      <div class="form-group">
        <label for="waste_customer_number">Customer Name <sup>*</sup></label>
        <input type="text" name="waste_customer_name" class="form-control form-control-lg <?php echo (!empty($data['waste_customer_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['waste_customer_name']; ?>">
        <span class="invalid-feedback"><?php echo $data['waste_customer_number_err']; ?></span>
      </div>
      
      <div class="form-group" style="display:none">
        <label for="waste_customer_address">Customer Address<sup>*</sup></label>
        <input type="text" name="waste_customer_address" class="form-control form-control-lg <?php echo (!empty($data['waste_customer_address_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['waste_customer_address']; ?>">
        <span class="invalid-feedback"><?php echo $data['waste_customer_address_err']; ?></span>
      </div>

      <div class="form-group" style="display:none">
        <label for="waste_customer_group">Customer Group<sup>*</sup></label>
        <input type="text" name="waste_customer_group" class="form-control form-control-lg <?php echo (!empty($data['waste_customer_group_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $_SESSION['customer_group'] ?>">
        <span class="invalid-feedback"><?php echo $data['waste_customer_group']; ?></span>
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

