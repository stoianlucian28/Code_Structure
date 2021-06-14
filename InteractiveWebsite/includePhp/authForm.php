<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade authForm" id="authForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="loginModalForm" id="login-form">
          <div class="modal-header authForm-bg-color authForm-header">
            <h5 class="modal-title authForm-title" id="exampleModalLabel">Log In</h5>
            <img src="./images/InteractiveWebsite_Logo_2.png" alt="" width="90" height="90" class="d-inline-block align-top authForm-image">
            <!-- <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button> -->
          </div>
          <div class="modal-body authForm-bg-color authForm-body">
            <form>
              <div class="mb-3">
                <input type="email" class="form-control" id="loginEmail" aria-describedby="emailHelp" placeholder="Email">
              </div>
              <div class="mb-3">
                <input type="password" class="form-control" id="loginPass" placeholder="Password">
              </div>

              <button type="button"  class="btn btn-light login-btn-form" >Log in</button>
              <div class="mb-3 login-links-container">
                  <a href="forgotPass.php" class="forgot-pass-login">Forgot password?</a>
                  <h6 class="newuser-link-text">New user? <a id="access-signup-link" class="newuser-link-login">Sign Up!</a></h6>
              </div>
            </form>
          </div>
        </div>

        <div class="registerModalForm" id="signup-form">
          <div class="modal-header authForm-bg-color authForm-header">
            <h5 class="modal-title authForm-title" id="exampleModalLabel">Sign Up</h5>
            <img src="./images/InteractiveWebsite_Logo_2.png" alt="" width="90" height="90" class="d-inline-block align-top authForm-image">
            <!-- <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button> -->
          </div>
          <div class="modal-body authForm-bg-color authForm-body">
            <form action="./index.php" method="post" id="registrationForm">

              
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

              <button type="submit" name="register-btn" class="btn btn-light register-btn-form">Sign Up</button>
              <div class="mb-3 register-links-container">
                  <h6 class="alreadyuser-link-text">Already an user? <a id="access-login-link"  class="alreadyuser-link-login">Log In</a></h6>
              </div>
            </form>
          </div>
        
        </div>
    </div>
  </div>
</div>

