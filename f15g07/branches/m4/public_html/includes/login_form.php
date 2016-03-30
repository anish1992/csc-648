<div class="container" style="width:100%;">
    <div class="row" style="width:125%; margin-left: -1.85em;">
        <div class="box_setup">
            <div class="account-wall">
                <form class="form-signin" action="validate_login.php" method="POST">
                    <input type="text" name='luser_email' class="form-control" placeholder="Email" required autofocus>
                    <input type="password" name='luser_pass' class="form-control" placeholder="Password" required>
                    <input type="hidden" id="urlText" name="return_link">
                    <button class="btn btn-primary form-control" type="submit" value="Login">Log In</button>                    
                </form>

                <span id="signin-error"></span>
            </div>
        </div>
    </div>
</div>
<script>
      window.onload=function(){
        document.getElementById("urlText").value=document.URL;
      }

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
