<?php
require_once 'includes/config.php';

$party = filter_input(INPUT_POST, 'party');
$date = filter_input(INPUT_POST, 'date');
$time = filter_input(INPUT_POST, 'time');
$query = filter_input(INPUT_POST, 'input');

$hour = round(10 + $time / 2);
$period = $hour < 12 ? 'AM' : 'PM';
$hour %= 12;
if ($hour == 0) {
    $hour = 12;
}
$minutes = $time % 2 == 0 ? '30' : '00';

echo "Party Size: {$party}<br>Date: {$date}<br>Time: {$hour}:{$minutes} {$period}<br>";

if (isset($query) && count($query) > 0) {
    $results = SearchEngine::search($query, TRUE, TRUE, 10);

    display($results['name']);
    display($results['tags']);

    $json = array();
    foreach ($results['name'] as $restaurant) {
        $json['name'] = $restaurant->toArray();
    }

    foreach ($results['tags'] as $restaurant) {
        $json['tags'] = $restaurant->toArray();
    }

//    echo json_encode($json);
}

function display($restaurants) {
    foreach ($restaurants as $restaurant) {
?>
        <br>
        <span>Name: <b><?php echo $restaurant->name ?></b></span>
        <br>
        <span>Description: <?php echo $restaurant->desc ?></span>
        <br>
        <span>Tags: <?php echo $restaurant->tags ?></span>
        <br>
        <span>Key: <?php echo $restaurant->key ?></span>
        <br>
<?php
    }
}
