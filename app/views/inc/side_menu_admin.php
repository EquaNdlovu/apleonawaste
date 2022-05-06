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
          <!-- <div class="aside-menu overflow-hidden"> -->
          <div class="aside-menu overflow-">
            <!-- .stacked-menu -->
            <nav id="stacked-menu" class="stacked-menu">
              <!-- .menu -->
              <ul class="menu">
                <!-- .menu-item -->
                <li class="menu-item has-active">
                <?php if ($_SESSION['customer_group'] !== "Workspace") { ?>
                  <a href="<?php echo URLROOT; ?>/pages/index?mySite=ALL&myCustomer=<?php echo $_SESSION['customer_group']?>" class="menu-link"><span class="menu-icon fas fa-home"></span> <span class="menu-text">Home</span></a>
                  <?php } else { ?>
                    <a href="<?php echo URLROOT; ?>/index" class="menu-link"><span class="menu-icon fas fa-home"></span> <span class="menu-text">Home</span></a>
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
                    <?php } else { ?>
                     <li class="menu-item">
                      <a href="<?php echo URLROOT; ?>/collections/add" class="menu-link">Record Collections</a>
                    </li>
                  <?php } ?>
                    <li class="menu-item">
                      <a href="<?php echo URLROOT; ?>/collections" class="menu-link">View Collections</a>
                    </li>
                  </ul><!-- /child menu -->

                  <?php if ($_SESSION['user_email'] == 'itsupport.irl@apleona.com' OR $_SESSION['customer_group'] == 'Stryker Ireland') { ?>
                  <li class="menu-item has-child">
                  <a href="#" class="menu-link"><span class="menu-icon far fa-file"></span> <span class="menu-text">Historical Documents</span></a> <!-- child menu -->
                  <ul class="menu">
                     <li class="menu-item">
                      <a href="<?php echo URLROOT; ?>/WTF_Docs/index_old" class="menu-link">WTF Documents</a>
                    </li>
                    <li class="menu-item">
                      <a href="<?php echo URLROOT; ?>/Treatment_Facility_Certificates/index_old" class="menu-link">Treatment Facility Certs</a>
                    </li>
                    <li class="menu-item">
                      <a href="<?php echo URLROOT; ?>/License_Certificates/index_old" class="menu-link">Licensing & Certificates</a>
                    </li>
                  </ul><!-- /child menu -->
                </li><!-- /.menu-item -->
                <?php } ?>

                <?php //if ($_SESSION['country'] == 'IE') { ?>
                  <li class="menu-item has-child">
                  <a href="#" class="menu-link"><span class="menu-icon far fa-file"></span> <span class="menu-text">Documents   <span class="badge badge-warning">New</span></span></a> <!-- child menu -->
                  <ul class="menu">
                     <li class="menu-item">
                      <a href="<?php echo URLROOT; ?>/WTF_Docs" class="menu-link" style="font-size:90%;">Waste Transfer Documents </a>
                    </li>
                    <li class="menu-item">
                      <a href="<?php echo URLROOT; ?>/Treatment_Facility_Certificates" class="menu-link" style="font-size:90%;">Waste Facility Licenses<br>& Environmental Permits</a>
                    </li>
                    <li class="menu-item">
                      <a href="<?php echo URLROOT; ?>/License_Certificates" class="menu-link" style="font-size:90%;">Waste Collection Permits<br>& Carrier Licenses</a>
                    </li>
                    <li class="menu-item">
                      <a href="<?php echo URLROOT; ?>/Additional_Docs" class="menu-link" style="font-size:90%;">Additional Docs</a>
                    </li>
                    <!-- <li class="menu-item">
                      <a href="#" class="menu-link" style="font-size:90%;">Additional Docs</a>
                    </li> -->
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
                          if ($_SESSION['customer_group'] == 'Workspace') {
                            $sql1 = "SELECT DISTINCT Customer_Waste_Producer FROM collections WHERE collections_customer_number = '$current_customer' ORDER BY Customer_Waste_Producer ASC";
                          } else {
                            $sql1 = "SELECT DISTINCT collections_customer_site FROM collections WHERE collections_customer_number = '$current_customer' ORDER BY collections_customer_site ASC";
                          }                              
                          $result1 = mysqli_query($db, $sql1);
                             
                         echo '<li class="menu-item">';
                          echo '<a href="' . URLROOT . '/index.html?mySite=ALL&myCustomer=' . $current_customer . '"class="menu-link">All</a></li>';

                               while ($row = mysqli_fetch_array($result1)) {
                                echo '<li class="menu-item">';
                                if ($_SESSION['customer_group'] == 'Workspace') {
                                  echo '<a href="' . URLROOT . '/index.html?mySite=' . $row['Customer_Waste_Producer']. '&myCustomer=' .  $current_customer .    '" class="menu-link">'. $row['Customer_Waste_Producer'] .'</a></li>';
                                } else {
                                echo '<a href="' . URLROOT . '/index.html?mySite=' . $row['collections_customer_site']. '&myCustomer=' .  $current_customer .    '" class="menu-link">'. $row['collections_customer_site'] .'</a></li>';
                                }                              
                               }
                          echo '</ul>';
                       



                      }
                      echo '</li>';

                   ?>



