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
    <a href="<?php echo URLROOT; ?>/ewcs/add" class="btn btn-dark">Add</a>
  </div>

  <table class="table table-bordered">
    <tr>
      <th> Ewc Key</th>
      <th> Ewc code numeric</th>
      <th> Ewc code</th>
      <th> Ewc description</th>
      <th> Ewc Indication of Danger</th>
      <th>Edit</th>
    </tr>
    <?php foreach($data['ewcs'] as $ewc) : ?>
    <tr>
      <td><?php echo $ewc->ewc_key; ?></td>
      <td><?php echo $ewc->ewc_code_numberic; ?></td>
      <td><?php echo $ewc->ewc_code ?></td>
      <td><?php echo $ewc->ewc_description; ?></td>
      <td><?php echo $ewc->ewc_indication_of_danger; ?></td>
      <td><a href="<?php echo URLROOT; ?>/ewcs/show/<?php echo $ewc->ewc_key; ?>" class="btn btn-dark">Edit</a></td>
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