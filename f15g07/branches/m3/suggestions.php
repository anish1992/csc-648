<?php
require_once 'includes/config.php';

if (isset($_SESSION['location'])) {
    $location = $_SESSION['location'];
} else {
    $location = 'San Francisco';
}

$location_query = filter_input(INPUT_GET, 'l');
$name_query = filter_input(INPUT_GET, 'n');
$tag_query = filter_input(INPUT_GET, 't');
// Location Suggestions
if (isset($location_query) && strlen($location_query) > 0) {
    $results = SearchEngine::search($location_query, $location, 3);

    $json = array();
    foreach ($results['location'] as $city) {
        array_push($json, array(
            'value' => $city
        ));
    }

    echo json_encode($json);
    exit;
}
// Restaurant Suggestions
if (isset($name_query) && strlen($name_query) > 0) {
    $results = SearchEngine::search($name_query, $location, 5);

    $json = array();
    foreach ($results['name'] as $restaurant) {
        array_push($json, array(
            'value' => $restaurant->name
        ));
    }

    echo json_encode($json);
    exit;
}
// Tag Suggestions
if (isset($tag_query) && strlen($tag_query) > 0) {
    $results = SearchEngine::searchTags($tag_query, $location, 3);

    $json = array();
    foreach ($results as $tag) {
        array_push($json, array(
            'value' => ucfirst($tag)
        ));
    }

    echo json_encode($json);
    exit;
}
