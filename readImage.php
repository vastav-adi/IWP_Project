<?php
function readImage($location) {
    $handle = fopen($location, "r");
    $fileInput = fread($handle, filesize($location));
    $writer = fopen("image.png", "w");
    fputs($writer, $fileInput);
}
?>