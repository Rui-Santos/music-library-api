<?php if(isset($flash)): ?>
<div class="error">
<?php echo $flash; ?>
</div>
<?php endif;
	$doc = new DOMDocument();
	$doc->formatOutput = true;
	$root_element = $doc->createElement("query");
	$root_element->setAttribute("count",count($mpmetadataSet));
	$doc->appendChild($root_element);
	
	foreach($mpmetadataSet as $mpmetadata):
	
		$itemElement = $doc->createElement("item");
		$root_element->appendChild($itemElement);
	
		$mpmetadataElement = $doc->createElement("category");
		$mpmetadataElement->appendChild($doc->createTextNode(utf8_encode($mpmetadata->Category)));
		$itemElement->appendChild($mpmetadataElement);
	
	endforeach;
	print $doc->saveXML();

?>