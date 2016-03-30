<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check for an actual image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if(isset($_POST["name"])){
$name = $_POST["name"];}
else{
$name=NULL;}
if(isset($_POST["description"])){
$desc=$_POST["description"];
}
else{
$desc=NULL;}

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
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
      
echo " <a  href = \"http://sfsuswe.com/~sundurth/index.php\">Click here to upload another image!</a>";
}

 else {
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
$image = pathinfo($target_file);
                    $image_path = $image["dirname"]."/".$image["basename"];
                    $med_image_path = $image["dirname"]."/".$image["filename"]."_medium.".$image["extension"];
    
     $small_image_path = $image["dirname"]."/".$image["filename"]."_small.".$image["extension"];
                    $image_name = $image["basename"];
                    $med_image_name = $image["filename"]."_medium.".$image["extension"];
                    $small_image_name = $image["filename"]."_small.".$image["extension"];

                    $med_percent = 0.20;
                    $small_percent = 0.10;
                    image_resize($image_path,$med_image_path,$med_percent,$imageFileType);
                    image_resize($image_path, $small_image_path, $small_percent,$imageFileType);
                    saveimage($name,$desc,$image_path,$med_image_path,$small_image_path);
                    if($name!= NULL){
                        echo "<p> Name: ".$name."</p>";
                    }
                    else {
                        echo "<p>No name was specified</p>";
                    }
                    if($desc!= NULL){
                        echo "<p> Description: ".$desc."</p>";
                    }
                    else{
                        echo "<p>No description was specified</p>";
                    }
echo " <a href = \"http://sfsuswe.com/~sundurth/index.php\">Click here to upload another image!</a>";
                    echo "<br><br><br>";
                    echo "<img src =\"$small_image_path\"/>";
                    echo "<div>".$small_image_name."</div>";
                    echo "<br><hr>";
                    echo "<img src =\"$med_image_path \"/>";
                    echo "<div>".$med_image_name."</div>";
                    echo "<br><hr>";
                    echo "<img src =\"$image_path\" width = \"800px\" height =\"600px\" \"/>";
                    echo "<div>".$image_name."</div>";
                    echo "<br><br>";
}
                else {
                    echo "<p class=\"error\">Sorry, there was an error uploading your file.</p>";
echo " <a  href = \"http://sfsuswe.com/~sundurth/index.php\">Click here to upload another image!</a>";

                }
            }

    
     function image_resize($image_path,$new_image_path,$percent,$imageFileType){
                list($width,$height) = getimagesize($image_path);
                $new_width = $width*$percent;
                $new_height = $height*$percent;
                $resize_image = imagecreatetruecolor($new_width, $new_height);
                if ($imageFileType ==="jpeg"||$imageFileType ==="jpg"){
                    $image = imagecreatefromjpeg($image_path);
                }
                else if ($imageFileType ==="png"){
                    $image = imagecreatefrompng($image_path);
                }
                imagecopyresampled($resize_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                imagejpeg($resize_image,$new_image_path , 100);

            }

            function saveimage ($name,$desc,$img_path,$med_image_path,$small_image_path){
                $servername = "sfsuswe.com";
                $username = "sundurth";
                $password = "sai123wiwo";
                $dbname = "student_sundurth";

                $conn = mysql_connect("sfsuswe.com", "sundurth", "sai123wiwo");
                mysql_select_db($dbname,$conn);

                $sql = "insert into images (name,description, img_name,med_img_name,small_img_name) values ('$name','$desc','$img_path','$med_image_path','$small_image_path')";
                $result = mysql_query($sql);
                if ($result){
                    echo "<br/>Image uploaded to database";
                }
else {
                    echo "<br/> Image not uploaded to database";
                }
            }
?>

    
