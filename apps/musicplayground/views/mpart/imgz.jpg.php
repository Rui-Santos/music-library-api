<?php 
/* header('Content-Type: image/jpeg'); */

// Create the image

$im = imagecreatefromjpeg("/PATH/GOES/HERE/api/img_cache/THE_MUSIC_PLAYGROUND/album_art/image_full_".$mpart->RecID.".jpg");

// Output the image
imagejpeg($im);

// Free up memory
imagedestroy($im);
?>