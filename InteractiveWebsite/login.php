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
    <title>CodeStructure - Log In</title>
    <!-- HEAD // HEAD // HEAD -->
    <?php include("includePHP/head.php"); ?>
</head>
<body>
    
    <form action="login.php" method="post" class="authForm">
        <div class="container-fluid">
            <div class="mb-3">

                <a href="index.php">

                    <img src="<?php echo BASE_URL . '/interactive/images/InteractiveWebsite_Logo_2.png';?>" alt="" width="105" height="105" class="img-fluid authForm-image">

                </a>
                <h2 class="forgot-pass-title">Log In</h2>

            </div>

            <div class="authForm-content">

                <?php include("./app/helpers/formErrors.php");?>

                <div class="mb-3">
                <input type="email" name="email" value="<?php echo $email; ?>" class="form-control" placeholder="Email">
                </div>
            
                <div class="mb-3">
                <input type="password" value="<?php echo $password; ?>" name="password" class="form-control" placeholder="Password">
                </div>
                

                <button type="submit" name="login-btn" class="btn btn-light auth-btn-form">Log In</button>

                <div class="mb-3 authForm-links">

                    <h6 class="authForm-link-text">Don't have an account? <a href="register.php" class="authForm-link">Sign In</a></h6>

                </div>

            </div>
                
        </div>

    </form>

    <div class="footerSpacing-authForm-login"></div>

    <?php include("includePHP/footer.php"); ?>
</body>
</html>