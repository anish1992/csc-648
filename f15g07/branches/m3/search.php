<?php
require_once 'includes/config.php';

$party = filter_input(INPUT_GET, 's');
$time = filter_input(INPUT_GET, 't');
$query = filter_input(INPUT_GET, 'q');
$lin = filter_input(INPUT_GET, 'loca');

switch ($lin) {
    case 1 : $location = "SF Bay Area";
        break;
    case 2 : $location = "New York City";
        break;
    case 3 : $location = "Chicago";
        break;
    case 4 : $location = "Houston";
        break;
    case 5 : $location = "toronto";
        break;
}

if (isset($_SESSION['location'])) {
    $location = $_SESSION['location'];
} else {
    $location = 'San Francisco';
}

if (isset($query) && strlen($query) > 0) {
    $results = SearchEngine::search($query, $location, 10);
    // Restaurant Page
    if (count($results['name']) == 1) {
        $restaurant = $results['name'][0];

        if ($restaurant instanceof Restaurant) {

            header("Location: restaurant.php?v={$restaurant->key}&s={$party}&t={$time}&l={$location}");
            exit;
        }
    }
    // Search Results
    require_once 'search_results.php';
    exit;
}
