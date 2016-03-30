<!DOCTYPE html>
<!--
restaurant header custom to the restaurant
-->
<div class="hud col-xs-4">
        <div class="mainselection2 rest " style="background-image: url('images/everythings-chicken/gallery/1.jpg');">

            <div class="col-md-3">

                <img class="img-thumbnail" style="height: 192px;" src="<?php echo ImageHelper::getMainImage($restaurant->key) ?>">
            </div>
            <div style="height:100%;" class="card-background">
                <br>
                <h1 style="padding: 0; margin: 0;"><kbd><?php echo $restaurant->name ?></kbd></h1><br>
                <h4 style="padding: 0; margin:0; "><kbd data-toggle="tooltip" data-placement="bottom" title="hah"><?php
                        $counter = 0;
                        $days = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
                        $days_abr = array("Sun", "Mon", "Tues", "Weds", "Thurs", "Fri", "Sat");
                        foreach ($restaurant->hours as $day) {
                            if (date("l") == $days[$counter]) {
                                $h = date("H") - 8;
                                $ch = ($h < 0) ? 24 + $h : $h;
                                $start = $day[0];
                                $end = $day[1];
                                $shour = substr($start, 0, -6);
                                $ehour = substr($end, 0, -6);
                                $open = (substr($start, 0, -6) <= $ch && $ch <= substr($end, 0, -6)) ? " open" : " closed";

                                $start_str = ($shour < 12) ? substr($start, 0, -3) . " AM" : (substr($start, 0, -6) - 12) . ":" . substr($start, 3, -3) . " PM";
                                $end_str = ($ehour < 12) ? substr($end, 0, -3) . " AM" : (substr($end, 0, -6) - 12) . ":" . substr($end, 3, -3) . " PM";
                                echo $days_abr[$counter] . ": " . $start_str . " - " . $end_str;
                                ?>
                                <span style="color:<?php echo(substr($start, 0, -6) <= $ch && $ch <= substr($end, 0, -6)) ? 'green' : 'red'; ?>"><?php echo $open ?></span>
                                <?php
                                echo " now" . "<br>";
                            }
                            $counter++;
                        }
                        ?></kbd></h4>
                <h4 style='margin-bottom: 1.75em;'><kbd>price: <?php
                        for ($i = 0; $i <= $restaurant->priceMax; $i++) {
                            echo "<span class='glyphicon glyphicon-usd'></span>";
                        }
                        ?></kbd></h4>
                <h4><kbd><span class='glyphicon glyphicon-map-marker'></span><?php echo " " . $restaurant->location->city . " | <span class='glyphicon glyphicon-phone-alt'></span> " . $restaurant->location->phone; ?></kbd></h4>

            </div>
        </div>
    </div>
