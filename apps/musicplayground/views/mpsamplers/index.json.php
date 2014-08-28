<?php

$count = count($mpsamplersSet);
$more = false;
$resultsArray = array();

$type = isset($type) ? $type : false;
$term = isset($term) ? $term : false;

$length = count($mpsamplersSet);
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

//foreach ($dinerpostingsSet as $val) {
for ($i=$startNum; $i <= $limit; $i++) {
	$val = $mpsamplersSet[$i-1];
	
	$result = $val;
	
	array_push($resultsArray, $result);
}

$returnArray = array('count'=>$count,'more'=>$more,'page'=>$pageNumber,'type'=>$type,'term'=>$term,'results'=>$resultsArray);
echo json_encode($returnArray);

?>