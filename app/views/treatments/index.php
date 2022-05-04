<?php
require APPROOT . '/views/inc/header.php';
require APPROOT . '/views/inc/top_menu.php';
require APPROOT . '/views/inc/side_menu.php';
?>

        <?php
        $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
          $sql = "SELECT `treatment_facility_key`, `treatment_facility_name`, `treatment_facility_country` FROM `treatment_facility` WHERE `treatment_facility_country` = '". $_SESSION['country'] ."' ORDER BY `treatment_facility_key` DESC";
        $result = mysqli_query($db, $sql);
        $customerArray= array();
        while ($row = mysqli_fetch_array($result)) {
           array_push($customerArray, array('treatment_facility_key'=>$row['treatment_facility_key'],
                                            'treatment_facility_name'=>$row['treatment_facility_name'],
                                            'treatment_facility_country'=>$row['treatment_facility_country'] ));                                                    
        }

        $jsonArray = json_encode(array('data' => $customerArray), JSON_INVALID_UTF8_IGNORE);
       
          
     if (file_put_contents("assets/data/treatment_facilities.json", $jsonArray))
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

        <!-- Add Option Modal -->
        <div class="modal fade" id="optionModal" tabindex="-1" role="dialog" aria-labelledby="optionModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="optionModalLabel">Add Treatment Facility</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="<?php echo URLROOT; ?>/treatments/add" method="post">
                  <div class="form-group">
                    <label for="treatment_facility_name">Name: <sup>*</sup></label>
                    <input type="text" name="treatment_facility_name" class="form-control form-control-lg <?php echo (!empty($data['treatment_facility_name_err'])) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?php echo $data['treatment_facility_name_err']; ?></span>
                  </div>
                  <div class="form-group">
                    <label for="treatment_facility_country">Country: <sup>*</sup></label>
                    <input type="text" name="treatment_facility_country" class="form-control form-control-lg <?php echo (!empty($data['treatment_facility_country_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $_SESSION['country']; ?>">
                    <span class="invalid-feedback"><?php echo $data['treatment_facility_country_err']; ?></span>
                  </div>
                  <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

          <!-- Update Option Modal -->
          <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Edit Treatment Facility</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="<?php echo URLROOT; ?>/treatments/update" method="post">
                  <div class="form-group" style="display:none">
                    <label for="treatment_facility_key">Key: <sup>*</sup></label>
                    <input type="text" name="treatment_facility_key" id="treatment_facility_key" class="form-control form-control-lg">
                  </div>
                  <div class="form-group">
                    <label for="treatment_facility_name">Facility Name: <sup>*</sup></label>
                    <input type="text" name="treatment_facility_name" id="treatment_facility_name" class="form-control form-control-lg <?php echo (!empty($data['treatment_facility_name_err'])) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?php echo $data['treatment_facility_name_err']; ?></span>
                  </div>
                  <div class="form-group" style="display:none">
                    <label for="treatment_facility_country">Country: <sup>*</sup></label>
                    <input type="text" name="treatment_facility_country" id="treatment_facility_country" class="form-control form-control-lg <?php echo (!empty($data['treatment_facility_country_err'])) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?php echo $data['treatment_facility_country_err']; ?></span>
                  </div>
                  <div class="modal-footer">
                    <!-- <input type="submit" class="btn btn-primary" value="Submit"> -->
                    <button type="submit" name="updatedata" class="btn btn-primary">Save Changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

                <div>
                   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#optionModal">
                      Add Treatment Facility
                   </button>
                <br><br>
                </div>
                <!-- title -->
                <h1 class="page-title"> Treatment Facilities </h1>
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
                          <th> Key </th>
                          <th> Facility Name </th>
                          <th> Country </th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th> </th>
                          <th> Key </th>
                          <th> Facility Name </th>
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
    <!-- END PLUGINS JS -->
    <!-- BEGIN THEME JS -->
    <script src="<?php echo URLROOT; ?>/assets/javascript/theme.min.js"></script> 
    <!-- END THEME JS -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="<?php echo URLROOT; ?>/assets/javascript/pages/dataTables.bootstrap.js"></script>
    <script src="<?php echo URLROOT; ?>/assets/javascript/pages/datatables-responsive-treatment_facilities.js"></script> 
    <!-- END PAGE LEVEL JS -->
    <!-- SweetAlert JS -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- End SweetAlert JS -->
<?php
require APPROOT . '/views/inc/sweetalerts.js'; 
?>

    <script>
    $(document).ready(function () {
      $('#dt-responsive').on('click', 'td.edit', function(e) {
        //alert("I am an alert box!");
        var cl=event.target.className;
        //alert(cl);
        if (cl.indexOf("trash") >= 0) {

        } else if (cl.indexOf("secondary") >=0) {

        } else {
          $('#updateModal').modal('show');

          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function() {
            return $(this).text();
          }).get();

          console.log(data);

          $('#treatment_facility_key').val(data[1]);
          $('#treatment_facility_name').val(data[2]);
          $('#treatment_facility_country').val(data[3]);
        }
      });
    });
  </script>

    </body>
</html>