<?php

$count = count($dinerpostingsSet);
$more = false;
$resultsArray = array();

$length = count($dinerpostingsSet);
$startpage = $pageNumber;
$limit = $pageLimit;

$term = isset($term) ? $term : false;

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

//foreach ($dinerpostingsSet as $val) {
for ($i=$startNum; $i <= $limit; $i++) {
	$val = $dinerpostingsSet[$i-1];
	
	$result = $val;
	
	array_push($resultsArray, $result);
}

$returnArray = array('count'=>$count,'more'=>$more,'page'=>$pageNumber,'type'=>$range,'sortField'=>$sortField,'sortDir'=>$sortDir,'term'=>$term,'results'=>$resultsArray);
echo json_encode($returnArray);

?>