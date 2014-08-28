<?php

$count = count($stationplaylistlogsSet);
$more = false;
$resultsArray = array();

$length = count($stationplaylistlogsSet);
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

for ($i=$startNum; $i <= $limit; $i++) {
	$val = $stationplaylistlogsSet[$i-1];
	
	$result = $val;
	if($val->playlists()) {
		$result->title = $val->playlists()->title;
		$result->slug = $val->playlists()->slug;
	}
	if($val->playlist_shares()) {
		$result->shared_by = $val->playlist_shares()->from_email;
	}
	
	array_push($resultsArray, $result);
}

$returnArray = array('count'=>$count,'more'=>$more,'sortField'=>$sortField,'sortDir'=>$sortDir,'results'=>$resultsArray);
echo json_encode($returnArray);

?>