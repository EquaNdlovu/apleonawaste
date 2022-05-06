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
    <a href="<?php echo URLROOT; ?>/rds/add" class="btn btn-dark">Add</a>
  </div>

  <table class="table table-bordered">
    <tr>
      <th> Rd Key</th>
      <th> Rd code numeric</th>
      <th> Rd name </th>
      <th> Rd description</th>
      <th>Edit</th>
    </tr>
    <?php foreach($data['rds'] as $rd) : ?>
    <tr>
      <td><?php echo $rd->rd_key; ?></td>
      <td><?php echo $rd->rd_code; ?></td>
      <td><?php echo $rd->rd_name ?></td>
      <td><?php echo $rd->rd_description; ?></td>
      <td><a href="<?php echo URLROOT; ?>/rds/edit/<?php echo $rd->rd_key; ?>" class="btn btn-dark">Edit</a></td>
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