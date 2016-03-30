$(function() {
    $("#datepicker").datepicker();

    $("#project").keyup(function() {
        $.post("search.php", {input: $(this).val()}, function(data) {
            if (data.length === 0) {
                return;
            }

            var projects = JSON.parse(data);

            $("#project").autocomplete({
                minLength: 0,
                source: projects,
                focus: function(event, ui) {
                    $("#project").val(ui.item.label);
                    return false;
                },
                select: function(event, ui) {
                    $("#project").val(ui.item.label);
                    $("#project-id").val(ui.item.value);
                    $("#project-description").html(ui.item.desc);
                    $("#project-icon").attr("src", "images/" + ui.item.icon);

                    return false;
                }
            })
            .autocomplete("instance")._renderItem = function(ul, item) {
                return $("<li>")
                    .append("<a>" + item.label + "<br>" + item.desc + "</a>")
                    .appendTo(ul);
            };
        });
    });

    $("#search_results").hide();
});
