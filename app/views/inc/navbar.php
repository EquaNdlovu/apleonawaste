<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
  <div class="container">
      <a class="navbar-brand" href="<?php echo URLROOT; ?>"><?php echo SITENAME; ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
        
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>/pages/about">About</a>
          </li>
        <?php if(isset($_SESSION['user_id'])) : ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>/pages/customers">Customers</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Collection
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="<?php echo URLROOT; ?>/collections/index">Collections List</a>
              <a class="dropdown-item" href="<?php echo URLROOT; ?>/collections/transaction">Chart - Transaction Type</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Reports - Coming Soon</a>
            </div>
          </li>
        <?php endif; ?>
        </ul>
        
        <ul class="navbar-nav ml-auto">
          <?php if(isset($_SESSION['user_id'])) : ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Welcome <?php echo $_SESSION['user_name'];  ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <p class="dropdown-item" ><?php echo "Group: " . $_SESSION['customer_group'] ?> </p>
              <p class="dropdown-item" ><?php echo "User Level: " . $_SESSION['user_type'] ?> </p>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="<?php echo URLROOT; ?>/users/logout">Logout</a>
            </div>
          </li>
          <?php else : ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo URLROOT; ?>/users/register">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo URLROOT; ?>/users/login">Login</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>