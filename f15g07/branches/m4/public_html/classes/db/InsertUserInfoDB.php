<?php

/**
 *  InsertUserInfoDB implodes the user data in the database from Signup page.
 *  And User related functions.
 * @author sai
 */
class InsertUserInfoDB extends DatabaseHelper{
    const TABLE = '`login`';
    const ID    = '`user_id`';
    const FIRST_NAME = '`first_name`';
    const LAST_NAME = '`last_name`';
    const EMAIL = '`user_email`';
    const PASSWORD = '`user_pass`';
    const CONFIRM_PASSWORD = '`user_confirm`';
    const USER_NAME = '`user_name`';
    const PHONE_NUMBER = '`user_phone`';

public static function insertUserInfo($firstname,$lastname,$email,$password,
        $confirmpassword,$username,$userphone){
    
    $user = null;
        
        $fields = array(
            InsertUserInfoDB::FIRST_NAME,
            InsertUserInfoDB::LAST_NAME,
            InsertUserInfoDB::EMAIL,
            InsertUserInfoDB::PASSWORD,
            InsertUserInfoDB::CONFIRM_PASSWORD,
            InsertUserInfoDB::USER_NAME,
            InsertUserInfoDB::PHONE_NUMBER
        );

        $con = parent::createConnection();
        $statement = mysqli_prepare($con,
            ' INSERT INTO ' . InsertUserInfoDB::TABLE . ' (' .
            implode(', ', $fields) .
            ') VALUES (?, ?, ?, ?, ?, ?, ?)'
        );

        $statement->bind_param('ssssssi', $firstname, $lastname, $email, $password, $confirmpassword,
                $username, $userphone);
        $statement->execute();
        
       /* if ($statement->affected_rows > 0) {
            $id = $statement->insert_id;
            $user = InsertUserInfoDB::getRestaurantById($id);
        }*/

        $statement->close();
        
        //return $user;
    }
    
    public static function getUserId($email) {
        $user = null;$ID = null;
        $con = parent::createConnection();
        $statement = mysqli_prepare($con,"SELECT user_id FROM login WHERE user_email = '$email'");
            
        $statement->execute();
        $statement->bind_result($ID);
        
        if ($statement->fetch()) {
            $user = new UserID($ID);
        }
        
        $statement->close();
        return $user;
         
         
        
    }

    public static function getUser($name,$email,$userphone) {
        $user = null;
        
        $fields = array(
            InsertUserInfoDB::FIRST_NAME,
            //InsertUserInfoDB::LAST_NAME,
            InsertUserInfoDB::EMAIL,
            //InsertUserInfoDB::PASSWORD,
            //InsertUserInfoDB::CONFIRM_PASSWORD,
            //InsertUserInfoDB::USER_NAME,
            InsertUserInfoDB::PHONE_NUMBER
        );

        $con = parent::createConnection();
        $statement = mysqli_prepare($con,
            ' INSERT INTO ' . InsertUserInfoDB::TABLE . ' (' .
            implode(', ', $fields) .
            ') VALUES (?, ?, ?)'
        );

        $statement->bind_param('ssi', $name, $email, $userphone);
        $statement->execute();
        
        if ($statement->affected_rows > 0) {
            $id = $statement->insert_id;
            $user = InsertUserInfoDB::getUserById($id);
        }

        $statement->close();
        
        return $user;
    }
    
    public static function getUserByParam($type, $value) {
        $user = null;

        $fields = array(
            InsertUserInfoDB::ID,
            InsertUserInfoDB::FIRST_NAME,
            InsertUserInfoDB::LAST_NAME,
            InsertUserInfoDB::EMAIL,
            InsertUserInfoDB::PASSWORD,
            InsertUserInfoDB::CONFIRM_PASSWORD,
            InsertUserInfoDB::USER_NAME,
            InsertUserInfoDB::PHONE_NUMBER
        );

        $con = parent::createConnection();

        if ($type === InsertUserInfoDB::ID) {
            $statement = mysqli_prepare($con,
                ' SELECT ' . implode(', ', $fields) .
                ' FROM ' . InsertUserInfoDB::TABLE .
                ' WHERE ' . InsertUserInfoDB::ID . ' = ?'
            );

            $statement->bind_param('i', $value);
        } else if ($type === InsertUserInfoDB::KEY) {
            $statement = mysqli_prepare($con,
                ' SELECT ' . implode(', ', $fields) .
                ' FROM ' . InsertUserInfoDB::TABLE .
                ' WHERE ' . InsertUserInfoDB::KEY . ' = ?'
            );

            $statement->bind_param('s', $value);
        } 
         

        if (!isset($statement)) {
            return null;
        }

        $statement->execute();

        $statement->bind_result($id, $firstname, $lastname, $email, $password, $confirmpassword,
                $username, $userphone);

        if ($statement->fetch()) {
            $user = new UserID($id);
            $user->firstname = $firstname;
            $user->lastname = $lastname;
            $user->email = $email;
            $user->password = $password;
            $user->confirmpassword = $confirmpassword;
            $user->username = $username;
            $user->phonenumber = $userphone;
            

            }

        $statement->close();
        
        return $user;
    }

public static function getUserById($id) {
        return InsertUserInfoDB::getUserByParam(InsertUserInfoDB::ID, $id);
    }

} 

