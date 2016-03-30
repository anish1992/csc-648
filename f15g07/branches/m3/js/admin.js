$(function () {
    // nav bar
    $("#admin-keys-dropdown .dropdown-menu li a").click(function () {
        $("#admin-keys-dropdown .dropdown-label").text($(this).text());
        
        $.get("admin.php?action=1&key=" + $(this).text(), function(data) {
            var data = JSON.parse(data);

            var parent = $("#admin-form");
            $("input[name=key]", parent).val(data["key"]);
            $("input[name=name]", parent).val(data["name"]);
            $("textarea[name=desc]", parent).val(data["desc"]);
            $("input[name=short_desc]", parent).val(data["short_desc"]);
            $("input[name=tags]", parent).val(data["tags"]);
            $("input[name=price_min]", parent).val(data["price_min"]);
            $("input[name=price_max]", parent).val(data["price_max"]);
            $("input[name=num_tables]", parent).val(data["num_tables"]);

            var location = data["location"];
            $("input[name=house_num]", parent).val(location["house_num"]);
            $("input[name=street]", parent).val(location["street"]);
            $("input[name=city]", parent).val(location["city"]);
            $("input[name=state]", parent).val(location["state"]);
            $("input[name=zip_code]", parent).val(location["zip_code"]);
            $("input[name=latitude]", parent).val(location["latitude"]);
            $("input[name=longitude]", parent).val(location["longitude"]);
            $("input[name=phone]", parent).val(location["phone"]);
            $("input[name=url]", parent).val(location["url"]);

            var days = data["hours"];
            for (var i = 0; i < days.length; i++) {
                $("input[name=time-start-" + i + "]", parent).val(days[i][0]);
                $("input[name=time-end-" + i + "]", parent).val(days[i][1]);
            }

            var i = 0;
            $.each(data["tables"], function(key, value) {
                $("input[name=tables-" + i + "]", parent).val(key);
                $("input[name=seats-" + i + "]", parent).val(value);
                i++;
            });

            $("#admin-main-image").attr("src", data["main_image"]);
            
            $("#admin-gallery").html("");
            $.each(data["gallery"], function(index, value) {
                $("#admin-gallery").append("<img src=\"" + value + "\" />")
            });

            $("#admin-form").fadeOut(0).fadeIn("slow");
        });
    });

    $("#admin-form").submit(function(event) {
        
    });
});
