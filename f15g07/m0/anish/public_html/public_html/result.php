<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>CSc648_M0</title>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <style>
            body    {background-color: gray;}
            span    {word-wrap: break-word;}
            .original   {height: 128px}
            
            h2 {color:darkslategrey;}
            h3 {color:darkslategrey;}
            #body1    {
                background-color: orange;
                padding:10px 10px 10px 10px; 
                border-top-left-radius:2em;
                border-top-right-radius:2em;
            }
            
            #body2    {
                background-color: orange;
                padding:10px 10px 10px 10px; 
                border-bottom-right-radius:2em;
                border-bottom-left-radius:2em;
            }
                
            #cent   {
                background-color: orange;
                padding:10px 10px 10px 10px; 
                text-align: center;
            }
            a{
                background-color: whitesmoke;
                padding:10px 10px 10px 10px; 
            }
        </style>
    </head>
    <body>
        <?php
            if (isset($var['e'])) {
        ?>
        <h2>Error</h2>
        <span><?php echo $var['e']; ?></span>
        <?php
            } else if (isset($var['s'])) {
        ?>
        <div class="container">
            <div style=" height:50px;"></div>
            <div class="row" id = "body1">
                <h2>Image Uploaded :</h2>
            </div>
            <div style=" height:10px;"></div>
            <div class="row" id = "cent">
                <div class="col-sm-4">

                    <h3>Large</h3>
                    <img class="original" src="<?php echo $var['src']; ?>" />
                    <br />

                    <span><?php echo $var['src']; ?></span>
                </div>
                <div class="col-sm-4">

                    <h3>Medium</h3>
                    <img src="<?php echo $var['medium']; ?>" />
                    <br />
                    <span><?php echo $var['medium']; ?></span>
                </div>
                <div class="col-sm-4">
                    <h3>Small</h3>
                    <img src="<?php echo $var['small']; ?>" />
                    <br />
                    <span><?php echo $var['small']; ?></span>
                </div>
            </div> 
            <div style=" height:10px;"></div>
            <div class="row" id = "body2">
                <h3>Name of the file :</h3>
                <div class="col-xs-8">
                    <input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $var['name']; ?>" disabled>
                </div>
                <br/>
                <h3>Description given :</h3>
                <div class="col-xs-8">
                    <input class="form-control" id="disabledInput" type="text" placeholder="<?php echo strlen($var['desc']) > 0 ? $var['desc'] : 'None'; ?>" disabled>
                </div>
                
                <div class="text-center">
                    <a class="btn btn-primary btn-lg" href="index.php" role="button">go back to main page</a>
                </div>
            </div>
        </div>
                   
        <?php
        }
        ?>
        
    </body>
</html>