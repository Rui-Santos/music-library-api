<?php

	$output = array();
	foreach($mpsiteadminSet as $val) {
		$output[$val->section] = $val;
	}
	echo json_encode($output);

?>