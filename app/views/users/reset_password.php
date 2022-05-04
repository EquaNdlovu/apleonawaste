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
              <h2>Reset Password</h2>
              <p>Please complete the following to reset password:</p>
              <form action="<?php echo URLROOT; ?>/users/reset_password/<?php echo $data['id']; ?>" method="post">
              <div class="form-group">
                  <label for="id">ID: <sup>*</sup></label>
                  <input type="text" name="id" class="form-control form-control-lg" value="<?php echo $data['id']; ?>">
                </div>
                <div class="form-group">
                  <label for="password">New Password: <sup>*</sup></label>
                  <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                  <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                </div>
                <div class="form-group">
                  <label for="confirm_password">Confirm New Password: <sup>*</sup></label>
                  <input type="password" name="confirm_password" class="form-control form-control-lg <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                  <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
                </div>

                <div class="row">
                  <div class="col">
                    <input type="submit" value="Register" class="btn btn-success btn-block">
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