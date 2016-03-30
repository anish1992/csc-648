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
    const TIME_CREATED = '`time_created`';
    const CUST_NAME = "`cust_name`";
    const CUST_PHONE = "`cust_phone`";

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
            ReservationDB::CUST_NAME,
            ReservationDB::CUST_PHONE,
            ReservationDB::TIME,
            ReservationDB::PARTY_SIZE,
            ReservationDB::NOTES,
            ReservationDB::TIME_CREATED
        );

        $con = parent::createConnection();
        $statement = mysqli_prepare($con, ' SELECT ' . implode(', ', $fields) .
                ' FROM ' . ReservationDB::TABLE .
                ' WHERE ' . ReservationDB::ID . ' = ?'
        );

        $statement->bind_param('i', $id);
        $statement->execute();

        $statement->bind_result($id, $restaurantId, $userId, $custName, $custPhone, $time, $partySize, $notes, $timeCreated);

        if ($statement->fetch()) {
            $reservation = new Reservation($id);
            $reservation->restaurantId = $restaurantId;

            if ($userId > 0) {
                $reservation->user = UserInfoDB::getUserById($userId);
            }
            $reservation->custName = $custName;
            $reservation->custPhone = $custPhone;
            $reservation->time = $time;
            $reservation->partySize = $partySize;
            $reservation->notes = $notes;
            $reservation->timeCreated = $timeCreated;
        }

        $statement->close();

        return $reservation;
    }

    /**
     * Creates a reservation entry in the database and return the values as
     * a reservation instance. Time must be in seconds.
     */
    public static function createReservation($restaurantId, $userId, $custName, $custPhone, $time, $partySize, $notes) {
        $reservation = null;

        $fields = array(
            ReservationDB::RESTAURANT_ID,
            ReservationDB::USER_ID,
            ReservationDB::CUST_NAME,
            ReservationDB::CUST_PHONE,
            ReservationDB::TIME,
            ReservationDB::PARTY_SIZE,
            ReservationDB::NOTES
        );

        $con = parent::createConnection();
        $statement = mysqli_prepare($con, ' INSERT INTO ' . ReservationDB::TABLE . ' (' .
                implode(', ', $fields) .
                ') VALUES (?, ?, ?, ?,FROM_UNIXTIME(?), ?, ?)'
        );

        $statement->bind_param('iisisis', $restaurantId, $userId, $custName, $custPhone, $time, $partySize, $notes);
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
     * specify a time range in seconds.
     */
    public static function getReservationsByRestaurantId($id, $startTime, $endTime) {
        $reservations = array();

        $con = parent::createConnection();
        $statement = mysqli_prepare($con, ' SELECT ' . ReservationDB::ID .
                ' FROM ' . ReservationDB::TABLE .
                ' WHERE ' . ReservationDB::RESTAURANT_ID . ' = ?' .
                ' AND ' . ReservationDB::TIME . ' >= FROM_UNIXTIME(?)' .
                ' AND ' . ReservationDB::TIME . ' <= FROM_UNIXTIME(?)'
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
     * ID. Must specify a time range in seconds.
     */
    public static function getReservationsByUserId($id, $startTime, $endTime) {
        $reservations = array();

        $con = parent::createConnection();
        $statement = mysqli_prepare($con, ' SELECT ' . ReservationDB::ID .
                ' FROM ' . ReservationDB::TABLE .
                ' WHERE ' . ReservationDB::USER_ID . ' = ?' .
                ' AND ' . ReservationDB::TIME . ' >= FROM_UNIXTIME(?)' .
                ' AND ' . ReservationDB::TIME . ' <= FROM_UNIXTIME(?)'
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

    public static function getAvailableTimeSlots($restaurantId) {

        $timeSlots = array();

        $con = parent::createConnection();
        $statement = mysqli_prepare($con, ' SELECT ' . ReservationDB::ID .
                ' FROM ' . ReservationDB::TABLE .
                ' WHERE ' . ReservationDB::RESTAURANT_ID . ' = ?'
        );

        $statement->bind_param('i', $restaurantId);
        $statement->execute();

        $statement->bind_result($id);

        while ($statement->fetch()) {
            $reservation = ReservationDB::getReservation($id);
            array_push($timeSlots, $reservation);
        }

        $statement->close();

        return $timeSlots;
    }

    public static function getTimeSlotsStatus($restaurantId, $time) {

        $timeslot = ReservationDB::getAvailableTimeSlots($restaurantId->id);
        $available = true;
        for ($x = 0; $x <= count($timeslot) - 1; $x++) {
            $t = strtotime($timeslot[$x]->time) * 1000;
            if ($time == $t) {
                $available = false;
                return $available;
            }
        }
        return $available;
    }

    public static function getReservationByTimeSlots($restaurantID, $startTime) {
        $timeSlots = array();
        $startWindow = $startTime;
        
        $endWindow = $startWindow + 3600 * 24;
        
        $con = parent::createConnection();
        $statement = mysqli_prepare($con, "SELECT reservation_id FROM reservation
                                            WHERE restaurant_id = '$restaurantID'
                                            AND time >= FROM_UNIXTIME('$startTime')
                                            AND time <= FROM_UNIXTIME('$endWindow') "
                . "                         ORDER BY time");



        $statement->execute();

        $statement->bind_result($id);

        while ($statement->fetch()) {
            $reservation = ReservationDB::getReservation($id);

            array_push($timeSlots, $reservation);
        }

        $statement->close();

        return $timeSlots;
    }

}