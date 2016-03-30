<?php

/**
 * ImageHelper provides functions to retrieve images of different sizes.
 *
 * @author Gary Ng
 */
class ImageHelper {
    
    const IMAGE_DIR = 'images/';
    const CACHE_DIR = 'cache/';

    /**
     * Retrieve path of main image using restaurant key.
     */
    public static function getMainImage($key) {
        $extensions = array('.jpg', '.jpeg', '.png');
        
        foreach ($extensions as $extension) {
            $path = ImageHelper::IMAGE_DIR . $key . '/main' . $extension;

            if (file_exists($path)) {
                $filename = pathinfo($path, PATHINFO_FILENAME);
                $small = ImageHelper::CACHE_DIR . $key . '_' . $filename . "_small.jpg";

                if (!file_exists($small)) {
                    ImageHelper::convertToJPG($path, 256, 256, $small);
                }

                return $small;
            }
        }
    }

    /**
     * Retrieves all paths of gallery images using restaurant key.
     */
    public static function getGalleryImages($key) {
        $gallery = array();

        $path = ImageHelper::IMAGE_DIR . $key . '/gallery/';

        if (file_exists($path)) {
            foreach (scandir($path) as $file) {
                if (ImageHelper::endsWith($file, ".jpg") || ImageHelper::endsWith($file, ".jpeg") || ImageHelper::endsWith($file, ".png")) {
                    $tempPath = $path . $file;
                    
                    $filename = pathinfo($tempPath, PATHINFO_FILENAME);
                    $small = ImageHelper::CACHE_DIR . $key . '_' . $filename . "_small.jpg";

                    if (!file_exists($small)) {
                        ImageHelper::convertToJPG($tempPath, 256, 256, $small);
                    }

                    array_push($gallery, $small);
                }
            }
        }

        return $gallery;
    }

    /**
     * Generic function to check if string ends with a substring.
     */
    public static function endsWith($haystack, $needle) {
        $length = strlen($needle);
        if ($length == 0) {
            return true;
        }

        return substr($haystack, -$length) === $needle;
    }

    /**
     * Resizes any given image and exports as .JPG.
     */
    public static function convertToJPG($path, $width, $height, $target) {
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
        }

        imagecopyresampled($image, $src_image, 0, 0, 0, 0, $width, $height, $src_width, $src_height);
        // Save image
        imagejpeg($image, $target);
    }
}
