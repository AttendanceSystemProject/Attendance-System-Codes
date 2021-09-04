<?php
session_start();
if (isset($_SESSION['Admin-name'])) {
  header("location: index.php");
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Log In</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="icons/b_logo.png">
  <link rel="stylesheet" type="text/css" href="css/login.css">
  <script src="js/jquery-2.2.3.min.js"></script>
  <script>
    $(window).on("load resize ", function() {
      var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
      $('.tbl-header').css({
        'padding-right': scrollWidth
      });
    }).resize();
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      $(document).on('click', '.message', function() {
        $('form').animate({
          height: "toggle",
          opacity: "toggle"
        }, "slow");
        $('h2').animate({
          height: "toggle",
          opacity: "toggle"
        }, "slow");
      });
    });
  </script>
</head>

<body style="background-color:#f4f4f4;">
  <main>
    <main>
      <img src="icons/mu_logo.png" alt="Metropolitan University Logo" style="width:370px;height:75px;" class="center fadeIn animated" />
      <p class="headTxt fadeIn animated">Department of Electrical and Electronic Engineering</p>
      <h1 class="fadeIn animated">Biometric Attendance System</h1>
      <h2 class="fadeIn animated">Please Login with Admin E-mail and Password</h2>
      <h2 class="fadeIn animated" id="reset">Enter Your E-mail to Reset Password</h2>
      <p2></p2>
      <!-- Log In -->
      <section>
        <div class="fadeIn animated">
          <div class="login-page">
            <div class="form">
              <?php
              if (isset($_GET['error'])) {
                if ($_GET['error'] == "invalidEmail") {
                  echo '<div class="alert alert-danger">
                        This E-mail is invalid!
                      </div>';
                } elseif ($_GET['error'] == "sqlerror") {
                  echo '<div class="alert alert-danger">
                        Database connection error!
                      </div>';
                } elseif ($_GET['error'] == "wrongpassword") {
                  echo '<div class="alert alert-danger">
                        Wrong password!
                      </div>';
                } elseif ($_GET['error'] == "nouser") {
                  echo '<div class="alert alert-danger">
                        This E-mail does not exist!
                      </div>';
                }
              }
              if (isset($_GET['reset'])) {
                if ($_GET['reset'] == "success") {
                  echo '<div class="alert alert-success">
                        Check your E-mail.
                      </div>';
                }
              }
              if (isset($_GET['account'])) {
                if ($_GET['account'] == "activated") {
                  echo '<div class="alert alert-success">
                        Please Login
                      </div>';
                }
              }
              if (isset($_GET['active'])) {
                if ($_GET['active'] == "success") {
                  echo '<div class="alert alert-success">
                        The activation like has been sent
                      </div>';
                }
              }
              ?>
              <div class="alert1">xxxxxxxxxxxxxxxxxx</div>

              <form class="reset-form" action="reset_pass.php" method="post" enctype="multipart/form-data">
                <input type="email" name="email" placeholder="Enter Your E-mail" required />
                <button type="submit" name="reset_pass">Reset</button>
                <p class="message"><a href="#">Return to Login</a></p>
              </form>
              <form class="login-form" action="ac_login.php" method="post" enctype="multipart/form-data">
                <input type="email" name="email" id="email" placeholder="Enter Your E-mail" required />
                <input type="password" name="pwd" id="pwd" placeholder="Enter Your Password" required />
                <button type="submit" name="login" id="login">login</button>
                <p class="message">Forgot Password? <a href="#">Reset</a></p>
              </form>
              
            </div>
          </div>
        </div>
      </section>
    </main>
</body>

</html>