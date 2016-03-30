<?php
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadBool = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
?>