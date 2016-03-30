<?php
/**
 * RegisterSignup stores the User information from Signup into the Database and provides a link to Login for User.
 *
 * @author Sai Krishna
 */

require_once 'includes/config.php';
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
                        <div class="account-wall3">
                            <h1 class="text-center login-title" style="text-align: center; font-family: cursive; color:#5a636e">You have registered sucessfully!</h1>

                           
                            <center><div class="caption">
                                    <?php

$first_name = trim($_POST["first_name"]);
$last_name  = trim($_POST["last_name"]);
$email      = trim($_POST["email"]);
$password   = md5(trim($_POST["password"]));
$password_confirmation = md5(trim($_POST["password_confirmation"]));
$user_name  = trim($_POST["user_name"]);
$user_phone = trim($_POST["user_phone"]);

 //session_start();session_destroy();
 //session_start();
if($first_name && $last_name && $email && $password && $password_confirmation && $user_name && $user_phone )
{
	if($password==$password_confirmation)
	{
            $reg_user = InsertUserInfoDB::insertUserInfo($first_name, $last_name, $email, $password, 
                    $password_confirmation, $user_name, $user_phone);

        print "<p><a href='signin.php'>Go to login page</a></p>";
	}
	else print "Passwords doesnt match";
}
else print"Invaild input data";

?>
                                    <br>
                                    <script>
                                        document.getElementsByClassName('dropdown')[0].style.visibility = 'hidden';
                                        document.getElementsByClassName('dropup')[0].style.visibility = 'hidden';
                                    </script>
                                                                  </div></center>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </div>

    
<?php
require_once 'includes/footer.php';
