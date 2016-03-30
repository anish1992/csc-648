<?php
require_once 'includes/config.php';

$name = filter_input(INPUT_GET, 'custName');
$email = filter_input(INPUT_GET, 'custEmail');
$num = filter_input(INPUT_GET, 'custNumber');
$at = filter_input(INPUT_GET, 'time');
$p = filter_input(INPUT_GET, 'party');
$rest = filter_input(INPUT_GET, 'rest');
$restaurantId = RestaurantDB::getRestaurantByKey($rest);
//$timeslot = ReservationDB::getAvailableTimeSlots($restaurantId->id);

// Retrieving User object using their email.
$user = InsertUserInfoDB::getUserId($email); 

// Checking if the user is a Registered user or a Guest user.
if(!$user){
// For Guest users entering their info into "login" table and retrieving the user object. 
   $user = InsertUserInfoDB::getUser($name, $email, $num);
   
}
 $uid = trim($user->id); // User ID
 

$rname = trim($restaurantId->name);
$rid = trim($restaurantId->id);
// Creating an entry in "reservation" table.
$reservation = ReservationDB::createReservation($rid, $uid, $name, $num, $at, $p, $rname);

if ($reservation != null) {
    echo json_encode(array(
        'status'    => true,
        'id'        => $reservation->id
    ));
} else {
    echo json_encode(array(
        'status'    => false
    ));
}
