<?php
require APPROOT . '/views/inc/header.php'; 
require APPROOT . '/views/inc/cascading.js'; 
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



  <a href="<?php echo URLROOT; ?>/Waste_Producers" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
  <div class="card card-body bg-light mt-5">
    <h2>Add Waste Producer</h2>
    <p>Please complete the details below</p>
    <form action="<?php echo URLROOT; ?>/Waste_Producers/add" method="post">

    <div class="form-group">
        <label for="waste_producer_name">Waste Producer name<sup>*</sup></label>
        <input type="text" name="waste_producer_name" class="form-control form-control-lg <?php echo (!empty($data['waste_producer_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['waste_producer_name']; ?>">
        <span class="invalid-feedback"><?php echo $data['waste_producer_name_err']; ?></span>
      </div>

      <div class="form-group">
        <label for="waste_producer_customer">Customer<sup>*</sup></label>
        <div class="form-group">
            <select id="waste_producer_customer" name="waste_producer_customer" data-toggle="selectpicker" data-width="100%">
            <?php
                $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
                $sql = "SELECT waste_customer_key, waste_customer_name FROM wm_customer WHERE waste_customer_country = '" . $_SESSION['country'] . "' ORDER BY waste_customer_key ASC";
                $result = mysqli_query($db, $sql);
                 echo "<option value=''>Please Select</option>";
                     while ($row = mysqli_fetch_array($result)) {
                      echo "<option value='" .$row['waste_customer_name']."'> ".$row['waste_customer_name'] . "</option>"; 
                       }
                       echo "</select>";
              ?>
        </div>
      </div>

      <div class="form-group" style="display:none">
        <label for="waste_producer_country">Country<sup>*</sup></label>
        <!-- onChange='getCustomerforSite(this.value);' -->
        <select name="waste_producer_country" data-toggle="selectpicker" data-width="100%">
              <?php
                echo "<option value='" .$_SESSION['country']."'> ".$_SESSION['country'] . "</option>";
                       echo "</select>";
              ?>
      
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

