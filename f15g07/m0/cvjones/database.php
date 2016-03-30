<?php
$db = array(
    "host" => "sfsuswe.com",
    "user" => "cvjones",
    "password" => "grover99",
    "database" => "student_cvjones",
);

function connect() {
    global $db;

    $connect = mysqli_connect($db["host"], $db["user"], $db["password"], $db["database"]);
    if (mysqli_connect_errno($connect)) {
        throw new Exception("Failed to connect!");
    }

    return $connect;
}

class Images {
    const TABLE = "`images`";
    const ID = "`id`";
    const NAME = "`name`";
    const DESC = "`description`";
    const PATH = "`path`";
}

class MainDB {

    public static function select($name) {
        $connect = connect();

        $statement = mysqli_prepare($connect,
            " SELECT " . Images::DESC . ", " . Images::PATH .
            " FROM " . Images::TABLE .
            " WHERE " . Images::NAME . " = ?" .
            " ORDER BY " . Images::ID . " DESC" .
            " LIMIT 1"
        );

        $statement->bind_param("s", $name);
        $statement->execute();

        $statement->bind_result($desc, $path);
        
        if ($statement->fetch()) {
            $result = array("name" => $name, "desc" => $desc, "path" => $path);
        }

        $statement->close();
        
        return $result;
    }

    public static function insert($name, $desc, $target_file) {
        $connect = connect();

        $statement = mysqli_prepare($connect,
            " INSERT INTO " . Images::TABLE. " (" . Images::NAME . ", " . Images::DESC . ", " . Images::PATH . ")" .
            " VALUES (?, ?, ?)"
        );

        $statement->bind_param("sss", $name, $desc, $path);
        $statement->execute();

        $statement->close();
    }
}
