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
    <a href="<?php echo URLROOT; ?>/brokers/add" class="btn btn-dark">Add</a>
  </div>

  <table class="table table-bordered">
    <tr>
      <th>Waste Broker Key</th>
      <th>Waste Broker Name</th>
      <th>Waste Broker Country
      <th>Edit</th>
    </tr>
    <?php foreach($data['brokers'] as $broker) : ?>
    <tr>
      <td><?php echo $broker->waste_broker_key; ?></td>
      <td><?php echo $broker->waste_broker_name; ?></td>
      <td><?php echo $broker->waste_broker_country; ?></td>
      <td><a href="<?php echo URLROOT; ?>/brokers/edit/<?php echo $broker->waste_broker_key; ?>" class="btn btn-dark">Edit</a></td>
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