<?php 

include("includePhp/path.php");
include("app/controllers/users.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeStructure - Sign Up</title>
    <!-- HEAD // HEAD // HEAD -->
    <?php include("includePHP/head.php"); ?>
</head>
<body>
    
    <form action="register.php" method="post" class="authForm">
        <div class="container-fluid">
            <div class="mb-3">

                <a href="index.php">

                    <img src="<?php echo BASE_URL . '/interactive/images/InteractiveWebsite_Logo_2.png';?>" alt="" width="105" height="105" class="img-fluid authForm-image">

                </a>
                <h2 class="forgot-pass-title">Sign Up</h2>

            </div>

            <div class="authForm-content">

                <?php include("./app/helpers/formErrors.php");?>

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

                <button type="submit" name="register-btn" class="btn btn-light auth-btn-form">Sign Up</button>
                <div class="mb-3 authForm-links">
                    <h6 class="authForm-link-text">Already an user? <a href="login.php" class="authForm-link">Log In</a></h6>
                </div>

            </div>
                
        </div>
    </form>

    <div class="footerSpacing-authForm-register"></div>

    <?php include("includePHP/footer.php"); ?>
</body>
</html>