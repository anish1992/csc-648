<!--
    Navbar with search bar
-->
<div id="custom-bootstrap-menu" class="navbar navbar-default " role="navigation" style="margin-bottom: 0;">
    <div class="container-fluid">
        <div class="navbar-header"><a class="navbar-brand" style="color:goldenrod; padding: 0; margin:-0.5em 0 0 0;" href="index.php"><h1><?php echo TITLE; ?><span class="glyphicon glyphicon-cutlery"></span></h1></a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span cltoggleass="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <!-- Search Bar-->
        <div class="navbar" style="margin-left: 20em">
            <?php include 'search_bar.php'; ?>
        </div>

        <!-- location set up -->
        <div class="collapse navbar-collapse navbar-menubuilder">
            <ul class="nav navbar-nav navbar-right" style="padding: 0; margin:-4.2em 0 0 0;">
                <?php if (!isset($_SESSION['user'])) { ?>                                                                              <!-- href="signup.php"-->
                    <li><h4 style="padding-right: 0.75em; "><a style="color:goldenrod;" data-toggle="modal" data-target="#myModal_signup">Sign Up</a></h4>
                    </li>
                <?php } else { ?>
                    <li><h4 style="padding-right: 0.75em; "><a style="color:goldenrod;" href="action.php?action=logout">LogOut</a></h4>
                    </li>
                <?php } ?>
                <?php if (!isset($_SESSION['user'])) { ?>
                    <li><h4><a style="color:goldenrod;" data-toggle="modal" data-target="#myModal_signin">Sign In</a></h4></li>
                <?php } else { ?>
                    <li><h4><a style="color:goldenrod;" href="#" id="menu-toggle"><?php echo $_SESSION['user']->username ?></a></h4></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
<?php require_once 'includes/signin_dropdown.php';?>