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
    <a href="<?php echo URLROOT; ?>/treatments/add" class="btn btn-dark">Add</a>
  </div>

  <table class="table table-bordered">
    <tr>
      <th>Waste Treatment Key</th>
      <th>Waste Treatment Name</th>
      <th>Edit</th>
    </tr>
    <?php foreach($data['treatments'] as $treatment) : ?>
    <tr>
      <td><?php echo $treatment->treatment_facility_key; ?></td>
      <td><?php echo $treatment->treatment_facility_name; ?></td>
      <td><a href="<?php echo URLROOT; ?>/treatments/edit/<?php echo $treatment->treatment_facility_key; ?>" class="btn btn-dark">Edit</a></td>
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