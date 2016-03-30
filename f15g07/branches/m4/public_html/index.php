<?php
require_once 'includes/config.php';

$title = 'Welcome to ' . TITLE . '!';
require_once 'includes/header.php';
require_once 'includes/law.php';
require_once 'includes/nav.php';
?>
<div class="page-container">
    <div class="slide" align="center"></div>

    <!-- CAROUSEL -->
    <div id="myCarousel" class="carousel container" style="padding-top: 5em;">
        <div class="carousel-inner">
            <div class="active item one"></div>
            <div class="item two"></div>
            <div class="item three"></div>
        </div>
    </div>
    <!-- END CAROUSEL -->

    <!-- SEARCH BAR -->
    <div class="hud col-xs-10" style="position: absolute; top: 30%; opacity: 1;">

        <div class="container">

            <div class=" hud col-xs-10">
                <div class="mainselection3 row">
                    
                    <h2>Reserve a table now, for free, with <?php echo TITLE; ?>!</h2>
                    
                </div>
            </div>
            <div class="mainselection row">
                
                <?php include 'includes/search_bar.php'; ?>
                
            </div>
        </div>
    </div>
    <!-- END SEARCH BAR-->
</div>

<?php
require_once 'includes/footer.php';
?>
