<?php
  
  
if(isset($_SESSION['id'])){

    $user = selectOne('users', ['id' => $_SESSION['id']]);
   
}
  
?>  
  
  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-light dashboard-bar" id="navbar">
  <div class="container-fluid">
    <a class="navbar-brand" href="/InteractiveWebsite">
        <div class="d-inline-block align-top dashboardBar-image">

            <h5 class="dashboardBarImage-initials text-center">

                <?php 
                
                    $firstname = $_SESSION['first_name'];
                    $lastname = $_SESSION['last_name'];

                    $firstname_initial = substr($firstname, 0, 1);
                    $lastname_initial = substr($lastname, 0, 1);

                    echo $firstname_initial . "" . $lastname_initial; 
                
                ?>

            </h5>

        </div>  

        <h6 class="dashboardBar-admin-name">

            <?php 

                echo $user['first_name'] . " " . $user['last_name'];

            ?>

        </h6>

    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">

            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?php echo BASE_URL . '/admin/courses/index.php'?>">Manage Courses</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL . '/admin/lessons/index.php'?>">Manage Lessons</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL . '/admin/users/index.php'?>">Manage Users</a>
            </li>

            <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL . '/admin/chapters/index.php'?>">Manage Chapters</a>
            </li>

            <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL . '/admin/practice-quizes/index.php'?>">Manage Practice</a>
            </li>
            
        </ul>    

    </div>

  </div>

</nav>