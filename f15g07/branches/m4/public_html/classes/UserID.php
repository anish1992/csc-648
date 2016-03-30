<?php
/**
 * UserInfo is used to store the session info of an user.
 *
 * @author sai
 */
class UserID {
    public $id;
    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $confirmpassword;
    public $username;
    public $phonenumber;

    function __construct($id) {
        $this->id     = $id;
        
        
    }
    public function toArray(){
        return array(
            'user_id'          => $this->id,
            'first_name'  => $this->firstname,
           'last_name'   => $this->lastname,
           'user_email'  => $this->email,
           'user_pass'   => $this->password,
           'user_confirm'=> $this->confirmpassword,
           'user_name'   => $this->username,
           'user_phone'  => $this->phonenumber
        );
    }
}
