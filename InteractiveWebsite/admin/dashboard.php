<?php 

include("../includePhp/path.php");
include(STANDARD_PATH . "/app/database/db.php");
include(STANDARD_PATH . "/app/permissions.php");
adminOnly();

$usercount = mysqli_query($conn ,"SELECT * FROM users");
$count = mysqli_num_rows($usercount);

$last_user_sql = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC LIMIT 1");
$last_user = mysqli_fetch_assoc($last_user_sql);

$admincountsql = mysqli_query($conn ,"SELECT * FROM users WHERE admin = 1");
$admincount = mysqli_num_rows($admincountsql);
$adminusers = array();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Dashboard</title>
     <!-- HEAD // HEAD // HEAD -->
     <?php include(STANDARD_PATH . "/includePHP/head.php"); ?>
</head>
<body>

    <?php include(STANDARD_PATH . "/includePHP/dashboardHeader.php"); ?>
    <?php include(STANDARD_PATH . "/includePHP/dashboardBar.php"); ?>

    <div class="dashboard-content">

        <div class="container-fluid">
        
            <div class="row">
            
                <div class="col-auto display-users">
                
                    <div class="display-users-content">

                        <h2 class="users-number"><i class="fas fa-users"></i> There are <?php echo $count;?> users registered.</h2>
                        <h2 class="last-user"><i class="fas fa-user"></i> Last registered user: <br> <?php echo $last_user['first_name'] . " " .$last_user['last_name'];?></h2>

                    </div>
                
                </div>

            </div>

            <div class="row">

                <div class="col-auto admin-users">

                    <div class="admin-users-content">

                        <h2 class="users-number"><i class="fas fa-users"></i> There are <?php echo $admincount;?> admins.</h2>
                        <ul class="admins-list">

                            <?php while($adminusers = mysqli_fetch_array($admincountsql)):?>
                                
                                <li><?php echo $adminusers['first_name'] . " " . $adminusers['last_name'];?></li>

                            <?php endwhile;?>
                            
                        </ul>

                     </div>

                 </div>

            </div>
        
        </div>

    </div>
    


    <script type="text/javascript" src="../../script/admin_script.js"></script>
</body>
</html>