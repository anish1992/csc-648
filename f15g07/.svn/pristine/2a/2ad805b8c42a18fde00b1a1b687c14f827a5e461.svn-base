<?php
/**
 * ValidateLogin retrieves the Username and Password information from Lgin and does the authentication looking into the Database.
 *
 */
session_start(); //Starting session
require_once 'includes/config.php';

// Grab User submitted information

$useremail = $_POST["luser_email"];
$pass = $_POST["luser_pass"];
$link = $_POST["return_link"];



if (!isset($useremail) && !isset($pass)) {
    exit;
}

$useremail = trim($useremail);
$pass = md5(trim($pass));

$user = UserInfoDB::getUser($useremail,$pass);

if (!$user) { // add this check.
    echo json_encode(array('status' => false));
}
elseif ($user->flag == UserInfo::HOST_FLAG) {
    $_SESSION['user'] = $user;
    echo json_encode(array('status' => true, 'url' => 'host.php'));

}
elseif ($user->flag == UserInfo::ADMIN_FLAG) {
    $_SESSION['user'] = $user;
    echo json_encode(array('status' => true, 'url' => 'admin.php'));

}else {
    // output data of each row
    $_SESSION['user'] = $user;
    echo json_encode(array('status' => true, 'url' => $link));
}
