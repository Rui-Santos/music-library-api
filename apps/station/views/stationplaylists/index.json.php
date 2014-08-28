<?php

$count = count($stationplaylistsSet);
$more = false;
$resultsArray = array();

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

for ($i=$startNum; $i <= $limit; $i++) {
	array_push($resultsArray, $stationplaylistsSet[$i-1]);
}

$returnArray = array('count'=>$count,'more'=>$more,'page'=>$pageNumber,'results'=>$resultsArray);
echo json_encode($returnArray);

?>