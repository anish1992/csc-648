<!--

-->
<?php
require_once 'includes/config.php';

$title = 'Welcome to ' . TITLE . '!';
require_once 'includes/header.php';
require_once 'includes/law.php';
require_once 'includes/nav.php';
?>

<div style="height: 5em" ></div>
<div class="modal-dialog modal-sm" role="document" >

    <div class="modal-content reserve-form-div well">
        <div class="modal-header">
            <h2 class="modal-title" id="myModalLabel" style="text-align: center; color:goldenrod;">Host Sign In</h2>
        </div>
        <div class="modal-body">
            <div class="container" style="width:100%;">
                <div class="row" style="width:125%; margin-left: -1.85em;">
                    <div class="box_setup">
                        <div class="account-wall">
                            <form class="form-signin" action="validate_login.php" method="POST">
                                <input type="text" name='luser_email' class="form-control" placeholder="Email" required autofocus>
                                <input type="password" name='luser_pass' class="form-control" placeholder="Password" required>
                                <button class="btn btn-primary form-control" type="submit" value="Login">Log In</button>
                            </form>
                            <span id="signin-error"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">

        </div>
    </div>
</div>

<div class="modal-dialog modal-sm" role="document" >

    <div class="modal-content reserve-form-div well">
        <a href="mailto:sfsualpacateam@gmail.com?Subject=Host%20Acount%20Requirement" target="_top">
            <div class="modal-body">
                <div class="container" style="width:100%;">
                    <div class="row" style="width:125%; margin-left: -1.85em;">
                        <h4 style="color: goldenrod">
                            If you would like to host you restaurant on AlpacaTable!
                            <br> send use a email to sfsualpacateam@gmail.com
                            <br> and we will keep in touch with you.
                        </h4>   
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

<?php
require_once 'includes/footer.php';
?>
<script>
    document.getElementsByClassName('navbar-right')[0].style.visibility = 'hidden';
    document.getElementsByClassName('host')[0].style.visibility = 'hidden';
</script>