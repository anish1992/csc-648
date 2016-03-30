</div>
    <div id="footer">
        <ul class="nav navbar-nav">
<?php
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    
    if ($user->flag == UserInfo::ADMIN_FLAG) {
?>
            <li class="admin"><a href="admin.php"><h5 style="color:goldenrod;">Web Admin Page</h5></a></li>
<?php
    }

    if ($user->flag == UserInfo::HOST_FLAG) {
?>
            <li class="host"><a href="Host_Auth.php"><h5 style="color:goldenrod;">Host Page</h5></a></li>
<?php
    }
}
?>
            <li class="about"><a href="about.php"><h5 style="color:goldenrod;">About</h5></a></li>
        </ul>
        <center></center>
        <ul class="nav navbar-nav navbar-right">
            <li><h4 style="color: goldenrod; margin-right: 2em;margin-top:1em; "><span class="glyphicon glyphicon-copyright-mark"></span> 2015 <?php echo TITLE; ?></h4></li>
        </ul>
    </div>
</div>
</body>
</html>
