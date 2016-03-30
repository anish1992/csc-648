<?php

/**
 * SearchEngine is responsible for performing a search against the database
 * using a given query.
 *
 * @author Gary Ng
 */
class SearchEngine {

    /**
     * Searches the database using the query and location for sorting. Results
     * returned is a dictionary type array containing matching cities or
     * restaurants.
     * 
     * Keys:
     * "location" returns a list of locations
     * "name" returns a list of restaurants matching its name
     * "tags" returns a list of restaurants containing the given tags
     */
    public static function search($query, $location, $limit) {
        $results = array();

        $results['location'] = RestaurantContactDB::getCities($query, $limit);

        $results['name'] = RestaurantDB::searchByName($query, $location, $limit);

        $tags = explode(' ', $query);
        $results['tags'] = RestaurantDB::searchByTags($tags, $location, $limit);

        $results['city'] = RestaurantDB::searchByCity($query, $location, $limit);

        return $results;
    }

    public static function searchTags($query, $location, $limit) {
        $tags = explode(' ', $query);
        return RestaurantDB::searchTags($tags, $location, $limit);
    }
}
