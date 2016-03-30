<?php

/**
 * Restaurant stores all restaurant related information.
 *
 * @author Gary Ng
 */
class Restaurant {
    
    public $id;
    public $key;
    public $name;
    public $description;
    public $shortDesc;
    public $tags;
    public $priceMin;
    public $priceMax;
    public $numTables;
    public $location;
    public $hours;
    public $tables;

    function __construct($id) {
        $this->id = $id;
    }
    
    public function toArray() {
        return array(
            'id'            => $this->id,
            'key'           => $this->key,
            'name'          => $this->name,
            'desc'          => $this->desc,
            'short_desc'    => $this->shortDesc,
            'tags'          => $this->tags,
            'price_min'     => $this->priceMin,
            'price_max'     => $this->priceMax,
            'num_tables'    => $this->numTables,
            'location'      => $this->location->toArray(),
            'hours'         => $this->hours,
            'tables'        => $this->tables
        );
    }
}