</ul>
</li>


                <!-- .menu-header -->
                <li class="menu-header">Admin Area</li><!-- /.menu-header -->
                <!-- .menu-item -->


                <!-- .menu-item -->
                <li class="menu-item has-child">
                  <a href="#" class="menu-link"><span class="menu-icon oi oi-wrench"></span> <span class="menu-text">Admin   <span class="badge badge-warning">New</span></span></a> <!-- child menu -->
                  <ul class="menu">
                     <li class="menu-item">
                      <a href="<?php echo URLROOT; ?>/customers" class="menu-link">Customers</a>
                    </li>
                    <?php if($_SESSION['country'] == 'Workspace') { ?>
                    <li class="menu-item">
                      <a href="<?php echo URLROOT; ?>/Waste_Producers" class="menu-link">Waste Producers</a>
                    </li>
                    <?php } ?>
                    <li class="menu-item">
                      <a href="<?php echo URLROOT; ?>/sites" class="menu-link">Sites</a>
                    </li>
                    <li class="menu-item">
                      <a href="<?php echo URLROOT; ?>/brokers" class="menu-link">Waste Broker</a>
                    </li>
                    <li class="menu-item">
                      <a href="<?php echo URLROOT; ?>/collectors" class="menu-link">Waste Collector</a>
                    </li>
                    <li class="menu-item">
                      <a href="<?php echo URLROOT; ?>/treatments" class="menu-link">Treatment Facility</a>
                    </li>
                    <?php if($_SESSION['user_email'] == 'itsupport.irl@apleona.com') { ?>
                    <li class="menu-item">
                      <a href="<?php echo URLROOT; ?>/suppliers/index" class="menu-link">Suppliers</a>
                    </li>
                    <li class="menu-item">
                      <a href="<?php echo URLROOT; ?>/ewcs/index" class="menu-link">EWC Codes</a>
                    </li>
                    <li class="menu-item">
                      <a href="<?php echo URLROOT; ?>/uns/index" class="menu-link">UN Codes</a>
                    </li>
                    <li class="menu-item">
                      <a href="<?php echo URLROOT; ?>/rds/index" class="menu-link">RD Codes</a>
                    </li>
                    <?php } ?>
                   </ul><!-- /child menu -->
                </li><!-- /.menu-item -->

                <li class="menu-item has-child">
                    <a href="#" class="menu-link"><span class="menu-icon oi oi-list-rich"></span><span class="menu-text"> Lookups   <span class="badge badge-warning">New</span></span></span></a> <!-- child menu -->
                    <ul class="menu">
                      <?php if ($_SESSION['country'] == 'IE') { ?>
                      <li class="menu-item">
                          <a href="<?php echo URLROOT; ?>/Lookup_Material_Classes/index" class="menu-link">Material Class</a>
                        </li>
                        <li class="menu-item">
                          <a href="<?php echo URLROOT; ?>/Lookup_Material_Descriptions/index" class="menu-link">Material Description</a>
                        </li>
                        <li class="menu-item">
                          <a href="<?php echo URLROOT; ?>/Lookup_Material_Analysis_Details/index" class="menu-link">Material Analysis Detail</a>
                        </li>
                        <?php } ?>
                        <li class="menu-item">
                          <a href="<?php echo URLROOT; ?>/Lookup_Treatment_Method_Details/index" class="menu-link">Treatment Method Detail</a>
                        </li>
                        <?php if ($_SESSION['customer_group'] == 'Workspace') { ?>
                        <li class="menu-item">
                        <a href="<?php echo URLROOT; ?>/Lookup_Material_Descriptions/index" class="menu-link">Material Description</a>
                        </li>
                        <li class="menu-item">
                        <a href="<?php echo URLROOT; ?>/Lookup_Charity_Donations/index" class="menu-link">Charity Donations</a>
                        </li>
                        <?php } ?>
                        <li class="menu-item">
                          <a href="<?php echo URLROOT; ?>/Lookup_Charities/index" class="menu-link">Charities</a>
                        </li>
                        <?php if ($_SESSION['customer_group'] == 'Abbott Ireland') { ?>
                        <li class="menu-item">
                          <a href="<?php echo URLROOT; ?>/Lookup_ENVision_Descriptions/index" class="menu-link">ENVision Description</a>
                        </li>
                        <?php } ?>
                      </ul>
                    </li>
                
                <!-- .menu-item -->
                <li class="menu-item has-child" style="display:none">
                  <a href="#" class="menu-link"><span class="menu-icon oi oi-person"></span> <span class="menu-text">My Profile</span></a> <!-- child menu -->
                  <ul class="menu">
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
                   </ul><!-- /child menu -->
                </li><!-- /.menu-item -->

 <!-- .menu-item -->
              <?php if($_SESSION['user_email'] == 'itsupport.irl@apleona.com') { ?>
                <li class="menu-item has-child">
                  <a href="#" class="menu-link"><span class="menu-icon oi oi-person"></span> <span class="menu-text">Users</span></a> <!-- child menu -->
                  <ul class="menu">
                    
                     <li class="menu-item">
                      <a href="<?php echo URLROOT; ?>/users/index" class="menu-link">List Users</a>
                    </li>
                   
                   </ul><!-- /child menu -->
                </li><!-- /.menu-item -->
              <?php } ?>

 
               




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
