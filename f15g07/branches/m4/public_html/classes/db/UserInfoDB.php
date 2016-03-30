<?php

/**
 * UserInfoDB provides functions to retrieve user information
 * from the database.
 * @author sai
 */
class UserInfoDB extends DatabaseHelper{
    const TABLE = '`login`';
    const FIRST_NAME = '`first_name`';
    const LAST_NAME = '`last_name`';
    const EMAIL = '`user_email`';
    const PASSWORD = '`user_pass`';
    const CONFIRM_PASSWORD = '`user_confirm`';
    const USER_NAME = '`user_name`';
    const PHONE_NUMBER = '`user_phone`';
    const RESTAURANT_ID = '`rest_id`';
    const FLAG          = '`flag`';


public static function getUser($email, $pass) {
        $user = null;

       /* $fields = array(
            
            UserInfoDB::FIRST_NAME,
            UserInfoDB::LAST_NAME,
            UserInfoDB::EMAIL,
            UserInfoDB::PASSWORD,
            UserInfoDB::CONFIRM_PASSWORD,
            UserInfoDB::USER_NAME,
            UserInfoDB::PHONE_NUMBER
        );*/
        
        $con = parent::createConnection();
        $statement = mysqli_prepare($con,"SELECT first_name, last_name, user_email, user_pass, user_confirm,
           user_name, user_phone, rest_id,
           flag FROM login WHERE user_email = '$email' AND user_pass = '$pass'");
                
        $statement->execute();
        $statement->bind_result($firstName, $lastName, $email, $pass, $confirmPass,
                $userName, $phoneNumber, $restid, $flag);
        
        if($statement->fetch()) {
            $user = new UserInfo($email, $pass);
            $user->firstname = $firstName;
            $user->lastname  = $lastName;
            $user->confirmpassword = $confirmPass;
            $user->username = $userName;
            $user->phonenumber = $phoneNumber;
            $user->restid   = $restid;
            $user->flag     = $flag;
        }
        
        $statement->close();
        return $user;

}

public static function getUserById($id) {
    $user = null;

       /* $fields = array(
            
            UserInfoDB::FIRST_NAME,
            UserInfoDB::LAST_NAME,
            UserInfoDB::EMAIL,
            UserInfoDB::PASSWORD,
            UserInfoDB::CONFIRM_PASSWORD,
            UserInfoDB::USER_NAME,
            UserInfoDB::PHONE_NUMBER
        );*/
        
        $con = parent::createConnection();
        $statement = mysqli_prepare($con,"SELECT first_name, last_name, user_email, user_pass, user_confirm,
           user_name, user_phone FROM login WHERE user_id = '$id'");
                
        $statement->execute();
        $statement->bind_result($firstName, $lastName, $email, $pass, $confirmPass,
                $userName, $phoneNumber);
        
        if($statement->fetch()) {
            $user = new UserInfo($email, $pass);
            $user->firstname = $firstName;
            $user->lastname  = $lastName;
            $user->confirmpassword = $confirmPass;
            $user->username = $userName;
            $user->phonenumber = $phoneNumber;
        }
        
        $statement->close();
        return $user;

}
} 
/*
       $statement = mysqli_prepare($con,
            ' SELECT ' . implode(', ', $fields) .
            ' FROM ' . UserInfoDB::TABLE .
            ' WHERE ' . UserInfoDB::EMAIL . ' = ?'.
            ' AND ' . UserInfoDB::PASSWORD . ' = ?'
        );*/
/*$statement = mysqli_prepare($con,"SELECT first_name, last_name, user_email, user_pass, user_confirm,
           user_name, user_phone FROM login WHERE user_email = 'email' AND user_pass = '$pass'");
                 */