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
        <a href="<?php echo URLROOT; ?>/collectors/index" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
          <a href="<?php echo URLROOT; ?>/certificates/add" class="btn btn-dark">Add Permit</a>
          <?php if (empty($_SESSION['collectorKey'])) {  
          $num = $_GET['tempKey']; 
          $_SESSION['collectorKey'] = $num; }
          else {
          } ?>
        </div>

        <table class="table table-bordered">
          <tr>
            <th>Permit Key</th>
            <th>Collector Name</th>
            <th>Type</th>
            <th>Permit Number</th>
            <th>Expiry Date</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
          <?php foreach ($data['certificates'] as $certificate) : 
            if (($certificate->collector_certificates_collector_key) == $_SESSION['collectorKey']) { ?>
            <tr>
              <td><?php echo $certificate->collector_certificates_key; ?></td>
              <td><?php echo $certificate->collector_certificates_collector_key; ?></td>
              <td><?php echo $certificate->collector_certificates_type; ?></td>
              <td><?php echo $certificate->collector_certificates_permit_no; ?></td>
              <td><?php echo $certificate->collector_certificates_date; ?></td>
              <td><a href="<?php echo URLROOT; ?>/certificates/edit/<?php echo $certificate->collector_certificates_key; ?>" class="btn btn-dark">Edit</a></td>
              <td><form action="<?php echo URLROOT; ?>/certificates/delete/<?php echo $certificate->collector_certificates_key; ?>" method="post">
                <input type="submit" value="Delete" class="btn btn-dark">
              </form></td>
            </tr>
          <?php } endforeach; ?>
        </table>


        </div><!-- /.page-section -->
      </div><!-- /.page-inner -->
    </div><!-- /.page -->
  </div><!-- .app-footer -->

  <?php
  require APPROOT . '/views/inc/footer.php';
  ?>