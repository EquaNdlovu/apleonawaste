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


        <!-- Add Option Modal -->
        <div class="modal fade" id="optionModal" tabindex="-1" role="dialog" aria-labelledby="optionModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="optionModalLabel">Add Treatment Method</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="<?php echo URLROOT; ?>/Lookup_Treatment_Method_Details/add" method="post">
                  <div class="form-group">
                    <label for="description">Description: <sup>*</sup></label>
                    <input type="text" name="description" class="form-control form-control-lg <?php echo (!empty($data['description_err'])) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?php echo $data['description_err']; ?></span>
                  </div>
                  <div class="form-group" style="display:none">
                    <label for="customer">Customer: <sup>*</sup></label>
                    <input type="text" name="customer" class="form-control form-control-lg <?php echo (!empty($data['customer_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $_SESSION['customer_group']; ?>">
                    <span class="invalid-feedback"><?php echo $data['customer_err']; ?></span>
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
                <h5 class="modal-title" id="updateModalLabel">Edit Treatment Method</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="<?php echo URLROOT; ?>/Lookup_Treatment_Method_Details/update" method="post">
                  <div class="form-group" style="display:none">
                    <label for="customer">Key: <sup>*</sup></label>
                    <input type="text" name="lookup_key" id="lookup_key" class="form-control form-control-lg">
                  </div>
                  <div class="form-group">
                    <label for="description">Description: <sup>*</sup></label>
                    <input type="text" name="description" id="description" class="form-control form-control-lg <?php echo (!empty($data['description_err'])) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?php echo $data['description_err']; ?></span>
                  </div>
                  <div class="form-group" style="display:none">
                    <label for="customer">Customer: <sup>*</sup></label>
                    <input type="text" name="customer" id="customer" class="form-control form-control-lg <?php echo (!empty($data['customer_err'])) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?php echo $data['customer_err']; ?></span>
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
            Add Option
          </button>
          <br><br>
        </div>

        <div>
        <!-- <table class="table table-responsive table-bordered text-center"> -->
        <table class="table table-responsive text-center">
          <tr>
            <th style="display:none">Key</th>
            <th>Description</th>
            <th style="display:none">Customer</th>
            <th></th>
            <th></th>
          </tr>

          <?php foreach ($data['lookup'] as $lookups) :
            if (($lookups->customer) == $_SESSION['customer_group']) { ?>
              <tr>
                <td style="display:none"><?php echo $lookups->lookup_key; ?></td>
                <td><?php echo $lookups->description; ?></td>
                <td style="display:none"><?php echo $lookups->customer; ?></td>
                <td style="text-align: center"><button type="button" class="btn btn-primary editbtn" data-toggle="modal" data-target="#updateModal"> Edit </button></td>
                <td style="text-align: center"><a type="button" class="btn btn-secondary" href="<?php echo URLROOT; ?>/Lookup_Treatment_Method_Details/delete/<?php echo $lookups->lookup_key; ?>" onclick="confirmation(event)">Delete</a></td>
              </tr>
          <?php }
          endforeach; ?>
        </table>
        </div>


      </div><!-- /.page-section -->
    </div><!-- /.page-inner -->
  </div><!-- /.page -->
  </div><!-- .app-footer -->

  <?php
  require APPROOT . '/views/inc/footer.php';
  require APPROOT . '/views/inc/sweetalerts.js';
  ?>

  <script>
    $(document).ready(function () {
      $('.editbtn').on('click', function() {

        //alert("I am an alert box!");
        $('#updateModal').modal('show');

          $tr = $(this).closest('tr');

          var data = $tr.children("td").map(function() {
            return $(this).text();
          }).get();
          //var data = row.data();

          console.log(data);

          $('#lookup_key').val(data[0]);
          $('#description').val(data[1]);
          $('#customer').val(data[2]);

      });
    });
  </script>