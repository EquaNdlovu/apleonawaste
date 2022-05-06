

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


<a href="<?php echo URLROOT; ?>/suppliers" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<br>
<h1><?php echo $data['supplier']->supplier_key; ?></h1>
<div class="bg-secondary text-white p-2 mb-3">
  Supplier Key: <?php echo $data['supplier']->supplier_key; ?> <br>
  supplier: <?php echo $data['supplier']->supplier_name; ?>
</div>

<?php  if($_SESSION['user_type'] == "Admin") : ?>
  <hr>
  <a href="<?php echo URLROOT; ?>/suppliers/edit/<?php echo $data['supplier']->supplier_key; ?>" class="btn btn-dark">Edit</a>

  <form class="pull-right" action="<?php echo URLROOT; ?>/suppliers/delete/<?php echo $data['supplier']->supplier_key; ?>" method="post">
    <input type="submit" value="Delete" class="btn btn-danger">
  </form>
<?php endif; ?>


    
</div><!-- /.page-section -->
            </div><!-- /.page-inner -->
          </div><!-- /.page -->
        </div><!-- .app-footer -->  

<?php 
require APPROOT . '/views/inc/footer.php'; 
?>