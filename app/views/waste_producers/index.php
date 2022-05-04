<?php
require APPROOT . '/views/inc/header.php';
require APPROOT . '/views/inc/top_menu.php';
require APPROOT . '/views/inc/side_menu.php';
?>

        <?php
        $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
        $sql = ("SELECT   `waste_producer_key`, 
                `waste_producer_name`, 
                `waste_producer_customer`,
                `waste_producer_country`
                FROM wm_waste_producer
                WHERE `waste_producer_country` = '". $_SESSION['country'] ."'
                ORDER BY `waste_producer_key` DESC");
        $result = mysqli_query($db, $sql);
        $customerArray= array();
        while ($row = mysqli_fetch_array($result)) {
           array_push($customerArray, array('waste_producer_key'=>$row['waste_producer_key'],
                                            'waste_producer_name'=>$row['waste_producer_name'],
                                            'waste_producer_customer'=>$row['waste_producer_customer'],
                                            'waste_producer_country'=>$row['waste_producer_country'] ));                                                  
        }

        $jsonArray = json_encode(array('data' => $customerArray), JSON_INVALID_UTF8_IGNORE);
       
          
     if (file_put_contents("assets/data/waste_producers.json", $jsonArray))
      echo "JSON file created successfully...";
      else 
      echo "Oops! Error creating json file...";

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
              <header class="page-title-bar">
                <!-- .breadcrumb -->
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                      <a href="#"><i class="breadcrumb-icon fa fa-angle-left mr-2"></i>Back</a>
                      <!-- <img src="<?php echo URLROOT; ?>/images/red-light.png" alt="Image"/> -->
                    </li>
                  </ol>
                </nav><!-- /.breadcrumb -->
                <div>
                    <a href="<?php echo URLROOT; ?>/Waste_Producers/add" class="btn btn-dark">Add Waste Producer</a>
                    <br><br>
                </div>
                <!-- title -->
                <h1 class="page-title"> Waste Producers </h1>
                <p class="text-muted"> Please see entries below. </p><!-- /title -->
              </header><!-- /.page-title-bar -->
              <!-- .page-section -->
              <div class="page-section">
                <!-- .card -->
                <div class="card card-fluid">
                  <!-- .card-body -->
                  <div class="card-body">
                    <!-- .table -->
                    <table id="dt-responsive" class="table dt-responsive nowrap w-100">
                      <thead>
                        <tr>
                          <th> </th>
                          <th> Name </th>
                          <th> Customer </th>
                          <th> Country </th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th> </th>
                          <th> Name </th>
                          <th> Customer </th>
                          <th> Country </th>
                        </tr>
                      </tfoot>
                    </table><!-- /.table -->
                  </div><!-- /.card-body -->
                </div><!-- /.card -->
              </div><!-- /.page-section -->
            </div><!-- /.page-inner -->
          </div><!-- /.page -->
        </div><!-- .app-footer -->
        <footer class="app-footer">
          <ul class="list-inline">
            <li class="list-inline-item">
              <a class="text-muted" href="#">Support</a>
            </li>
            <li class="list-inline-item">
              <a class="text-muted" href="#">Help Center</a>
            </li>
            <li class="list-inline-item">
              <a class="text-muted" href="#">Privacy</a>
            </li>
            <li class="list-inline-item">
              <a class="text-muted" href="#">Terms of Service</a>
            </li>
          </ul>
          <div class="copyright"> Copyright © 2021. All right reserved. </div>
        </footer><!-- /.app-footer -->
        <!-- /.wrapper -->
      </main><!-- /.app-main -->

    <script src="<?php echo URLROOT; ?>/assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo URLROOT; ?>/assets/vendor/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo URLROOT; ?>/assets/vendor/bootstrap/js/bootstrap.min.js"></script> 
    <!-- END BASE JS -->
    <!-- BEGIN PLUGINS JS -->
    <script src="<?php echo URLROOT; ?>/assets/vendor/pace/pace.min.js"></script>
    <script src="<?php echo URLROOT; ?>/assets/vendor/stacked-menu/stacked-menu.min.js"></script>
    <script src="<?php echo URLROOT; ?>/assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?php echo URLROOT; ?>/assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo URLROOT; ?>/assets/vendor/datatables/extensions/responsive/dataTables.responsive.min.js"></script>
    <script src="<?php echo URLROOT; ?>/assets/vendor/datatables/extensions/responsive/responsive.bootstrap4.min.js"></script> 
    <script src="<?php echo URLROOT; ?>/assets/vendor/datatables/extensions/rowgroup/dataTables.rowGroup.js"></script> 
    <script src="<?php echo URLROOT; ?>/assets/vendor/datatables/extensions/rowgroup/dataTables.rowGroup.min.js"></script> 
    <!-- <script src="https://cdn.datatables.net/rowgroup/1.1.4/js/dataTables.rowGroup.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <!-- END PLUGINS JS -->
    <!-- BEGIN THEME JS -->
    <script src="<?php echo URLROOT; ?>/assets/javascript/theme.min.js"></script> 
    <!-- END THEME JS -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="<?php echo URLROOT; ?>/assets/javascript/pages/dataTables.bootstrap.js"></script>
    <script src="<?php echo URLROOT; ?>/assets/javascript/pages/datatables-responsive-waste-producers.js"></script> 
    <!-- END PAGE LEVEL JS -->

    </body>
</html>