
<div id="sidebar-main-wrapper" class="toggled">
        <div class="sidebar-wrapper sidebar-right">
            <ul class="sidebar-nav">
              <?php echo "Username: ", $_SESSION['user']->username,
               "\nFirst Name: ",$_SESSION['user']->firstname,
               "\nLast Name: ", $_SESSION['user']->lastname,
               "\nEmail: ", $_SESSION['user']->email,
               "\nPhone Number: ", $_SESSION['user']->phonenumber
               ?>
          </ul>
    </div>
</div>

    <!-- Menu Toggle Script
    <script>
  $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#sidebar-main-wrapper").toggleClass("toggled");
    });

    $(window).on("resize", function () {

        if ($(window).width() > 767 && $("#menu-toggle").is(":hidden")) {
            $("#menu-toggle").removeClass("toggled");
        }
    });

$(".form-signin").submit(function(e) {
    e.preventDefault();

    $.post("validate_login.php", $(this).serialize(), function(data) {
        var result = JSON.parse(data);
        if (result["status"]) {
            window.location.href = result["url"];
        } else {
            $("#signin-error").html("The email and password you entered don't match.");
        }
    });
});
    </script>
-->
