    
  <!-- NAVBAR -->
  <nav class="navbar navbar-expand navbar-light courses-navbar" id="navbar">
  <div class="container-fluid">
    <a class="navbar-brand" href="/InteractiveWebsite">
      <img src="<?php echo BASE_URL . '/interactive/images/InteractiveWebsite_Logo_2.png';?>" alt="" width="90" height="90" class="d-inline-block align-top navbar-image">
    </a>

    <ul class="nav navbar-nav me-auto mb-2 mb-lg-0 nav-left-elements">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo BASE_URL . "/courses.php"?>">Courses</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo BASE_URL . "/practice.php"?>">Practice</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo BASE_URL . "/leaderboard.php"?>">Leaderboard</a>
        </li>
    </ul>    

    <?php if (isset($_SESSION['id'])): ?>
      <div class="float-right">
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="navbar-toggler-icon profile-dropdown"></span>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
            <li><a class="dropdown-item" href="<?php echo BASE_URL . "/profile/account.php"?>">Account</a></li>
            <li><a class="dropdown-item" href="<?php echo BASE_URL . "/profile/progress.php"?>">Progress</a></li>
            <?php if($_SESSION['admin']):?>

              <li><a href="<?php echo BASE_URL . '/admin/dashboard.php'?>" class="dropdown-item" href="#">Dashboard</a></li>

            <?php endif; ?>
            
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="<?php echo BASE_URL . '/logout.php'?>">Log out</a></li>
          </ul>
        </li>
      </div>

    <?php else: ?>
      
      <div class="float-right authButtons">
      
        <a href="/InteractiveWebsite/login.php" class="btn btn-outline-light login-btn">Log In</a>
        <a href="register.php" class="btn btn-light register-btn">Register</a>

      </div>

    <?php endif; ?>
  </div>
</nav>