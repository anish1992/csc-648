<?php

/**
 * Description of RestaurantDB
 *
 * @author Gary Ng
 */
class RestaurantDB extends DatabaseHelper {

    public static function searchByName($name, $limit) {
        $restaurants = array();

        $con = parent::createConnection();
        $statement = mysqli_prepare($con,
            ' SELECT ' . RestaurantVars::ID .
            ' FROM ' . RestaurantVars::TABLE .
            ' WHERE ' . RestaurantVars::NAME . ' LIKE ?' .
            ' ORDER BY ' . RestaurantVars::NAME .
            ' LIMIT ?'
        );

        $like = "%{$name}%";

        $statement->bind_param('si', $like, $limit);
        $statement->execute();

        $statement->bind_result($id);

        while ($statement->fetch()) {
            $restaurant = RestaurantDB::getRestaurantById($id);
            array_push($restaurants, $restaurant);
        }

        $statement->close();

        return $restaurants;
    }

    public static function searchByTag($tag, $limit) {
        $restaurants = array();

        $con = parent::createConnection();
        $statement = mysqli_prepare($con,
            ' SELECT ' . RestaurantVars::ID .
            ' FROM ' . RestaurantVars::TABLE .
            ' WHERE ' . RestaurantVars::TAGS . ' LIKE ?' .
            ' ORDER BY ' . RestaurantVars::NAME .
            ' LIMIT ?'
        );

        $like = "%{$tag}%";

        $statement->bind_param('si', $like, $limit);
        $statement->execute();

        $statement->bind_result($id);

        while ($statement->fetch()) {
            $restaurant = RestaurantDB::getRestaurantById($id);
            array_push($restaurants, $restaurant);
        }

        $statement->close();

        return $restaurants;
    }

    public static function createRestaurant($key, $name, $desc, $tags) {
        $con = parent::createConnection();

        $statement = mysqli_prepare($con,
            ' INSERT INTO ' . RestaurantVars::TABLE . ' (' .
            RestaurantVars::KEY . ', ' .
            RestaurantVars::NAME . ', ' .
            RestaurantVars::DESC . ', ' .
            RestaurantVars::TAGS .
            ') VALUES (?, ?, ?, ?)'
        );

        $statement->bind_param('ssss', $key, $name, $desc, $tags);
        $statement->execute();

        $statement->close();
    }

    public static function getRestaurantById($id) {
        $restaurant = null;

        $con = parent::createConnection();

        $statement = mysqli_prepare($con,
            ' SELECT ' .
            RestaurantVars::KEY . ', ' .
            RestaurantVars::NAME . ', ' .
            RestaurantVars::DESC . ', ' .
            RestaurantVars::TAGS .
            ' FROM ' . RestaurantVars::TABLE .
            ' WHERE ' . RestaurantVars::ID . ' = ?'
        );

        $statement->bind_param('i', $id);
        $statement->execute();

        $statement->bind_result($key, $name, $desc, $tags);

        if ($statement->fetch()) {
            $restaurant = new Restaurant($id);
            $restaurant->id = $id;
            $restaurant->key = $key;
            $restaurant->name = $name;
            $restaurant->desc = $desc;
            $restaurant->tags = $tags;
        }

        $statement->close();
        
        return $restaurant;
    }

    public static function getRestaurantByKey($key) {
        $restaurant = null;

        $con = parent::createConnection();

        $statement = mysqli_prepare($con,
            ' SELECT ' .
            RestaurantVars::ID . ', ' .
            RestaurantVars::KEY . ', ' .
            RestaurantVars::NAME . ', ' .
            RestaurantVars::DESC . ', ' .
            RestaurantVars::TAGS .
            ' FROM ' . RestaurantVars::TABLE .
            ' WHERE ' . RestaurantVars::KEY . ' = ?'
        );

        $statement->bind_param('s', $key);
        $statement->execute();

        $statement->bind_result($id, $key, $name, $desc, $tags);

        if ($statement->fetch()) {
            $restaurant = new Restaurant($id);
            $restaurant->key = $key;
            $restaurant->name = $name;
            $restaurant->desc = $desc;
            $restaurant->tags = $tags;
        }

        $statement->close();
        
        return $restaurant;
    }
}

class RestaurantVars {
    const TABLE = '`restaurant`';
    const ID = '`id`';
    const KEY = '`key`';
    const NAME = '`name`';
    const DESC = '`description`';
    const TAGS = '`tags`';
}
