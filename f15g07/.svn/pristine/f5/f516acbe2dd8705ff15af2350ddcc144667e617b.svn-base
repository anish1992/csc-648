<?php
$db = array(
    "host" => "sfsuswe.com",
    "user" => "gng",
    "password" => "",
    "database" => "student_gng",
);

function createConnection() {
    global $db;

    $con = mysqli_connect($db["host"], $db["user"], $db["password"], $db["database"]);
    if (mysqli_connect_errno($con)) {
        throw new Exception("Failed DB Connection!");
    }

    mysqli_set_charset($con, "utf8");

    return $con;
}

class M0_IMAGES {
    const TABLE = "`m0_images`";
    const ID = "`id`";
    const NAME = "`name`";
    const DESC = "`description`";
    const PATH = "`path`";
}

class MainDB {

    public static function select($name) {
        $con = createConnection();

        $statement = mysqli_prepare($con,
            " SELECT " . M0_IMAGES::DESC . ", " . M0_IMAGES::PATH .
            " FROM " . M0_IMAGES::TABLE .
            " WHERE " . M0_IMAGES::NAME . " = ?" .
            " ORDER BY " . M0_IMAGES::ID . " DESC" .
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

    public static function insert($name, $desc, $path) {
        $con = createConnection();

        $statement = mysqli_prepare($con,
            " INSERT INTO " . M0_IMAGES::TABLE. " (" . M0_IMAGES::NAME . ", " . M0_IMAGES::DESC . ", " . M0_IMAGES::PATH . ")" .
            " VALUES (?, ?, ?)"
        );

        $statement->bind_param("sss", $name, $desc, $path);
        $statement->execute();

        $statement->close();
    }
}
