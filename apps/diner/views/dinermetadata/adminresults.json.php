<?php

$resultsArray = array();
$count = count($results);

foreach($results as $index=>$result){
	
	$result->cloud_path = $result->cloudPrefixes()->{$result->Manufacturer}['path'];
	array_walk_recursive($result, 'encode_items');
	array_push($resultsArray, $result);
}

function encode_items(&$item, $key)
{
    $item = utf8_encode($item);
}

$returnArray = array('count'=>$count,'results'=>$resultsArray);
echo json_encode($returnArray);



?>