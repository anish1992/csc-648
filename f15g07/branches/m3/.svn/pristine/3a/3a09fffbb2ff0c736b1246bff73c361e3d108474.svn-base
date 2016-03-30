<?php

/**
 * Description of DatabaseHelper
 *
 * @author Gary Ng
 */
abstract class DatabaseHelper {

    public function createConnection() {
        global $config;
        $db = $config['db'];

        $con = mysqli_connect($db['host'], $db['user'], $db['password'], $db['database']);
        if (mysqli_connect_errno($con)) {
            throw new Exception('Failed DB Connection!');
        }

        mysqli_set_charset($con, 'utf8');

        return $con;
    }
}
