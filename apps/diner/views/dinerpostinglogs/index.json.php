<?php

$count = count($postingSet);
$more = false;
$resultsArray = array();

$length = count($postingSet);
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
	$v = $postingSet[$i-1];
	$v->name = $v->postings() ? $v->postings()->name : $v->posting_account;
	array_push($resultsArray, $v);
}

$returnArray = array('count'=>$count,'more'=>$more, 'page'=>$pageNumber, 'pageLimit'=>$pageLimit, 'sortField'=>$sortField,'sortDir'=>$sortDir,'term'=>$term,'type'=>$type, 'results'=>$resultsArray);
echo json_encode($returnArray);

?>