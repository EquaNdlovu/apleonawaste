

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


<a href="<?php echo URLROOT; ?>/customers" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<br>



<h1><?php echo $data['customer']->waste_customer_key; ?>


<a href="<?php echo URLROOT; ?>/customers/edit/<?php echo $data['customer']->waste_customer_key; ?>" class="btn btn-dark">Edit</a>
<a href="<?php echo URLROOT; ?>/customers/delete/<?php echo $data['customer']->waste_customer_key; ?>" class="btn btn-danger">Delete</a>



    
</div><!-- /.page-section -->
            </div><!-- /.page-inner -->
          </div><!-- /.page -->
        </div><!-- .app-footer -->  

<?php 
require APPROOT . '/views/inc/footer.php'; 
?>