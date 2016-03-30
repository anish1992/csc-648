<?php

/**
 * Location stores all location related information for a restaurant.
 *
 * @author Gary Ng
 */
class Location {

    public $houseNum;
    public $street;
    public $city;
    public $state;
    public $zipCode;
    public $latitude;
    public $longitude;
    public $phone;
    public $url;
    
    public function toArray() {
        return array(
            'house_num' => $this->houseNum,
            'street'    => $this->street,
            'city'      => $this->city,
            'state'     => $this->state,
            'zip_code'  => $this->zipCode,
            'latitude'  => $this->latitude,
            'longitude' => $this->longitude,
            'phone'     => $this->phone,
            'url'       => $this->url
        );
    }
}
