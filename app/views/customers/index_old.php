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
  <a href="<?php echo URLROOT; ?>/customers/add" class="btn btn-dark">Add</a>
  </div>

  <table class="table table-bordered">
    <tr>
      <th>Key</th>
      <th>Country</th>
      <th>Name</th>
      <th>Address</th>
      <th>Group</th>
      <th></th>
    </tr>




    <?php foreach($data['customers'] as $customer) : ?>
    <tr>
      <td><?php echo $customer->waste_customer_key; ?></td>
      <td><?php echo $customer->waste_customer_country; ?></td>
      <td><?php echo $customer->waste_customer_name; ?></td>
      <td><?php echo $customer->waste_customer_address; ?></td>
      <td><?php echo $customer->waste_customer_group; ?></td>
      <td><a href="<?php echo URLROOT; ?>/customers/edit/<?php echo $customer->waste_customer_key; ?>" <i class='fa fa-pencil-alt'></i></a></td>
      <td><a href="<?php echo URLROOT; ?>/customers/delete/<?php echo $customer->waste_customer_key; ?>" <i class='far fa-trash-alt'></i></a></td>
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