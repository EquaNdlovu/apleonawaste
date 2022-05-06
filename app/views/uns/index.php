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
    <a href="<?php echo URLROOT; ?>/uns/add" class="btn btn-dark">Add</a>
  </div>

  <table class="table table-bordered">
    <tr>
      <th>UN Code Key</th>
      <th>UN Code</th>
      <th>UN Code description</th>
      <th>Edit</th>
    </tr>
    <?php foreach($data['uns'] as $un) : ?>
    <tr>
      <td><?php echo $un->un_code_key; ?></td>
      <td><?php echo $un->un_code; ?></td>
      <td><?php echo $un->un_code_description; ?></td>
      <td><a href="<?php echo URLROOT; ?>/uns/show/<?php echo $un->un_code_key; ?>" class="btn btn-dark">Edit</a></td>
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