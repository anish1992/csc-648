<?php

function Connection() { // conecting to MySql

    $con = mysqli_connect("sfsuswe.com", "anish", "JX548578", "student_anish");
    if (mysqli_connect_errno($con)) {
        throw new Exception("Failed DB Connection!");
    }

    mysqli_set_charset($con, "utf8");

    return $con;
}

class MainDB {
    
    public static function select($name) { // retriving data to MySql sever
        $con = Connection();

        $sql = mysqli_prepare($con,
            " SELECT " . "'disp'" . ", " . "'path'" .
            " FROM " . "'7'" .
            " WHERE " . "'name'" . " = ?" .
            " ORDER BY " . "'id'" . " DESC" .
            " LIMIT 1"
        );

        $sql->bind_param("s", $name);
        $sql->execute();

        $sql->bind_result($desc, $path);
        
        if ($sql->fetch()) {
            $result = array("name" => $name, "desc" => $desc, "path" => $path);
        }

        $sql->close();
        
        return $result;
    }

    public static function insert($name, $desc, $path) { // loading data to MySql sever
        $con = Connection();

        $sql = mysqli_prepare($con,
            " INSERT INTO " . "'7'" . " (" . "'name'".", " . "'disp'" . ", " . "'path'" . ")" .
            " VALUES (". $name .",".$desc.",".$path.")"
        );
        mysqli_close($con);
        
    }
}