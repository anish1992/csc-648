<?php

/**
 * Reservation stores all reservation related information.
 *
 * @author Gary Ng
 */
class Reservation {

    public $id;
    public $restaurantId;
    public $user;
    public $time;
    public $partySize;
    public $notes;
    public $timeCreated;
    public $custName;
    public $custPhone;
    
    function __construct($id) {
        $this->id = $id;
    }
    
    public function toArray() {
        return array(
            'id'            => $this->id,
            'restaurant_id' => $this->restaurantId,
            'user'          => $this->user ,//!= null ? $this->user->toArray() : null,
            'custName'      => $this->custName,
            'custPhone'     => $this->custPhone,
            'time'          => $this->time,
            'party_size'    => $this->partySize,
            'notes'         => $this->notes,
            'time_created'  => $this->timeCreated
        );
    }
}
