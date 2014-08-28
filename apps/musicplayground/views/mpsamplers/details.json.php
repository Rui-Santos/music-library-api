<?php

$more = false;
$resultsArray = array();
$itemArray = array();

foreach($mpsamplers->samplerAssets as $item) {
	if(substr($item->longID,0,8)=='unsigned') {
		$item->https = 'https://www.thedinermusic.com/api/'.$item->filepath;
		$item->LongID = $item->longID;
		$item->TrackTitle = $item->title;
		$item->RecID = 0;
		$item->Description = 'The Music Playground';
		$item->CDTitle = 'The Music Playground';
		$item->_PictureLink = 0;
		$item->_WaveformLink = 0;
		$item->httpsWav = $item->https;
		$item->Duration = '00:00';
	} else {
		if($item->getMetaData()) {
			$meta = $item->getMetaData();
			foreach($meta as $i=>$v) {
				$item->{$i}=$v;
			}
			foreach($item->cloudPrefixes()->MusicPlayground as $index=>$val) {
				$item->{$index} = $val . $meta->Filename;
			}
			$item->httpsWav = $item->cloudPrefixes()->MusicPlayground['https'] . str_replace('.mp3', '.aif', $meta->Filename);
		}
	}
	array_walk_recursive($item, 'encode_items');
	array_push($itemArray, $item);
}

function encode_items(&$item, $key)
{
    $item = utf8_encode($item);
}


$mpsamplers->item = $itemArray;
echo json_encode($mpsamplers);

?>