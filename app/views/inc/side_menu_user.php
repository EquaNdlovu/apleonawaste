<!--  @@@@@@@@@@@@@@@  MENU STARTS HERE @@@@@@@@@@@@@@@  --> 


      <!-- .app-aside -->
      <aside class="app-aside app-aside-expand-md app-aside-light">
        <!-- .aside-content -->
        <div class="aside-content">
          <!-- .aside-header -->
          <header class="aside-header d-block d-md-none">
            <!-- .btn-account -->
            <button class="btn-account" type="button" data-toggle="collapse" data-target="#dropdown-aside"><span class="user-avatar user-avatar-lg"><img src="assets/images/avatars/profile.jpg" alt=""></span> <span class="account-icon"><span class="fa fa-caret-down fa-lg"></span></span> <span class="account-summary"><span class="account-name">Martin Quinn</span> <span class="account-description">Legend Among Men</span></span></button> <!-- /.btn-account -->
            <!-- .dropdown-aside -->
            <div id="dropdown-aside" class="dropdown-aside collapse">
              <!-- dropdown-items -->
              <div class="pb-3">
                <a class="dropdown-item" href="user-profile.html"><span class="dropdown-icon oi oi-person"></span> Profile</a> <a class="dropdown-item" href="auth-signin-v1.html"><span class="dropdown-icon oi oi-account-logout"></span> Logout</a>
                <div class="dropdown-divider"></div><a class="dropdown-item" href="#">Help Center</a> <a class="dropdown-item" href="#">Ask Forum</a> <a class="dropdown-item" href="#">Keyboard Shortcuts</a>
              </div><!-- /dropdown-items -->
            </div><!-- /.dropdown-aside -->
          </header><!-- /.aside-header -->
          <!-- .aside-menu -->
          <div class="aside-menu overflow-hidden">
            <!-- .stacked-menu -->
            <nav id="stacked-menu" class="stacked-menu">
              <!-- .menu -->
              <ul class="menu">
                <!-- .menu-item -->
                <li class="menu-item has-active">
                  <?php if ($_SESSION['customer_group'] !== '') { ?>
                  <a href="<?php echo URLROOT; ?>/pages/index?mySite=ALL&myCustomer=<?php echo $_SESSION['customer_group']?>" class="menu-link"><span class="menu-icon fas fa-home"></span> <span class="menu-text">Home</span></a>
                  <?php } else { ?>
                    <a href="<?php echo URLROOT; ?>/" class="menu-link"><span class="menu-icon fas fa-home"></span> <span class="menu-text">Home</span></a>
                  <?php } ?>
                </li><!-- /.menu-item -->

              <!-- .menu-header -->
                <li class="menu-header">Entries</li><!-- /.menu-header -->
                <!-- .menu-item -->

                <li class="menu-item has-child">
                  <a href="#" class="menu-link"><span class="menu-icon oi oi-person"></span> <span class="menu-text">Collections</span></a> <!-- child menu -->
                  <ul class="menu">
                  <?php if ($_SESSION['country'] == "IE") { ?>
                     <li class="menu-item">
                      <a href="<?php echo URLROOT; ?>/collections/add_IE" class="menu-link">Record Collections</a>
                    </li>
                    <?php
                  } else { ?>
                     <li class="menu-item">
                      <a href="<?php echo URLROOT; ?>/collections/add" class="menu-link">Record Collections</a>
                    </li>
                  <?php } ?>
                    <li class="menu-item">
                      <a href="<?php echo URLROOT; ?>/collections" class="menu-link">View Collections</a>
                    </li>
                  </ul><!-- /child menu -->

                  <?php //if ($_SESSION['country'] == 'IE') { ?>
                  <li class="menu-item has-child">
                  <a href="#" class="menu-link"><span class="menu-icon far fa-file"></span> <span class="menu-text">Documents</span></a> <!-- child menu -->
                  <ul class="menu">
                     <li class="menu-item">
                      <a href="<?php echo URLROOT; ?>/WTF_Docs/index" class="menu-link">WTF Documents</a>
                    </li>
                    <li class="menu-item">
                      <a href="<?php echo URLROOT; ?>/Treatment_Facility_Certificates/index" class="menu-link">Treatment Facility Certs</a>
                    </li>
                    <li class="menu-item">
                      <a href="<?php echo URLROOT; ?>/License_Certificates/index" class="menu-link">Licensing & Certificates</a>
                    </li>
                  </ul><!-- /child menu -->
                </li><!-- /.menu-item -->
                <?php //} ?>




                <!-- .menu-header -->
                <li class="menu-header">Reporting & Dashboards</li><!-- /.menu-header -->
                <!-- .menu-item -->
                
                 <!-- .menu-item -->


