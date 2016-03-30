<?php
/**
 * Signup takes in the User deatils from user and redirects to RegisterSignup for storing the information.
 *
 * @author Sai Krishna
 */
$title = 'Welcome to AlpacaTable!';
require_once 'includes/header.php';
require_once 'includes/law.php';
require_once 'includes/nav.php';

?>
<div class="sidebar-wrapper2" align="center" id="sidebar-nav">
      <li class="sidebar-brand">
          <div class="container2">
            <div class="row2">
              <div class="box_setup2">
                <div class="account-wall2" align="center">
                  <h2 class="text-center login-title">Sign Up</h2>
                  <form class="form-signin" action="register_signup.php" method="POST">
                        <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                        <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                        <input type="text" name="email" class="form-control" placeholder="Email" required autofocus>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                        <input type="text" name="user_name" class="form-control" placeholder="Username" required>
                        <input type="tel" name="user_phone" class="form-control" placeholder="Phone Number (Optional)" required>
                      <button class="btn btn-lg btn-primary btn-block btn-success" type="submit" >
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