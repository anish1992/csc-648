<?php
require_once "database.php";
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$var_desc = "desc";
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$post_vars = filter_input_array(INPUT_POST);
$name = substr($target_file, 0, strrpos($target_file, '.'));
$desc = isset($post_vars[$var_desc]) ? $post_vars[$var_desc] : "";
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["file"]["size"] > 1000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

if ($uploadOk > 0 && move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    $small = substr($target_file, 0, strrpos($target_file, '.')) . '_small.' . $imageFileType;
    createThumbnail($target_file, 64, 64, $small);
    
    $medium = substr($target_file, 0, strrpos($target_file, '.')) . '_medium.' . $imageFileType;
    createThumbnail($target_file, 96, 96, $medium);
    
    MainDB::insert($name, $desc, $target_file);
} else{
    echo "Sorry, your file was not uploaded.";
}

function createThumbnail($target_file, $width, $height, $target) {
    list($src_width, $src_height) = getimagesize($target_file);
    $ratio = $src_width / $src_height;
    if ($width / $height > $ratio) {
        $width = $height * $ratio;
    } else {
        $height = $width / $ratio;
    }
    
    $image = imagecreatetruecolor($width, $height);
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    if ($imageFileType === 'jpg' || $imageFileType === 'jpeg') {
        $src_image = imagecreatefromjpeg($target_file);
    } else if ($imageFileType === 'png') {
        $src_image = imagecreatefrompng($target_file);
        imagealphablending($image, false);
        imagesavealpha($image, true);
    } else if ($imageFileType === 'gif') {
        $src_image = imagecreatefromgif($target_file);
    }

    imagecopyresampled($image, $src_image, 0, 0, 0, 0, $width, $height, $src_width, $src_height);
    if ($imageFileType === 'jpg' || $imageFileType === 'jpeg') {
        imagejpeg($image, $target);
    } else if ($imageFileType === 'png') {
        imagepng($image, $target);
    } else if ($imageFileType === 'gif') {
        imagegif($image, $target);
    }
}

if ($uploadOk == 0) {
    $vars = array(
        'e' => "error"
    );
} else {
    $vars = array(
        's'         => "success",
        'src'       => $target_file,
        'name'      => $name,
        'desc'      => $desc,
        'small'     => $small,
        'medium'    => $medium
    );
}
require_once 'success.php';