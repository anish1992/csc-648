$(function() {
    $("#input_box").keyup(function() {
        var div = $("#search_results");

        if ($(this).val().length === 0){
            div.hide();
        } else {
            div.show();
        }

        $.post("search.php", {input : $(this).val()}, function(data) {
            div.html(data);
        });
    });

    $("#search_results").hide();
});
