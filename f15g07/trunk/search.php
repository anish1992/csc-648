<?php
require_once 'includes/config.php';

$party = filter_input(INPUT_POST, 'party');
$date = filter_input(INPUT_POST, 'date');
$time = filter_input(INPUT_POST, 'time');
$query = filter_input(INPUT_POST, 'input');
$key = filter_input(INPUT_POST, 'key');

$hour = round(10 + $time / 2);
$period = $hour < 12 ? 'AM' : 'PM';
$hour %= 12;
if ($hour == 0) {
    $hour = 12;
}
$minutes = $time % 2 == 0 ? '30' : '00';

//echo "Party Size: {$party}<br>Date: {$date}<br>Time: {$hour}:{$minutes} {$period}<br>";

if (isset($key) && strlen($key) > 0) {
    header("Location: restaurant.php?v={$key}");
    exit;
} else if (isset($query) && strlen($query) > 0) {
    $results = SearchEngine::search($query, TRUE, TRUE, 3);
    
    $keys = array();

    $json = array();
    foreach ($results['name'] as $restaurant) {
//        $json['name'] = $restaurant->toArray();

        if (!in_array($restaurant->key, $keys)) {
            array_push($keys, $restaurant->key);
        } else {
            continue;
        }

        array_push($json, array(
            'value' => $restaurant->key,
            'label' => $restaurant->name,
            'desc'  => $restaurant->tags,
            'icon'  => ''
        ));
    }

    foreach ($results['tags'] as $restaurant) {
//        $json['tags'] = $restaurant->toArray();

        if (!in_array($restaurant->key, $keys)) {
            array_push($keys, $restaurant->key);
        } else {
            continue;
        }

        array_push($json, array(
            'value' => $restaurant->key,
            'label' => $restaurant->name,
            'desc'  => $restaurant->tags,
            'icon'  => ''
        ));
    }
    
    $temp = array();
    for ($i = 0; $i < min(3, count($json)); $i++) {
        array_push($temp, $json[$i]);
    }

    echo json_encode($temp);
}
