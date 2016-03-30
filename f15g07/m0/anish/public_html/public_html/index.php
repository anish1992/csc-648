<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>CSc648_M0</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <style>
            body {background-color: gray;}
            h2 {color:darkslategrey;}
            .dash {
                background-color: orange; 
                padding:10px 0px 25px 0px; 
                border-radius: 25px;
            }
            .form-control {width:700px;}
            .col-md-3 {width: 260px}
        </style>

    </head>
    <body >
        
        <!--place holder-->
        <div style="height: 240px;"></div>
        <!--main dash-->
        <div align="center" class="dash container">
            
            <form method="post" action="upload.php" enctype="multipart/form-data">
                <h2>Select image to upload:</h2>
                <input style="background-color: antiquewhite; height: 25;" type="file" name="link" value="Browse"> 
                <br/>
                <h2>Description :</h2>
                <br/>
                
                <input class="form-control" placeholder="Enter Discription Here" type="text" name="disp"/>
                <br/>
                
                <div class="row">
                    <div class="col-md-3" ></div>
                    <div class="col-md-4" ></div>
                    <div class="col-md-4 ">
                        <input class="btn btn-default" type="submit" name="submit" value="Click be to resize image"/>
                    </div>
                </div>
                
            </form>
        </div>
        
    </body>
</html>