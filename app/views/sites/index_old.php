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
    <a href="<?php echo URLROOT; ?>/sites/add" class="btn btn-dark">Add</a>
  </div>

  <table class="table table-bordered">
    <tr>
      <th>Site Key</th>
      <th>Country</th>
      <th>Customer</th>
      <th>Site Name</th>
      <th>Site Address</th>
    </tr>
    <?php foreach($data['sites'] as $site) : ?>
    <tr>
      <td><?php echo $site->waste_site_key; ?></td>
      <td><?php echo $site->waste_site_country; ?></td>
      <td><?php echo $site->waste_site_customer; ?></td>
      <td><?php echo $site->waste_site_name; ?></td>
      <td><?php echo $site->waste_site_address; ?></td>
      <td><a href="<?php echo URLROOT; ?>/sites/edit/<?php echo $site->waste_site_key; ?>" class="btn btn-dark">Edit</a></td>
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