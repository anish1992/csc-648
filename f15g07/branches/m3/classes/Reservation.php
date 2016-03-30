<?php

/**
 * Reservation stores all reservation related information.
 *
 * @author Gary Ng
 */
class Reservation {

    public $id;
    public $restaurantId;
    public $userId;
    public $time;
    public $partySize;
    public $notes;

    function __construct($id) {
        $this->id = $id;
    }
    
    public function toArray() {
        return array(
            'id'            => $this->id,
            'restaurant_id' => $this->restaurantId,
            'user_id'       => $this->userId,
            'time'          => $this->time,
            'party_size'    => $this->partySize,
            'notes'         => $this->notes
        );
    }
}
