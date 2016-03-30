<?php
require_once 'includes/config.php';

$values = filter_input_array(INPUT_GET);
$action = $values['action'];

$controller = new ActionController();
$controller->{$action}($values);

class ActionController {

    public function logout($values) {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }

        header("Location: index.php");
    }

    public function setUserTime($values) {
        $time = $values['value'];
        
        if (!isset($time)) {
            return;
        }

        if (session_id() == '') {
            session_start();
        }

        $_SESSION['time'] = $time;
    }
    
    public function getTimeSlots($values) {
        $key = $values['key'];
        $time = $values['time'];
        $party = $values['party'];
        
        if (!(isset($key) && isset($time) && isset($party))) {
            return;
        }

        require_once 'includes/reserve_small.php';
    }
}
