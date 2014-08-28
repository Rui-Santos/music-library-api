<?php

$more = false;
$resultsArray = array();
$itemArray = array();

foreach($dinerpostings->postingAssets as $item) {
	if(substr($item->longID,0,8)=='unsigned') {
		$item->https = 'https://www.thedinermusic.com/api/'.$item->filepath;
		$item->LongID = $item->longID;
		$item->TrackTitle = $item->title;
		$item->RecID = 0;
		$item->Description = 'The Diner';
		$item->CDTitle = 'The Diner';
		$item->_PictureLink = 0;
		$item->_WaveformLink = 0;
		$item->httpsWav = $item->https;
		$item->Duration = '00:00';
	} else {
		foreach($item->cloudPrefixes()->{$item->Manufacturer} as $index=>$val) {
			$item->{$index} = $val . $item->Filename;
		}
		$item->httpsWav = $item->cloudPrefixes()->Diner['https'] . str_replace('.mp3', '.aif', $item->Filename);
	}
	array_walk_recursive($item, 'encode_items');
	array_push($itemArray, $item);
}

function encode_items(&$item, $key)
{
    $item = utf8_encode($item);
}


$dinerpostings->item = $itemArray;
echo json_encode($dinerpostings);

?>