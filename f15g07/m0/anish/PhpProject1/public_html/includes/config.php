<?php

$config = array(
    'db' => array(
        'host' => 'sfsuswe.com',
        'user' => 'f15g07',
        'password' => 'sfsu2015',
        'database' => 'student_f15g07',
    )
);

$classesDirs = array(
    'classes/',
    'classes/db/'
);

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
