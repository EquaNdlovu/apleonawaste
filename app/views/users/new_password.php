<?php require APPROOT . '/views/inc/login_header.php'; ?>


 
        <form class="auth-form" action="<?php echo URLROOT; ?>/users/new_password" method="post">
        <div class="form-group">
            <input class="form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" type="password" name="password" placeholder="Create new password" required>
            <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
        </div>
        <div class="form-group">
            <input class="form-control <?php echo (!empty($data['cpassword_err'])) ? 'is-invalid' : ''; ?>" type="password" name="cpassword" placeholder="Confirm your password" required>
            <span class="invalid-feedback"><?php echo $data['cpassword_err']; ?></span>
        </div>
          <div class="row">
            <div class="col">
              <input type="submit" name="change-password" value="Submit" class="btn btn-success btn-block">
            </div>
            <div class="col">
             
            </div>
          </div>
        </form>
 

<?php require APPROOT . '/views/inc/login_footer.php'; ?>