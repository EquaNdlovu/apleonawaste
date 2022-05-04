 <!-- .app-footer -->
 <footer class="app-footer">
          
          <div class="copyright"> Copyright © 2021. All right reserved. </div>
        </footer><!-- /.app-footer -->
        <!-- /.wrapper -->
      </main><!-- /.app-main -->
    </div><!-- /.app -->


    
    <!-- BEGIN BASE JS -->
    <script src="<?php echo URLROOT; ?>/assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo URLROOT; ?>/assets/vendor/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo URLROOT; ?>/assets/vendor/bootstrap/js/bootstrap.min.js"></script> <!-- END BASE JS -->
   


    <!-- BEGIN PLUGINS JS -->
    <script src="<?php echo URLROOT; ?>/assets/vendor/pace/pace.min.js"></script>
    <script src="<?php echo URLROOT; ?>/assets/vendor/stacked-menu/stacked-menu.min.js"></script>
    <script src="<?php echo URLROOT; ?>/assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script> 
   

    <script src="<?php echo URLROOT; ?>/assets/vendor/easy-pie-chart/jquery.easypiechart.min.js"></script>
    <script src="<?php echo URLROOT; ?>/assets/vendor/chart.js/Chart.min.js"></script>


  
   
   
    <!-- BEGIN THEME JS -->
    <script src="<?php echo URLROOT; ?>/assets/javascript/theme.min.js"></script> <!-- END THEME JS -->
     <script src="<?php echo URLROOT; ?>/assets/javascript/pages/dashboard-demo.js"></script>
      <script src="<?php echo URLROOT; ?>/assets/javascript/pages/slider-demo.js"></script>

     <script src="<?php echo URLROOT; ?>/assets/vendor/nouislider/wNumb.js"></script>
    <script src="<?php echo URLROOT; ?>/assets/vendor/nouislider/nouislider.min.js"></script>
    <script src="<?php echo URLROOT; ?>/assets/javascript/pages/slider-demo.js"></script>

     <script src="<?php echo URLROOT; ?>/assets/vendor/flatpickr/flatpickr.js"></script>
     <script src="<?php echo URLROOT; ?>/assets/vendor/flatpickr/plugins/monthSelect/index.js"></script>
    <?php
    require APPROOT . '/views/inc/date_picker.js'; 
     ?>

   
    <!-- Chart  Stuff -->






<script>
        $(document).ready(function () {
            <?php
            echo "showCharityGraph1('" . $site ."', '" . $customer ."'); showCharityGraph2('" . $site ."', '" . $customer ."');";
            ?>   

        });

</script>
   
    <!-- Data Table Stuff -->

  

    <!-- END PAGE LEVEL JS -->

   
<!-- END PAGE LEVEL JS -->
  </body>
</html>