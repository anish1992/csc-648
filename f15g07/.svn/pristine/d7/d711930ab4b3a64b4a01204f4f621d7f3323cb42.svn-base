<?php
require_once '../config/config.php';

// Stores directories containing classes for autoload function.
$classesDirs = array(
    'classes/',
    'classes/db/'
);
/**
 * Autoload function is automatically called to include needed classes.
 */
function __autoload($class) {
    global $classesDirs;

    foreach ($classesDirs as $directory) {
        $filename = $directory . $class . '.php';

        if (file_exists($filename)) {
            require_once($filename);
            return;
        }
    }
}

define('TITLE', 'AlpacaTable');

// Starts a session. Config.php must be included in files requiring sessions.
if (session_id() == '') {
    session_start();
}
