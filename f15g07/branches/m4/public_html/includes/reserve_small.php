<?php
require_once 'config.php';

$restaurant = RestaurantDB::getRestaurantByKey($key);
// Generate Slot
$timeSlots = array();
$startTime = $time * 1000 - 3600000; // -1 Hour
for ($i = 0; $i < 5; $i++) {
    // "getTimeSlotsStatus" returns true if there's no match for the time in database
    // and false if there's a match.
    $timeSlots[$startTime + $i * 1800000] = ReservationDB::getTimeSlotsStatus($restaurant, $startTime + $i * 1800000);
}
?>
<div class="reserve-div">
    <input type="hidden" id="name" name="name" value="<?php echo $restaurant->name; ?>">
    <input type="hidden" id="party" name="party" value="<?php echo $party; ?>">
    <input type="hidden" id="rest" name="rest" value="<?php echo $key; ?>">

    <div id="time-slots">
        <?php
        foreach ($timeSlots as $time => $status) {
            ?>
            <button type="button" class="rest-btn btn btn-default"<?php echo $status ? '' : ' disabled=\"disabled\"'; ?> data-toggle="modal" data-target="#reserve-modal" value=""></button>
            <?php
        }
        ?>
    </div>
</div>

<div id="reserve-modal" class="modal fade" role="dialog">
    <div style="height: 25%"></div>
    <div class="modal-dialog">
        <div class="modal-content reserve-form-div well"style="width: 110%">
            <div class="modal-header">
                <h4 class="modal-title" style="color: goldenrod;">
                    <span class="reserve-div-name"></span>
                    <br>Reservation on <span class="reserve-div-date"></span> at <span class="reserve-div-time"></span> for <?php echo $party; ?>.

                </h4>
            </div>
            <form class="form-inline reserve-form" enctype="multipart/form-data" >
                <div class="modal-body" >
                    <?php if (!isset($_SESSION['user'])) { ?>  
                        <h4 style="color:goldenrod">Enter required information below to complete reservation. </h4><br>
                        <input name="custName" class="controls form-control" type="text" autocomplete="off" placeholder="Your Name">
                        <input name="custEmail" class="controls form-control" type="text" autocomplete="off" placeholder="Email">
                        <input name="custNumber" class="controls form-control" type="text" autocomplete="off" placeholder="Phone Number">
                        <input type="hidden" id="time" name="time" value="">
                        <input type="hidden" id="party" name="party" value="">
                        <input type="hidden" id="rest" name="rest" value="">
                        <?php } 
                        if (isset($_SESSION['user'])) { ?>
                        <h4 style="color:goldenrod">Check if everything is correct and then click make a reservation</h4>
                        <input name="custName" class="controls form-control" type="text" autocomplete="off" value="<?php echo $_SESSION['user']->firstname . " " . $_SESSION['user']->lastname ?>">
                        <input name="custEmail" class="controls form-control" type="text" autocomplete="off" value="<?php echo $_SESSION['user']->email ?>">
                        <input name="custNumber" class="controls form-control" type="text" autocomplete="off" value="<?php echo $_SESSION['user']->phonenumber ?>">
                        <input type="hidden" id="time" name="time" value="">
                        <input type="hidden" id="party" name="party" value="">
                        <input type="hidden" id="rest" name="rest" value="">
                        <?php } ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" style="float:left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-default form-control">Reserve Table</button>
                    </div>
                </form>
                <span id="modal-error" style="color:red"></span>
            </div>
        </div>
    </div>

    <script>
        $(".rest-btn").off("click").click(function () {
            var time = parseInt($(this).val()); // Seconds

            var div = $(this).parent().parent();
            var modal = $("#reserve-modal");
            modal.find("input[name=time]").val(time);
            modal.find("input[name=party]").val(div.find("input[name=party]").val());
            modal.find("input[name=rest]").val(div.find("input[name=rest]").val());

            time *= 1000; // Milliseconds
            modal.find(".reserve-div-name").html(div.find("input[name=name]").val());
            modal.find(".reserve-div-date").html(getDate(time));
            modal.find(".reserve-div-time").html(getTime(time));
        });

        $(".reserve-div").each(function () {
            var slots = [<?php echo implode(',', array_keys($timeSlots)); ?>];
        $(this).find(".rest-btn").each(function (index) {
            var time = slots[index];

            $(this).val(time / 1000);
            $(this).html(getTime(time));
        });
    });

    $(".reserve-form").off("submit").submit(function (e) {
        e.preventDefault();

        var custName = $(this).find("input[name=custName]").val().trim();
        var custEmail = $(this).find("input[name=custEmail]").val().trim();
        var custNumber = $(this).find("input[name=custNumber]").val().trim();

        if (custName.length === 0 || custEmail.length === 0 || custNumber.length === 0) {
            $("#modal-error").html("Please enter complete information!");
            return;
        }

        $.get("priorconfirm.php", $(this).serialize(), function (data) {
            var data = JSON.parse(data);

            if (data["status"] === true) {
                window.location.href = "confirmation.php?id=" + data["id"];
            } else {
                $("#modal-error").html("Reservation not available!");
            }
        });
    });
</script>
