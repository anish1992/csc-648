<div id="sidebar-main-wrapper" class="toggled">
        <div class="sidebar-wrapper sidebar-right">
            <ul class="sidebar-nav">
                <div class="container">
                  <div class="row">
                    <div class="box_setup">
                      <div class="account-wall">
                        <h2 class="text-center login-title">Login</h2>
                          <form class="form-signin" action="" method="POST"> 
                            <input type="text" class="form-control" placeholder="Email" required autofocus>
                            <input type="password" class="form-control" placeholder="Password" required>
                            <button class="btn btn-lg btn-primary btn-block" type="submit" value="Login">
                                Sign in</button>
                              <label class="checkbox pull-left">
                                  <input type="checkbox" value="remember-me">
                                  Remember me
                              </label>
                              <a href="#" class="pull-right need-help">Need help? </a><span class="clearfix"></span>
                              </form>
                          </div>
                      </div>
                    </div>
                  </div>
          </ul>
    </div>
</div>
    <!-- Menu Toggle Script -->
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

    
    
    
    
    
    
    </script>