<!-- .menu-item -->
                <li class="menu-item has-child">
                  <a href="#" class="menu-link"><span class="menu-icon oi oi-browser"></span> <span class="menu-text">Dashboards</span></a> <!-- child menu -->
                  
  <ul class="menu">
                 <?php
                      $db = mysqli_connect('46.22.129.7', 'apl_waste_user', 'Upl5o73?', 'apleona_waste');
                      if ($_SESSION['customer_group'] != '') {
                        $sql = "SELECT DISTINCT collections_customer_number FROM collections WHERE collections_customer_group = '". $_SESSION['customer_group'] ."' ORDER BY collections_customer_number ASC";
                      } else {
                        $sql = "SELECT DISTINCT collections_customer_number FROM collections WHERE collections_customer_country = '". $_SESSION['country'] ."' ORDER BY collections_customer_number ASC";
                      }
                      $result = mysqli_query($db, $sql);
                      while ($row = mysqli_fetch_array($result)) {
                         
                        echo '<li class="menu-item has-child">';
                        echo '<a href="#"' . ' class="menu-link"><span class="menu-icon oi oi-browser"></span> <span class="menu-text">';
                        echo $row['collections_customer_number'];
                        echo '</span></a>';

                         $current_customer = $row['collections_customer_number'];
                         echo '<ul class="menu">';
                              $sql1 = "SELECT DISTINCT collections_customer_site FROM collections WHERE collections_customer_number = '$current_customer' ORDER BY collections_customer_site ASC";
                              $result1 = mysqli_query($db, $sql1);
                             
                         echo '<li class="menu-item">';
                          echo '<a href="' . URLROOT . '/index.html?mySite=ALL&myCustomer=' . $current_customer . '"class="menu-link">All</a></li>';

                               while ($row = mysqli_fetch_array($result1)) {
                                echo '<li class="menu-item">';
                                echo '<a href="' . URLROOT . '/index.html?mySite=' . $row['collections_customer_site']. '&myCustomer=' .  $current_customer .    '" class="menu-link">'. $row['collections_customer_site'] .'</a></li>';
                               }
                          echo '</ul>';
                       



                      }
                      echo '</li>';

                   ?>



</ul>
</li>


                <!-- .menu-header -->
                <!-- <li class="menu-header">Admin Area</li> -->
                <!-- /.menu-header -->
                <!-- .menu-item -->


                <!-- .menu-item -->
                <!-- <li class="menu-item has-child">
                  <a href="#" class="menu-link"><span class="menu-icon oi oi-person"></span> <span class="menu-text">Admin</span></a>  -->
                  <!-- child menu -->
                  <!-- <ul class="menu">
                     <li class="menu-item">
                      <a href="<?php echo URLROOT; ?>/customers/index" class="menu-link">Customers<span class="badge badge-warning">New</span></a>
                    </li>
                    <li class="menu-item">
                      <a href="<?php echo URLROOT; ?>/sites/index" class="menu-link">Sites<span class="badge badge-warning">New</span></a>
                    </li>
                    <li class="menu-item">
                      <a href="<?php echo URLROOT; ?>/collectors/index" class="menu-link">Waste Collector</a>
                    </li>
                    
                   </ul> -->
                   <!-- /child menu -->
                <!-- </li> -->
                <!-- /.menu-item -->
                
                <!-- .menu-item -->
                <!-- <li class="menu-item has-child">
                  <a href="#" class="menu-link"><span class="menu-icon oi oi-person"></span> <span class="menu-text">My Profile</span></a> -->
                  <!-- child menu -->
                  <!-- <ul class="menu">
                    <li class="menu-item">
                      <a href="auth-empty-state.html" class="menu-link">Profile</a>
                    </li>
                    <li class="menu-item">
                      <a href="auth-empty-state.html" class="menu-link">Activities</a>
                    </li>
                    <li class="menu-item">
                      <a href="auth-empty-state.html" class="menu-link">Teams</a>
                    </li>
                    <li class="menu-item">
                      <a href="auth-empty-state.html" class="menu-link">Projects</a>
                    </li>
                    <li class="menu-item">
                      <a href="auth-empty-state.html" class="menu-link">Tasks</a>
                    </li>
                   </ul> -->
                   <!-- /child menu -->
                <!-- </li> -->
                <!-- /.menu-item -->

 
              </ul><!-- /.menu -->
            </nav><!-- /.stacked-menu -->
          </div><!-- /.aside-menu -->
          <!-- Skin changer -->
          <footer class="aside-footer border-top p-2">
            <button class="btn btn-light btn-block text-primary" data-toggle="skin"><span class="d-compact-menu-none">Night mode</span> <i class="fas fa-moon ml-1"></i></button>
          </footer><!-- /Skin changer -->
        </div><!-- /.aside-content -->
      </aside><!-- /.app-aside -->

<!--  @@@@@@@@@@@@@@@  MENU ENDS HERE @@@@@@@@@@@@@@@  -->
