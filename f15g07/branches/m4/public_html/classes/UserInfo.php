<?php
/**
 * UserInfo is used to store the session info of an user.
 *
 * @author sai
 */
class UserInfo {
    
    const HOST_FLAG = '1';
    const ADMIN_FLAG = '2';

    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $confirmpassword;
    public $username;
    public $phonenumber;
    public $restid;
    public $flag;

    function __construct($email,$pass) {
        $this->email     = $email;
        $this->password  = $pass;
        
    }
    public function toArray(){
        return array(
            'first_name'  => $this->firstname,
            'last_name'   => $this->lastname,
            'user_email'  => $this->email,
            'user_pass'   => $this->password,
            'user_confirm'=> $this->confirmpassword,
            'user_name'   => $this->username,
            'user_phone'  => $this->phonenumber,
            'rest_id'     => $this->restid,
            'flag'        => $this->flag
        );
    }
}
