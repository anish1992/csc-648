<?php

/**
 * RestaurantTablesDB provides functions to either insert or retrieve table
 * information from the database.
 *
 * @author Gary Ng
 */
class RestaurantTablesDB extends DatabaseHelper {

    const TABLE = '`restaurant_tables`';
    const ID = '`restaurant_id`';
    const NUM_TABLES = '`num_tables`';
    const NUM_SEATS = '`num_seats`';

    /**
     * Retrieves restaurant table information.
     */
    public static function getTables($id) {
        $tables = array();

        $fields = array(
            RestaurantTablesDB::NUM_TABLES,
            RestaurantTablesDB::NUM_SEATS
        );

        $con = parent::createConnection();
        $statement = mysqli_prepare($con,
            ' SELECT ' . implode(', ', $fields) .
            ' FROM ' . RestaurantTablesDB::TABLE .
            ' WHERE ' . RestaurantTablesDB::ID . ' = ?'
        );

        $statement->bind_param('i', $id);
        $statement->execute();

        $statement->bind_result($numTables, $numSeats);

        while ($statement->fetch()) {
            $tables[$numSeats] = $numTables;
        }

        $statement->close();

        return $tables;
    }
}
