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


        <div class="row">
          <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-5">
              <h2>Edit User: <?php echo $data['name']; ?> </h2>

              <p>Edit the selected user below:</p>
              <form action="<?php echo URLROOT; ?>/users/edit/<?php echo $data['id']; ?>" method="post">

                <div class="form-group">
                  <label for="name">Name: <sup>*</sup></label>
                  <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
                  <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                </div>
                <div class="form-group">
                  <label for="email">Email: <sup>*</sup></label>
                  <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                  <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                </div>
                <!--<div class="form-group">
                  <label for="customer_group">Customer Group: <sup>*</sup></label>
                  <input type="text" name="customer_group" class="form-control form-control-lg <?php echo (!empty($data['customer_group_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['customer_group']; ?>">
                  <span class="invalid-feedback"><?php echo $data['customer_group_err']; ?></span>
                </div>-->
                <div class="form-group">
                  <label for="customer_group">Customer Group: <sup>*</sup></label>

                  <select name="customer_group" data-toggle="selectpicker" data-width="100%">
                    <?php
                    $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
                    $sql = "SELECT waste_customer_key, waste_customer_name FROM wm_customer WHERE waste_customer_country = '" . $_SESSION['country'] . "' ORDER BY waste_customer_name ASC";
                    $result = mysqli_query($db, $sql);
                    echo "<option value='" . $data['customer_group'] . "'>" . $data['customer_group'] . "</option>";
                    echo "<option value=''>Please select</option>";
                    while ($row = mysqli_fetch_array($result)) {
                      echo "<option value='" . $row['waste_customer_name'] . "'> " . $row['waste_customer_name'] . "</option>";
                    }
                    echo "</select>";
                    ?>

                </div>
                <div class="form-group">
                  <label for="user_type">User Type<sup>*</sup></label>

                  <select name="user_type" data-toggle="selectpicker" data-width="100%">
                    <?php
                    $list = array("Admin", "Super User", "User", "Client");
                    //echo "<option value=0>Please select</option>";
                    echo "<option value='" . $data['user_type'] . "'>" . $data['user_type'] . "</option>";
                    foreach ($list as $select => $row) if ($row != $data['user_type']) {
                      echo "<option value='" . $row . "'>" . $row . "</option>";
                    }
                    echo '</select>';
                    ?>
                </div>
                <!--<div class="form-group">
                  <label for="user_type">User Type: <sup>*</sup></label>
                  <input type="text" name="user_type" class="form-control form-control-lg <?php echo (!empty($data['user_type_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['user_type']; ?>">
                  <span class="invalid-feedback"><?php echo $data['user_type_err']; ?></span>
                </div>

                <div class="form-group">
                  <label for="country">Country: <sup>*</sup></label>
                  <input type="text" name="country" class="form-control form-control-lg <?php echo (!empty($data['country_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['country']; ?>">
                  <span class="invalid-feedback"><?php echo $data['country_err']; ?></span>
                </div>-->
                <div class="form-group">
                  <label for="country">Country<sup>*</sup></label>

                  <select name="country" data-toggle="selectpicker" data-width="100%">
                    <?php
                    $list = array("UK", "IE", "Workspace",);
                    echo "<option value=" . $data['country'] . ">" . $data['country'] . "</option>";
                    echo "<option value=''>Please select</option>";
                    foreach ($list as $select => $row) if ($row != $data['country']) {
                      echo '<option value=' . $row . '>' . $row . '</option>';
                    }
                    echo '</select>';
                    ?>
                </div>

                <div class="row">
                  <div class="col">
                    <input type="submit" value="Update" class="btn btn-success btn-block">
                  </div>

                </div>
              </form>
            </div>
          </div>
        </div>

      </div><!-- /.page-section -->
    </div><!-- /.page-inner -->
  </div><!-- /.page -->
  </div><!-- .app-footer -->

  <?php require APPROOT . '/views/inc/footer.php'; ?>