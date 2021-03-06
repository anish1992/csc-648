<?php

/**
 * ReservationDB provides functions to either insert or retrieve reservations
 * from the database.
 *
 * @author Gary Ng
 */
class ReservationDB extends DatabaseHelper {

    const TABLE = '`reservation`';
    const ID = '`reservation_id`';
    const RESTAURANT_ID = '`restaurant_id`';
    const USER_ID = '`user_id`';
    const TIME = '`time`';
    const PARTY_SIZE = '`party_size`';
    const NOTES = '`notes`';

    /**
     * Retrieves a reservation using a reservation ID. Returned values are
     * stored as a reservation instance.
     */
    public static function getReservation($id) {
        $reservation = null;

        $fields = array(
            ReservationDB::ID,
            ReservationDB::RESTAURANT_ID,
            ReservationDB::USER_ID,
            ReservationDB::TIME,
            ReservationDB::PARTY_SIZE,
            ReservationDB::NOTES
        );

        $con = parent::createConnection();
        $statement = mysqli_prepare($con,
            ' SELECT ' . implode(', ', $fields) .
            ' FROM ' . ReservationDB::TABLE .
            ' WHERE ' . ReservationDB::ID . ' = ?'
        );

        $statement->bind_param('i', $id);
        $statement->execute();

        $statement->bind_result($id, $restaurantId, $userId, $time, $partySize,
                $notes);

        if ($statement->fetch()) {
            $reservation = new Reservation($id);
            $reservation->restaurantId = $restaurantId;
            $reservation->userId = $userId;
            $reservation->time = $time;
            $reservation->partySize = $partySize;
            $reservation->notes = $notes;
        }

        $statement->close();

        return $reservation;
    }

    /**
     * Creates a reservation entry in the database and return the values as
     * a reservation instance.
     */
    public static function createReservation($restaurantId, $userId, $time,
            $partySize, $notes) {
        $reservation = null;

        $fields = array(
            ReservationDB::RESTAURANT_ID,
            ReservationDB::USER_ID,
            ReservationDB::TIME,
            ReservationDB::PARTY_SIZE,
            ReservationDB::NOTES
        );

        $con = parent::createConnection();
        $statement = mysqli_prepare($con,
            ' INSERT INTO ' . ReservationDB::TABLE . ' (' .
            implode(', ', $fields) .
            ') VALUES (?, ?, ?, ?, ?)'
        );

        $statement->bind_param('iiiis', $restaurantId, $userId, $time,
                $partySize, $notes);
        $statement->execute();

        if ($statement->affected_rows > 0) {
            $id = $statement->insert_id;
            $reservation = ReservationDB::getReservation($id);
        }

        $statement->close();

        return $reservation;
    }

    /**
     * Retrieves a list of reservations of a restaurant using its ID. Must
     * specify a time range in milliseconds.
     */
    public static function getReservationsByRestaurantId($id, $startTime,
            $endTime) {
        $reservations = array();

        $con = parent::createConnection();
        $statement = mysqli_prepare($con,
            ' SELECT ' . ReservationDB::ID .
            ' FROM ' . ReservationDB::TABLE .
            ' WHERE ' . ReservationDB::RESTAURANT_ID . ' = ?' .
            ' AND ' . ReservationDB::TIME . ' >= ?' .
            ' AND ' . ReservationDB::TIME . ' <= ?'
        );

        $statement->bind_param('iii', $id, $startTime, $endTime);
        $statement->execute();

        $statement->bind_result($id);

        while ($statement->fetch()) {
            $reservation = ReservationDB::getReservation($id);
            array_push($reservations, $reservation);
        }

        $statement->close();

        return $reservations;
    }

    /**
     * Retrieves a list of reservations created by a specific user using its
     * ID. Must specify a time range in milliseconds.
     */
    public static function getReservationsByUserId($id, $startTime, $endTime) {
        $reservations = array();

        $con = parent::createConnection();
        $statement = mysqli_prepare($con,
            ' SELECT ' . ReservationDB::ID .
            ' FROM ' . ReservationDB::TABLE .
            ' WHERE ' . ReservationDB::USER_ID . ' = ?' .
            ' AND ' . ReservationDB::TIME . ' >= ?' .
            ' AND ' . ReservationDB::TIME . ' <= ?'
        );

        $statement->bind_param('iii', $id, $startTime, $endTime);
        $statement->execute();

        $statement->bind_result($id);

        while ($statement->fetch()) {
            $reservation = ReservationDB::getReservation($id);
            array_push($reservations, $reservation);
        }

        $statement->close();

        return $reservations;
    }
}
