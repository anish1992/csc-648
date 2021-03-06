<?php

/**
 * Web Administrator Page
 * Allows admin to view and edit all existing restaurants.
 *
 * @author Gary Ng
 */
require_once 'includes/config.php';

$action = filter_input(INPUT_GET, 'action');
if (isset($action)) {
    switch ($action) {
        case 1: // Display Restaurant Form
            $key = filter_input(INPUT_GET, 'key');
            if (isset($key)) {
                getRestaurant($key);
            }
            break;
    }
    
    exit;
}

$title = 'Administrator';
require_once 'includes/header.php';
require_once 'includes/law.php';
require_once 'includes/nav.php';
?>
<div id="admin-div">
    <div id="admin-nav">
        <div id="admin-keys-dropdown" class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
                <span class="dropdown-label">Choose Restaurant</span>
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
<?php
$keys = RestaurantDB::getRestaurantKeys();
foreach ($keys as $key) {
?>
                <li><a href="#"><?php echo $key; ?></a></li>
<?php
}
?>
            </ul>
        </div>
        <button type="submit" id="admin-form-submit" class="btn btn-default form-control" style="display: none">Save</button>
    </div>
    <div>
        <form id="admin-form" enctype="multipart/form-data">
            <div class="admin-form-group">
                <h4>General</h4>
                <h5>Key</h5>
                <input type="text" name="key" class="form-control admin-input-long" placeholder="Key">
                <h5>Name</h5>
                <input type="text" name="name" class="form-control admin-input-long" placeholder="Name">
                <h5>Description</h5>
                <textarea name="desc" class="form-control admin-input-long" rows="4" placeholder="Description"></textarea>
                <h5>Short Description</h5>
                <input type="text" name="short_desc" class="form-control admin-input-long" placeholder="Short Description">
                <h5>Tags</h5>
                <input type="text" name="tags" class="form-control admin-input-long" placeholder="Tags">
                <h5>Price Range</h5>
                <input type="text" name="price_min" class="form-control admin-input-short" placeholder="Min">
                <input type="text" name="price_max" class="form-control admin-input-short" placeholder="Max">
                <h5>Num Tables</h5>
                <input type="text" name="num_tables" class="form-control admin-input-medium" placeholder="Num Tables">
            </div>

            <div class="admin-form-group admin-vline">
                <h4>Location</h4>
<?php
$location = array(
    'house_num' => 'House Num',
    'street' => 'Street',
    'city' => 'City',
    'state' => 'State',
    'zip_code' => 'Zip Code',
    'latitude' => 'Latitude',
    'longitude' => 'Longitude',
    'phone' => 'Phone',
    'url' => 'URL'
);

foreach ($location as $key => $value) {
?>
                <h5><?php echo $value; ?></h5>
                <input type="text" name="<?php echo $key; ?>" class="form-control admin-input-medium" placeholder="<?php echo $value; ?>">
<?php
}
?>
            </div>

            <div class="admin-form-group admin-vline">
                <h4>Hours</h4>
<?php
$days = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
for ($i = 0; $i < count($days); $i++) {
?>
                <h5><?php echo $days[$i]; ?></h5>
                <div>
                    <input type="text" name="time-start-<?php echo $i; ?>" class="form-control admin-input-short" placeholder="Start">
                    to
                    <input type="text" name="time-end-<?php echo $i; ?>" class="form-control admin-input-short" placeholder="End">
                </div>
<?php
}
?>
            </div>

            <div class="admin-form-group admin-vline">
                <h4>Tables</h4>
                <h5># of Tables with # of Seats</h5>
<?php
for ($i = 0; $i < 6; $i++) {
?>
                <div>
                    <input type="text" name="tables-<?php echo $i; ?>" class="form-control admin-input-short" placeholder="Tables">
                    <input type="text" name="seats-<?php echo $i; ?>" class="form-control admin-input-short" placeholder="Seats">
                </div>
<?php
}
?>
            </div>
        </form>

        <h4>Main Image</h4>
        <img id="admin-main-image" src="" />

        <h4>Gallery Images</h4>
        <div id="admin-gallery"></div>
    </div>
</div>

<script src="js/admin.js"></script>
<?php
require_once 'includes/footer.php';

function getRestaurant($key) {
    $restaurant = RestaurantDB::getRestaurantByKey($key);
    if ($restaurant != null) {
        $array = $restaurant->toArray();
        $array["main_image"] = ImageHelper::getMainImage($key);
        $array["gallery"] = ImageHelper::getGalleryImages($key);

        echo json_encode($array);
    }
}
