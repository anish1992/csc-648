<?php
require_once 'includes/config.php';
$title = 'Welcome to AlpacaTable!';
require_once 'includes/header.php';
require_once 'includes/law.php';
require_once 'includes/nav.php';
require_once 'includes/signin.php';
?>
<div class="sidebar-wrapper2" align="center" id="sidebar-nav">
      <li class="sidebar-brand">
          <div class="container2">
            <div class="row2">
              <div class="box_setup2">
                <div class="account-wall2" align="center">
                  <h2 class="text-center login-title">Sign Up</h2>
                    <form class="form-signin" action="" method="POST">
                      <input type="first_name" class="form-control" placeholder="First Name" required>
                      <input type="last_name" class="form-control" placeholder="Last Name" required>
                      <input type="text" class="form-control" placeholder="Email" required autofocus>
                      <input type="password" class="form-control" placeholder="Password" required>
                      <input type="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                      <input type="user_name" class="form-control" placeholder="Username" required>
                      <input type="phone_number" class="form-control" placeholder="Phone Number (Optional)" required>
                      <button class="btn btn-lg btn-primary btn-block btn-success" type="submit" value="register">
                          Sign Up</button>
                        <label class="checkbox pull-left">
                            <input type="checkbox" value="send-recommendation">
                            Send Offers
                        </label>
                        <a href="#" class="pull-right need-help">Need help? </a><span class="clearfix"></span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
      </li>
  </div>