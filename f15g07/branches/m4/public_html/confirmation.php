<?php
require_once 'includes/config.php';

$title = 'Welcome to ' . TITLE . '!';
require_once 'includes/header.php';
require_once 'includes/law.php';
require_once 'includes/nav.php';

$id = filter_input(INPUT_GET, 'id');

if (isset($id)) {
    $reservation = ReservationDB::getReservation($id);
    $Restaurant = RestaurantDB::getRestaurantById($reservation->restaurantId);
    $user = $reservation->user;

    if ($reservation != null) {
        $name = $reservation->custName;
        $email = $user->email;
        $num = $reservation->custPhone;
        $at = $reservation->time;
        $rest = $Restaurant->name;
        $p = $reservation->partySize;
        display($name, $email, $num, $at, $rest, $p, $id, $Restaurant);
    }
}

function display($name, $email, $num, $at, $rest, $p, $id,$restaurant) {
    ?>
    <center><div class="alert alert-danger">  

        <h style="margin:0; padding: 0;">
            <span class="glyphicon glyphicon-warning-sign" ></span>
            We are sorry due to a technicality we are unable to send you a confirmation email Your reservation number is 
            <strong><?php echo $id ?></strong>
        </h>
        
        <button type="button" class="close" data-dismiss="alert"  aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="hud col-xs-10" >
            <div class="mainselection row" id="main">
                <div class="top left"></div>
                <div class="top right"></div>
                <div class="bottom left"></div>
                <div class="bottom right"></div>
                <div class="row2">
                    <div class="box_setup2">
                        <div class="account-wall3">
                            <h1 class="text-center login-title" style="text-align: center; font-family: cursive;"> Your Reservation is Confirmed!</h1>

                            <?php
                            require_once 'includes/rest-head.php';
                            ?>
                            <div class="caption">
                                <h3 style="color: goldenrod;">
                                    Your reservation number is <?php echo $id ?>. <br>
                                    Your reservation is at <i><?php echo $rest ?></i> <br>
                                    for <i><?php echo $p ?></i> <br>
                                    at <i><?php echo $at; ?></i> hr<br>
                                    An email will also be sent to your <i><?php echo $email; ?></i>.
                                </h3> 
                                <h4 class="confirm-p" style="color: goldenrod;">
                                    Thank you for making a reservation <?php echo $name; ?><br>
                                    Please tell your friends about us.
                                </h4>

                                <br>

                                <p align="center"><a href="index.php" class="btn btn-primary" role="button">Make another reservation</a></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div></center>

    <?php
}

require_once 'includes/footer.php';
