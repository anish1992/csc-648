
<?php
$title = 'Search Results';
require_once 'includes/config.php';
require_once 'includes/header.php';
require_once 'includes/law.php';

$rest_name_counter = 0;
$rest_alt_counter = 0;
$rest_loc_counter = 0;
$rank = 0;
$num_results = 0;
$date = date("m/d/Y", $time);
$num_results = count($results['name']) + count($results['tags']) + count($results['city']);

$htime = date("h", $time);
$htime = $htime - 6;
$mtime = date("i", $time);
$ttime = ($htime <= 0) ? ($htime + 12) : ($htime);
$ttime = ($mtime == 30) ? ($ttime * 2) : (($ttime * 2) - 1);
$value = $query;
        
require_once 'includes/search_nav.php';
//echo "time: ".$time."<br>";
//echo "htime: ".$htime."<br>";
//echo "mtime: ".$mtime."<br>";
//echo "ttime: ".$ttime."<br>";
//echo "pricemax: ".$results['name']->priceMax;
$keys = array();
?>
<body background="images/search-results/background.jpg" class="search-background">
</body>
<br>

<center >
    <span style="background-color: goldenrod;"><strong><?php echo $num_results; ?></strong><?php echo " results found for "; ?><strong><?php echo $query; ?></strong></span>

</center>
<br>

<?php
foreach ($results['name'] as $restaurant) {
    $rank++;
    if ($rest_name_counter == 0) {
        $rest_name_counter++;
    }
    display($rank, $restaurant, $party, $time);
    array_push($keys, $restaurant->key);
    echo "<br>";
}

foreach ($results['tags'] as $restaurant) {
    $rank++;
    if (in_array($restaurant->key, $keys)) {
        continue;
    }
    if ($rest_alt_counter == 0) {
        $rest_alt_counter++;
    }
    display($rank, $restaurant, $party, $time);
    array_push($keys, $restaurant->key);
    echo "<br>";
}
foreach ($results['city'] as $restaurant) {
    $rank++;
    if (in_array($restaurant->key, $keys)) {
        continue;
    }
    if ($rest_loc_counter == 0) {
        $rest_loc_counter++;
    }
    display($rank, $restaurant, $party, $time);
}

if ($rank == 0) {
    ?><center>
        <span style="background-color: rgba(218,165,32,0.8)">No Results.  Please try again.</span>
        <br>
        <button onclick="window.location.href = 'index.php'" class="btn btn-primary btn-lg">click me to go back</button>
    </center>
    <?php
}


require_once 'includes/footer.php';

function display($rank, $restaurant, $party, $time) {
    ?>
    <center style="text-decoration: none;">
        <a href="restaurant.php?v=<?php echo $restaurant->key; ?>&s=<?php echo $party; ?>&t=<?php echo $time; ?>&l=<?php echo $lin; ?>">
            <span style="color:goldenrod">
                <div class='restaurant-box row media' id="<?php echo $restaurant->key ?>">

                    <div class="col-md-4 media-left media-middle">
                        <div style="height:1em"></div>
                        <img src="<?php echo ImageHelper::getMainImage($restaurant->key); ?>" style="height:192px" class="img-thumbnail">
                    </div>

                    <div class="col-md-8">
                        <div class="restaurant-name">
                            <div>
                                <h3 style="color:goldenrod; padding:0">
                                    <strong>
                                        <?php echo $rank . ".  "; ?>
                                        <?php echo $restaurant->name ?>
                                    </strong>
                                </h3>
                            </div>
                            <div>
                                <h5 style="color:goldenrod;"><?php echo $restaurant->shortDesc; ?></h5>
                            </div>
                        </div>

                        <div class="row display-info">
                            <div class ="col-xs-7 text-left">
                                <h4 style="color:goldenrod; padding:0">
                                    <div><?php
                                        for ($k = 0; $k < $restaurant->priceMax; $k++) {
                                            echo "<span class='glyphicon glyphicon-usd'></span>";
                                        }
                                        ?></div>
                                    <div><?php
                                        $counter = 0;
                                        $days = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
                                        $days_abr = array("Sun", "Mon", "Tues", "Weds", "Thurs", "Fri", "Sat");
                                        foreach ($restaurant->hours as $day) {
                                            if (date("l") == $days[$counter]) {
                                                $start = $day[0];
                                                $end = $day[1];
                                                $start_str = substr($start, 0, -3);
                                                $end_str = substr($end, 0, -3);
                                                echo $days_abr[$counter] . ": " . $start_str . " - " . $end_str . "<br>";
                                            }

                                            $counter++;
                                        }
                                        ?></div>
                                </h4>

                            </div>
                            <div class="col-xs-5 text-right">
                                <h4 style="color:goldenrod; padding:0">
                                    <div><?php echo $restaurant->location->city ?></div> 
                                    <div><?php echo $restaurant->location->phone ?></div>
                                </h4>
                            </div>
                        </div>

                        <div style="height:.5em"></div>
                        <a href="#"></a>
                        <div class='search-buttons' >
                            <div id="reserve-slots-<?php echo $restaurant->key; ?>">
                                <script>
                                    getTimeSlots(<?php echo '"' . $restaurant->key . '", ' . $time . ', ' . $party; ?>, function (data) {
                                        $("#reserve-slots-<?php echo $restaurant->key; ?>").html(data);
                                    });
                                </script>
                            </div>
                        </div>      
                        <div style="height:.5em"></div>
                        <div class='search-tags text-center'>    
                            <p style='font-size:12px; color:goldenrod'>Search Tags:
                                <span style='font-size:12px'><small><?php echo $restaurant->tags ?></small></span>
                            </p>                  
                        </div>

                    </div>
                
            </span>
        </a>
    </center>
    <div style="height: 1em"></div>
    <?php
}
