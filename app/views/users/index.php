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


              
  <div>
  <a href="<?php echo URLROOT; ?>/users/register" class="btn btn-dark">Add New</a>
  <br><br>
  </div>

  <table class="table table-bordered">
    <tr>
      <th>Key</th>
      <th>Name</th>
      <th>Email</th>
      <th>Customer Group</th>
      <th>Country</th>
      <th></th>
      <th></th>
    </tr>




    <?php foreach($data['users'] as $user) : ?>
    <tr>
      <td><?php echo $user->id; ?></td>
      <td><?php echo $user->name; ?></td>
      <td><?php echo $user->email; ?></td>
      <td><?php echo $user->customer_group; ?></td>
      <td><?php echo $user->country; ?></td>
      <td><a type="button" class="btn btn-primary" href="<?php echo URLROOT; ?>/users/edit/<?php echo $user->id; ?>">Edit</a></td>
      <td><a type="button" class="btn btn-primary" href="<?php echo URLROOT; ?>/users/reset_password/<?php echo $user->id; ?>">Reset Password</a></td>
      <!-- <i class='fa fa-pencil-alt'> -->
      <!-- <td><form action="<?php echo URLROOT; ?>/users/delete/<?php echo $user->id; ?>" method="post">
         <button type="submit" class="btn btn-secondary" onclick="confirmation(event)">Delete</button>
      </form></td> -->
      <td><a type="button" class="btn btn-secondary" href="<?php echo URLROOT; ?>/users/delete/<?php echo $user->id; ?>" onclick="confirmation(event)">Delete</a></td>
      <!-- <td><a class="btn btn-sm btn-icon btn-secondary" href="users/delete/<?php echo $user->id; ?>" onclick="confirmation(event)"><i class="fa fa-trash-alt"></i></a></td> -->
    </tr>
    <?php endforeach; ?>
    </table>

    
  </div><!-- /.page-section -->
            </div><!-- /.page-inner -->
          </div><!-- /.page -->
        </div><!-- .app-footer -->  

<?php 
require APPROOT . '/views/inc/footer.php'; 
require APPROOT . '/views/inc/sweetalerts.js';
?>