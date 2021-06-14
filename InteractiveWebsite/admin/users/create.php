<?php 

include("../../includePhp/path.php");
include(STANDARD_PATH . "\app\controllers\users.php");
include(STANDARD_PATH . "/app/permissions.php");
adminOnly();


?>


<!DOCTYPE html>
<html lang="en">
<head>
 
    <title>Dashboard - Add User</title>
    <!-- HEAD // HEAD // HEAD -->
    <?php include("../../includePHP/head.php"); ?>

</head>
<body>
    
    
    <?php include("../../includePHP/dashboardHeader.php"); ?>
    <?php include("../../includePHP/dashboardBar.php"); ?>
    
    <div class="admin-content">

        <div class="content">

            <div class="container-fluid">

                <h2 class="admin-content-title">
                    Create user
                </h2>

                <form action="create.php" method="post" class="admin-form">
                   
                    <?php include("../../app/helpers/formErrors.php");?>

                    <div class="mb-3">
                        <input type="email" name="email" value="<?php echo $email; ?>" class="form-control" id="registerEmail"  placeholder="Email">
                    </div>
                    <div class="mb-3">
                        <input type="text" name="first_name" value="<?php echo $first_name; ?>" class="form-control" id="firstName" placeholder="First Name">
                    </div>
                    <div class="mb-3">
                        <input type="text" name="last_name" value="<?php echo $last_name; ?>" class="form-control" id="lastName" placeholder="Last Name">
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" value="<?php echo $password; ?>" class="form-control" id="registerPass" placeholder="Password">
                    </div>
                    <div class="mb-3">
                        <input type="password" name="confirm_password" value="<?php echo $confirm_password;?>" class="form-control" id="registerConfirmPass" placeholder="Confirm Password">
                    </div>


                    <div class="mb3">

                        <div class="form-check">

                            <?php if(isset($admin) && $admin == 1): ?>

                                <input class="form-check-input" type="checkbox" name="admin"  id="flexCheckDefault" checked>
                                <label class="form-check-label" for="flexCheckDefault">
                                    Admin role
                                </label>

                            <?php else: ?>

                                <input class="form-check-input" type="checkbox" name="admin" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Admin role
                                </label>

                            <?php endif; ?>

                            
                            
                        </div>

                    </div>
                    
                    <button type="submit" name="create-admin" class="btn btn-light admin-form-btn">Create</button>

                </form>

            </div>

        </div>

    </div>

    <script type="text/javascript" src="../../script/admin_script.js"></script>
</body>
</html>