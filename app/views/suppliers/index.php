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
    <a href="<?php echo URLROOT; ?>/suppliers/add" class="btn btn-dark">Add</a>
  </div>

  <table class="table table-bordered">
    <tr>
      <th> Supplier Key</th>
      <th> Supplier Name</th>
      <th> Supplier Address</th>
      <th> Supplier Contact Namer</th>
      <th> Supplier Contact Number</th>
      <th> Supplier Contact Email</th>
      <th>Edit</th>
    </tr>
    <?php foreach($data['suppliers'] as $supplier) : ?>
    <tr>
      <td><?php echo $supplier->supplier_key; ?></td>
      <td><?php echo $supplier->supplier_name; ?></td>
      <td><?php echo $supplier->supplier_address ?></td>
      <td><?php echo $supplier->supplier_contact_name; ?></td>
      <td><?php echo $supplier->supplier_contact_number; ?></td>
      <td><?php echo $supplier->supplier_contact_email; ?></td>
      <td><a href="<?php echo URLROOT; ?>/suppliers/show/<?php echo $supplier->supplier_key; ?>" class="btn btn-dark">Edit</a></td>
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