<?php

require_once 'includes/config.php';
require_once 'includes/header.php';
require_once 'includes/law.php';
require_once 'includes/nav.php';

$today = strtotime('yesterday midnight');
$host = ReservationDB::getReservationByTimeSlots(2, $today);
$storeHours = strtotime('yesterday 10am');
$idNumber = 0;

echo '<div class="container-fluid">';
// 1800 = half hour increments. 
for ($i = 0.0; $i < 26.0; $i++, $storeHours+=1800) {
    echo '  <div class = "row">
                <div class="col-xs-3">
                    <div class="time">
                        <div class="card-block">
                            <h1 class="card-subtitle text-muted"> ' . date("g:i a", $storeHours) . ' </h1>
                        </div>
                    </div>
                </div> ';
    for ($x = 0; $x < count($host); $x++) {
//        28800=8 hours,to adjust for server time.
        if ((strtotime($host[$x]->time) - 28800) >= $storeHours and ( strtotime($host[$x]->time) - 28800) < $storeHours + 1800) {
            echo '<div class="col-xs-3">
                    <div class="card">
                        <h3 class="card-header "><strong>' . $host[$x]->custName . '</strong></h3>
                        <div class="card-block">
                            <h4 class="card-subtitle text-muted">' . $host[$x]->partySize . '</h4>
                            <p class="card-text">' . $host[$x]->notes . '</p>
                        </div>
                        <div class="card-footer text-muted"> <a class="btn host-btn" id="' . $idNumber . '" onclick="checkInCheck(this.id)"> Check In</a></div>
                    </div>
                </div>';
            $idNumber++;
        }
    }

    echo "</div> ";
    echo "<hr>";
}
echo "</div>";

echo '<script>
function checkInCheck(clicked_id) {
    document.getElementById(clicked_id).innerHTML = "ARRIVED";
}
</script>';








