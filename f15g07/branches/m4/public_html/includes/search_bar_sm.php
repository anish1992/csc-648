<form id="search-form-sm" class="form-inline" enctype="multipart/form-data">
    <div class="form-group">
        <div class="dropdown admin-party-dropdown">
            <button class="btn btn-default dropdown-toggle controls form-control" type="button" data-toggle="dropdown">
                <span class="dropdown-party">1 person</span>
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
<?php
$max = 8;
for ($i = 1; $i <= $max; $i++) {
?>

                <li>
                    <a><?php echo $i; ?> person</a>
                    <input type="hidden" value="<?php echo $i; ?>">
                </li>
<?php
}
?>
            </ul>
            <input type="hidden" name="party" value="1">
        </div>
    </div>
    <!--date picker-->
    <div class="form-group">
        <div class="input-group" style="margin-top:0.25em;">
            <input type="text" name="date" id="datepicker2" style="width: 7.5em; margin-top: 0;" class="controls form-control">
            <span class="input-group-addon">
                <i class="glyphicon glyphicon-calendar" style="padding:0;"></i>
            </span> 
        </div>
    </div>

    <div class="form-group">
        <div class="dropdown admin-time-dropdow">
            <button class="btn btn-default dropdown-toggle controls form-control" type="button" data-toggle="dropdown">
                <span class="dropdown-time reserve-div-time">11:00 AM</span>
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
            </ul>
            <input type="hidden" name="time" value="11:00 AM">
        </div>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-default form-control  controls">Find a Table</button>
    </div>
</form>

<script>
    function setTimes(dropdown, date) {
        var currentDate = new Date();
        var targetDate = new Date(date);
        var currentHour = 11;
        var maxHour = 23;

        if (currentDate.getMonth() === targetDate.getMonth() && currentDate.getDay() === targetDate.getDay()) {
            currentHour = Math.min(currentHour, Math.max(currentDate.getHours() + 1, maxHour));
        }

        var lastHour = 24;
        dropdown.find(".dropdown-menu").html("");
        for (var i = currentHour; i < lastHour; i++) {
            var hour = i === 12 ? 12 : i % 12;
            var period = i < 12 ? "AM" : "PM";

            for (var j = 0; j < 2; j++) {
                if (i === lastHour - 1 && j === 1) {
                    break;
                }

                var minutes = j === 0 ? "00" : "30";
                var time = hour + ":" + minutes + " " + period;
                dropdown.find(".dropdown-menu").append("<li><a value=\"" + time + "\"" + ">" + time + "</a></li>");
            }
        }

        dropdown.find(".dropdown-time").html(dropdown.find(".dropdown-menu li").first().find("a").html());

        dropdown.find(".dropdown-menu li a").click(function() {
            dropdown.find(".dropdown-time").text($(this).text());
            $(this).closest(".admin-time-dropdow").find("input[name=time]").val($(this).html());
        });
        
        dropdown.find(".dropdown-menu li a").first().click();
    }

    $(function() {
        var form = $("#search-form-sm");

        var query = getQueryString();
        var key = query["v"];
        var party = query["s"];
        var time = query["t"] * 1000;

        var datepicker = $("#datepicker2");

        datepicker.datepicker({
            minDate: new Date(),
            onSelect: function() {
                setTimes(form.find(".admin-time-dropdow"), datepicker.val());
            }
        });

        datepicker.datepicker("setDate", new Date(time));
        $(".input-group-addon").click(function() {
            var visible = datepicker.datepicker("widget").is(":visible");
            datepicker.datepicker(visible ? "hide" : "show");
        });

        // Set Default Party
        $(".admin-party-dropdown .dropdown-menu li").each(function() {
            var a = $(this).find("a");
            var input = $(this).find("input");

            if (input.val() === party) {
                a.click();
                return false;
            }
        });
        // Set Default Date
        setTimes(form.find(".admin-time-dropdow"), datepicker.val());
        // Set Default Time
        $(".admin-time-dropdow .dropdown-menu li a").each(function() {
            if ($(this).html() === getTime(time)) {
                $(this).click();
                return false;
            }
        });

        form.submit(function(e) {
            e.preventDefault();

            var party = $(this).find("[name=party]").val();

            var date = $(this).find("[name=date]").val();
            var time = $(this).find("[name=time]").val();
            var seconds = new Date(date + " " + time).getTime() / 1000;

            getTimeSlots(key, seconds, party, function(data) {
                var div = $("#reserve-search-div");
                div.find(".reserve-div-date").html(getDate(seconds * 1000));
                div.find(".reserve-div-time").html(getTime(seconds * 1000));
                div.find(".reserve-div-party").html(party);

                $("#reserve-slots").html(data);
            });
        });
    });
</script>
