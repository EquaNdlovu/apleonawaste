<?php require APPROOT . '/views/inc/login_header.php'; ?>

 
        <form class="auth-form" action="<?php echo URLROOT; ?>/users/forgot_password" method="post">
          <div class="form-group">
            <label for="email">Please enter Email: <sup>*</sup></label>
            <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
            <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
          </div>
          <div class="row">
            <div class="col">
              <input type="submit" value="Submit" class="btn btn-success btn-block">
            </div>
            <div class="col">
             
            </div>
          </div>
        </form>
 

<?php require APPROOT . '/views/inc/login_footer.php'; ?>