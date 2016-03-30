<?php

/**
 * DatabaseHelper provides a function to connect to the database.
 *
 * @author Gary Ng
 */
abstract class DatabaseHelper {

    /**
     * Creates and returns a connection to the database.
     */
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
