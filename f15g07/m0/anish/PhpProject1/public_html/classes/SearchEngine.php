<?php

/**
 * Description of SearchEngine
 *
 * @author Gary Ng
 */
class SearchEngine {

    public static function search($query, $name, $tags, $limit) {
        $results = array();

        if (isset($name)) {
            $results['name'] = RestaurantDB::searchByName($query, $limit);
        }

        if (isset($tags)) {
            $results['tags'] = RestaurantDB::searchByTag($query, $limit);
        }

        return $results;
    }
}
