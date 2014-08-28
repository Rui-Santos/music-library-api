<?php
$count = count($dinermetadataSet);
$more = false;
$resultsArray = array();

$length = count($dinermetadataSet);
$startpage = $pageNumber;
$limit = 15;

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
	$v = $dinermetadataSet[$i-1];
	array_push($resultsArray, $v);
}

$returnArray = array('count'=>$count,'more'=>$more, 'page'=>$pageNumber, 'type'=>$type, 'results'=>$resultsArray);
echo json_encode($returnArray);

?>