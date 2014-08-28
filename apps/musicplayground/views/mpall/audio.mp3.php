<?php
$file = "/Users/thestation/Music/THE_MUSIC_PLAYGROUND/mp3/" . $mpall->Filename;

/* header("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0"); */
/* header("Pragma: no-cache"); */
/* header("Content-Disposition: attachment; filename=\"" . $mpall->Filename . "\""); */
/* header("Content-Length: " . filesize($file)); */

readfile($file);
/*
$fp=fopen($file, "r");
fpassthru($fp);
exit();
*/
?>