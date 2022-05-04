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
    <a href="<?php echo URLROOT; ?>/user_list/add" class="btn btn-dark">Add</a>
  </div>

  <table class="table table-bordered">
    <tr>
      <th>id</th>
      <th>name</th>
      <th>email </th>
      <th>password</th>
      <th>customer_group</th>
      <th>country</th>
      <th>customer</th>
      <th>primary_site</th>
      <th>user_type</th>
      <th>created_at</th>





      <th>Edit</th>
    </tr>
    <?php foreach($data['user_list'] as $user_list) : ?>
    <tr>
      <td><?php echo $user_list->id; ?></td>
      <td><?php echo $user_list->name; ?></td>
      <td><?php echo $user_list->email; ?></td>
      <td><?php echo $user_list->password; ?></td>
      <td><?php echo $user_list->customer_group; ?></td>
      <td><?php echo $user_list->country; ?></td>
      <td><?php echo $user_list->customer; ?></td>
      <td><?php echo $user_list->primary_site; ?></td>
      <td><?php echo $user_list->user_type; ?></td>
      <td><?php echo $user_list->created_at; ?></td>




      <td><a href="<?php echo URLROOT; ?>/user_list/show/<?php echo $user_list->id; ?>" class="btn btn-dark">Edit</a></td>
    </tr>
    <?php endforeach; ?>
    </table>

    
  </div><!-- /.page-section -->
            </div><!-- /.page-inner -->
          </div><!-- /.page -->
        </div><!-- .app-footer -->  

<?php 
require APPROOT . '/views/inc/footer.php'; 
?>