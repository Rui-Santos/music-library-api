<?php

$count = count($stationplaylistsharesSet);
$more = false;
$resultsArray = array();

/*
$length = count($stationplaylistsSet);
$startpage = $pageNumber;
$limit = $pageLimit;

$startNum = (($startpage-1)*$limit)+1;

if ($limit == 0) {
	$limit = $length;
} else {
	$limit = $startpage * $limit;
	if($limit > $length) {
		$limit = $length;
	} else {
		$more = true;
	}
}

*/
foreach ($stationplaylistsharesSet as $val) {
	
	$result = $val;
	if($val->playlists()) {
		$result->title = $val->playlists()->title;
		$result->slug = $val->playlists()->slug;
	}
	if($val->playlist_logs()) {
		$result->log = array();
		foreach($val->playlist_logs()->orderBy('date_logged DESC') as $v) {
			array_push($result->log, $v);
		}
	}
	
	array_push($resultsArray, $result);
}

$returnArray = array('count'=>$count,'more'=>$more,'results'=>$resultsArray);
echo json_encode($returnArray);

?>