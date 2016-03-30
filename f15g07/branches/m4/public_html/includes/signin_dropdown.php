<!-- signin_form -->

<div class="modal fade" id="myModal_signin" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div style="height: 25%" ></div>
    <div class="modal-dialog modal-sm" role="document" >
        <div class="modal-content reserve-form-div well">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h2 class="modal-title" id="myModalLabel" style="text-align: center; color:goldenrod;">Sign In</h2>
            </div>
            <div class="modal-body">
                <center><?php require_once 'login_form.php'; ?></center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" style="float: left" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- signup_form -->

<div class="modal fade" id="myModal_signup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div style="height: 15%"></div>
    <div class="modal-dialog" role="document">
        <div class="modal-content reserve-form-div well" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h2 class="modal-title" id="myModalLabel" style="text-align: center; color:goldenrod;">Sign Up</h2>
            </div>
            <form class="form-signin" action="register_signup.php" method="POST">
                <div class="modal-body">
                    <center><?php require_once 'signup_form.php'; ?></center>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" style="float: left" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit" >Register</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- signin_dropdown
<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
-->
<div class="modal fade" id="myModal_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div style="height: 15%"></div>
    <div class="modal-dialog" role="document">
        <div class="modal-content reserve-form-div well" >
            <div class="modal-header">
                <h2 class="modal-title" id="user" style="text-align: center; color:goldenrod;">User Info</h2>
            </div>
            <div class="modal-body">
                <center>
                    <h4 style="color: goldenrod;">
                    <?php
                    //$timestamp = time();
                    //$uid = InsertUserInfoDB::getUserId($_SESSION['user']->email)
                    //$res = ReservationDB::getReservationsByUserId($uid,'0', '1444578');
                    echo "Username: ", $_SESSION['user']->username, "<br>",
                    "First Name: ", $_SESSION['user']->firstname, "<br>",
                    "Last Name: ", $_SESSION['user']->lastname, "<br>",
                    "Email: ", $_SESSION['user']->email, "<br>",
                    "Phone Number: ", $_SESSION['user']->phonenumber, "<br>";
                    //"last reservation made", $res->time;
                    ?>
                    </h4>
                </center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" style="float: left" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
