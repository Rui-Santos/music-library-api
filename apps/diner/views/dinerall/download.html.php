<?php
    //Set this to the base of where files 
    //can be downloaded from for security measures.
    
/*
    $basedir = $dinerall->Pathname;
    $file = $dinerall->Filename;
    if(!$file) {
        print "Sorry that file does not exist";
        exit;
        }
    elseif(!file_exists($basedir."/".$file)) {
        print "Sorry that file does not exist";
        exit;
        }
    else {
        //header("Content-Type: octet/stream");
        //header("Content-Disposition: attachment; filename=\"".$file."\"");
        $fp = fopen($basedir."/".$file, "r");
        $data = fread($fp, filesize($basedir."/".$file));
        fclose($fp);
        print $data;
    }
*/
echo $dinerall->Filename;
?> 