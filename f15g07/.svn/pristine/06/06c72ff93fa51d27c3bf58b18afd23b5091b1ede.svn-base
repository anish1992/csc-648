<?php
require_once 'db.php';

$target_dir = "uploads/";

$var_file = "file";
$var_desc = "desc";

$post_vars = filter_input_array(INPUT_POST);

$filename = basename($_FILES[$var_file]["name"]);
if (strlen($filename) == 0) {
    header('Location: index.php');
}

$path = $target_dir . $filename;
$desc = isset($post_vars[$var_desc]) ? $post_vars[$var_desc] : "";

$msg = "";
$status = 1;

$name = substr($filename, 0, strrpos($filename, '.'));
$extension = pathinfo($path, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if (isset($post_vars["submit"])) {
    $check = getimagesize($_FILES[$var_file]["tmp_name"]);

    if ($check === false) {
        $msg = "File is not an image.";
        $status = 0;
    }
}
// Check file size
if ($_FILES[$var_file]["size"] > 2000000) {
    $msg = "Sorry, your file is larger than 2,000,000 bytes.";
    $status = 0;
}
// Allow certain file formats
if (!in_array($extension, array("jpg", "jpeg", "png", "gif"))) {
    $msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $status = 0;
}
// Create thumbnails and insert information into database
if ($status > 0 && move_uploaded_file($_FILES[$var_file]["tmp_name"], $path)) {
    // Small
    $small = substr($path, 0, strrpos($path, '.')) . '_small.' . $extension;
    createThumbnail($path, 64, 64, $small);
    // Medium
    $medium = substr($path, 0, strrpos($path, '.')) . '_medium.' . $extension;
    createThumbnail($path, 96, 96, $medium);
    // Insert into database
    MainDB::insert($name, $desc, $path);
} else if (strlen($msg) == 0) {
    $msg = "Sorry, your file was not uploaded.";
}

function createThumbnail($path, $width, $height, $target) {
    list($src_width, $src_height) = getimagesize($path);
    // Calculate best fit dimensions while maintaining aspect ratio
    $ratio = $src_width / $src_height;
    if ($width / $height > $ratio) {
        $width = $height * $ratio;
    } else {
        $height = $width / $ratio;
    }
    // Resample image
    $image = imagecreatetruecolor($width, $height);
    // Load image
    $extension = pathinfo($path, PATHINFO_EXTENSION);
    if ($extension === 'jpg' || $extension === 'jpeg') {
        $src_image = imagecreatefromjpeg($path);
    } else if ($extension === 'png') {
        $src_image = imagecreatefrompng($path);
        imagealphablending($image, false);
        imagesavealpha($image, true);
    } else if ($extension === 'gif') {
        $src_image = imagecreatefromgif($path);
    }

    imagecopyresampled($image, $src_image, 0, 0, 0, 0, $width, $height, $src_width, $src_height);
    // Save thumbnail
    if ($extension === 'jpg' || $extension === 'jpeg') {
        imagejpeg($image, $target);
    } else if ($extension === 'png') {
        imagepng($image, $target);
    } else if ($extension === 'gif') {
        imagegif($image, $target);
    }
}
// Prepare variables for results page
if ($status == 0) {
    $vars = array(
        'e' => $msg
    );
} else {
    $vars = array(
        's'         => $msg,
        'src'       => $path,
        'name'      => $name,
        'desc'      => $desc,
        'small'     => $small,
        'medium'    => $medium
    );
}
// Display results page
require_once 'results.php';
