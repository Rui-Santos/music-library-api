<?php
/*
    header('Content-length: ' . filesize($asset->FilePath));
    header('Content-Disposition: filename="' . $asset->Filename);
*/
    //header('Cache-Control: no-cache');
	//header("Content-Transfer-Encoding: chunked"); 
	header("Accept-Ranges: bytes");
	header("Connection: Keep-Alive");
    header('Content-length: ' . $size);
    header('Content-Range: bytes 0-'.$size-1.'/'.$size);
    header('Keep-Alive:timeout=15, max=500');
	readfile($asset->FilePath);
/*
    $fp = fopen($asset->FilePath, "r");
    $data = fread($fp, filesize($asset->FilePath));
    fclose($fp);
    print $data;
*/
?>