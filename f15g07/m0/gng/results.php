<?php
require_once 'includes/header.php';
?>
        <div id="wrapper">
            <div id="results">
<?php
if (isset($vars['e'])) {
?>
                <h2>Error</h2>
                <span><?php echo $vars['e']; ?></span>
<?php
} else if (isset($vars['s'])) {
?>
                <h2>Image Uploaded</h2>
                <br />
                <div id="left">
                    <div id="original">
                        <h3>Original (Scaled)</h3>
                        <img src="<?php echo $vars['src']; ?>" />
                        <br />
                        <span><?php echo $vars['src']; ?></span>
                    </div>
                    <br />
                    <div id="info">
                        <h3>Name</h3>
                        <span><?php echo $vars['name']; ?></span>
                        <h3>Description</h3>
                        <span><?php echo strlen($vars['desc']) > 0 ? $vars['desc'] : 'None'; ?></span>
                    </div>
                </div>
                <div id="right">
                    <div id="small">
                        <h3>Small</h3>
                        <img src="<?php echo $vars['small']; ?>" />
                        <br />
                        <span><?php echo $vars['small']; ?></span>
                    </div>
                    <br />
                    <div id="medium">
                        <h3>Medium</h3>
                        <img src="<?php echo $vars['medium']; ?>" />
                        <br />
                        <span><?php echo $vars['medium']; ?></span>
                    </div>
                </div>
<?php
}
?>
            </div>
        </div>
    </div>
<?php
require_once 'includes/footer.php';
