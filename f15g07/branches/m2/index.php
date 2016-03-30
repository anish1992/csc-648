<?php
$title = 'index page for V.P.';
require_once 'includes/header.php';
?>
        <div class="thelaw alert alert-success">  

            <a href="http://cs.sfsu.edu/">SFSU Software Engineering CSc 648/848 Project. For Demonstration Only</a>
            <button type="button" class="close" data-dismiss="alert"  aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div id="custom-bootstrap-menu" class="navbar navbar-default " role="navigation">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" style="color:goldenrod;" href="#">AT</a>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse navbar-menubuilder">
                    <ul class="nav navbar-nav navbar-right">

                        <li><a href="error.html">Sign in</a>
                        </li>
                        <li><a href="error.html">Sign up</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="page-container">
            <div class="slide" align="center">

            </div>
            <div style="height:50px;" class="container col-xs-9">   </div>
            <div class="container">

                <div class="col-xs-6">
                    <h2>Make a free reservation</h2>
                </div>

                <div class="hud col-xs-9">
                    <div class="mainselection row">
                        <form class="form-inline" method="post" action="search.php" enctype="multipart/form-data">
                            <div class="form-group">
                                <select name="party" class="controls form-control">
<?php
    $max = 20;
    for ($i = 1; $i <= $max; $i++) {
?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?> person</option>
<?php
    }
?>
                                    <option value="<?php echo $max + 1; ?>">Larger party</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="text" name="date" id="datepicker" class="controls form-control" value="DD-MM-YYYY">

                            </div>

                            <div class="form-group">
                                <select name="time" class="controls form-control">
<?php
    $max = 25;
    for ($i = 1; $i <= $max; $i++) {
        $hour = round(10 + $i / 2);
        $period = $hour < 12 ? 'AM' : 'PM';
        $hour %= 12;
        if ($hour == 0) {
            $hour = 12;
        }
        $minutes = $i % 2 == 0 ? '30' : '00';
?>
                                    <option value="<?php echo $i; ?>"><?php echo "{$hour}:{$minutes} {$period}"; ?></option>
<?php
    }
?>
                                </select>
                            </div>

                            <div class="form-group">
                                <input id="project" name="input" class="controls form-control" type="text" placeholder="Restaurants or Cuisine">
                                <input type="hidden" id="project-id" name="key">
                            </div>



                            <button type="submit" class="btn btn-default form-control">find a table</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php
require_once 'includes/footer.php';
