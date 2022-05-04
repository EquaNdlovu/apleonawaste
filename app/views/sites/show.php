

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


<a href="<?php echo URLROOT; ?>/sites" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<br>
<h1><?php echo $data['site']->waste_site_key; ?></h1>
<div class="bg-secondary text-white p-2 mb-3">
  Site Key: <?php echo $data['site']->waste_site_key; ?> <br>
  Country: <?php echo $data['site']->waste_site_country; ?>
</div>

<?php  if($_SESSION['user_type'] == "Admin") : ?>
  <hr>
  <a href="<?php echo URLROOT; ?>/sites/edit/<?php echo $data['site']->waste_site_key; ?>" class="btn btn-dark">Edit</a>

  <form class="pull-right" action="<?php echo URLROOT; ?>/sites/delete/<?php echo $data['site']->waste_site_key; ?>" method="post">
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