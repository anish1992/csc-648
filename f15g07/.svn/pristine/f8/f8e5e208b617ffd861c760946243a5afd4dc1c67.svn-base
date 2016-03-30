<?php
require_once 'includes/config.php';

$value = filter_input(INPUT_GET, 'v');

$restaurant = RestaurantDB::getRestaurantByKey($value);

if ($restaurant != null) {
    display($restaurant);
} else {
    echo 'Restaurant does not exist!';
}

function display($restaurant) {
?>
        <h1><?php echo $restaurant->name ?></h1>
        <h3>Description</h3>
        <p><?php echo $restaurant->desc ?></p>
        <h3>Tags</h3>
        <span><?php echo $restaurant->tags ?></span>
<?php
}
