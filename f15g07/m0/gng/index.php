<?php
require_once 'includes/header.php';
?>
        <div id="main">
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <h2>Upload Image</h2>
                <input type="file" name="file">
                <h3>Description</h3>
                <input type="text" name="desc">
                <br />
                <input type="submit" value="Upload Image" name="submit">
            </form>
        </div>
<?php
require_once 'includes/footer.php';
