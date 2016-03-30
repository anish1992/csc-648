<?php

/**
 * RestaurantHoursDB provides functions to either insert or retrieve
 * restaurant hours from the database.
 *
 * @author Gary Ng
 */
class RestaurantHoursDB extends DatabaseHelper {

    const TABLE = '`restaurant_hours`';
    const ID = '`restaurant_id`';
    const DAY = '`day`';
    const START_TIME = '`start_time`';
    const END_TIME = '`end_time`';

    /**
     * Retrieves restaurant hours.
     */
    public static function getHours($id) {
        $hours = array();

        $fields = array(
            RestaurantHoursDB::DAY,
            RestaurantHoursDB::START_TIME,
            RestaurantHoursDB::END_TIME
        );

        $con = parent::createConnection();
        $statement = mysqli_prepare($con,
            ' SELECT ' . implode(', ', $fields) .
            ' FROM ' . RestaurantHoursDB::TABLE .
            ' WHERE ' . RestaurantHoursDB::ID . ' = ?' .
            ' ORDER BY ' . RestaurantHoursDB::DAY
        );

        $statement->bind_param('i', $id);
        $statement->execute();

        $statement->bind_result($day, $startTime, $endTime);

        while ($statement->fetch()) {
            $hours[$day] = array($startTime, $endTime);
        }

        $statement->close();

        return $hours;
    }

    /**
     * Insert restaurant hours.
     */
    public static function insertHours($id, $day, $startTime, $endTime) {
        $fields = array(
            RestaurantHoursDB::RESTAURANT_ID,
            RestaurantHoursDB::DAY,
            RestaurantHoursDB::START_TIME,
            RestaurantHoursDB::END_TIME
        );

        $con = parent::createConnection();
        $statement = mysqli_prepare($con,
            ' INSERT INTO ' . RestaurantHoursDB::TABLE . ' (' .
            implode(', ', $fields) .
            ') VALUES (?, ?, ?, ?)'
        );

        $statement->bind_param('iiii', $id, $day, $startTime, $endTime);
        $statement->execute();

        $success = $statement->affected_rows > 0;

        $statement->close();

        return $success;
    }

    /**
     * Update restaurant hours.
     */
    public static function updateHours($id, $day, $startTime, $endTime) {
        $fields = array(
            RestaurantHoursDB::DAY . ' = ?',
            RestaurantHoursDB::START_TIME . ' = ?',
            RestaurantHoursDB::END_TIME . ' = ?'
        );

        $con = parent::createConnection();
        $statement = mysqli_prepare($con,
            ' UPDATE ' . RestaurantHoursDB::TABLE .
            ' SET ' . implode(', ', $fields) .
            ' WHERE ' . RestaurantHoursDB::ID . ' = ?'
        );

        $statement->bind_param('iiii', $day, $startTime, $endTime, $id);
        $statement->execute();

        $success = $statement->affected_rows > 0;

        $statement->close();

        return $success;
    }
}
