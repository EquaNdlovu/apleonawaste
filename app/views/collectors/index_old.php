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


        <?php $_SESSION['collectorKey'] = NULL;?>
        <div>
          <a href="<?php echo URLROOT; ?>/collectors/add" class="btn btn-dark">Add</a>
          <?php echo $_SESSION['collectorKey'] ?>
        </div>

        <table class="table table-bordered">
          <tr>
            <th>Waste Collector Key</th>
            <th>Waste Collector Name</th>
            <th>Waste Collector Country</th>
            <th>Edit</th>
            <th>Permits</th>
          </tr>
          <?php foreach ($data['collectors'] as $collector) : ?>
            <tr>
              <td><?php echo $collector->waste_collector_key;?></td>
              <td><?php echo $collector->waste_collector_name; ?></td>
              <td><?php echo $collector->waste_collector_country; ?></td>
              <td><a href="<?php echo URLROOT; ?>/collectors/edit/<?php echo $collector->waste_collector_key; ?>" class="btn btn-dark">Edit</a></td>
              <td><a type="button" href="<?php echo URLROOT; ?>/certificates/index?tempKey=<?php echo $collector->waste_collector_name; ?>" class="btn btn-dark">Permits</a></td>                    
              <?php endforeach; ?>
        </table>


        </div><!-- /.page-section -->
      </div><!-- /.page-inner -->
    </div><!-- /.page -->
  </div><!-- .app-footer -->

  <?php
  require APPROOT . '/views/inc/footer.php';
  ?>