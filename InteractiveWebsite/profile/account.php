<?php

include("../includePhp/path.php");
include(STANDARD_PATH . "/app/controllers/users.php");
include(STANDARD_PATH . "/app/permissions.php");
usersOnly();

$users = selectAll('users');

if(isset($_SESSION['id'])){

    $user = selectOne('users', ['id' => $_SESSION['id']]);
   
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>CodeStructure - Account</title>
    <!-- HEAD // HEAD // HEAD -->
    <?php include(STANDARD_PATH . "/includePHP/head.php"); ?>

</head>

<body>

    <?php include(STANDARD_PATH . "/includePHP/logged_nav.php"); ?>

    <div class="account-content">
    
        <div class="container-fluid">
            
            <?php include(STANDARD_PATH . "/includePHP/messages.php"); ?>

            <div class="account-header">
            
                <h3 class="account-title">Personal Info</h3>
                <div class="account-line"></div>
            
            </div>

            <form action="account.php" method="post" class="reset-acc-form personal-info-form">

                <?php include(STANDARD_PATH . "/app/helpers/formErrors.php");?>
               

                <div class="mb-3">
                    <input type="hidden" name="id" value="<?php echo $user['id']?>">
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="<?php echo $user['email']; ?>">
                </div>
            
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="first_name" value="<?php echo $user['first_name']; ?>">
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="last_name" value="<?php echo $user['last_name']; ?>">
                </div>
            
                <button type="submit" class="btn btn-light update-btn" name="update-account-info">Update personal info</button>

            </form>

            
            <div class="account-header pass-header">
            
                <h3 class="account-title">Reset password</h3>
                <div class="account-line"></div>
            
            </div>

            <form action="account.php" method="post" class="reset-pass-form personal-info-form">

                <?php include(STANDARD_PATH . "/app/helpers/formErrors.php");?>

                <div class="mb-3">
                    <input type="hidden" name="id" value="<?php echo $user['id']?>">
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="password">
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="confirm_password">
                </div>
            
                <button type="submit" class="btn btn-light update-btn" name="update-account-pass">Update password</button>

            </form>

        </div>
    
    </div>

    <?php include(STANDARD_PATH . "/includePHP/footer.php"); ?>

</body>

</html>