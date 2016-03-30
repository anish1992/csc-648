<?php

/**
 * Description of Restaurant
 *
 * @author Gary Ng
 */
class Restaurant {
    
    public $id;
    public $key;
    public $name;
    public $description;
    public $tags;

    function __construct($id) {
        $this->id = $id;
    }
    
    public function toArray() {
        return array(
            'id'    => $this->id,
            'key'   => $this->key,
            'name'  => $this->name,
            'desc'  => $this->desc,
            'tags'  => $this->tags
        );
    }
}
