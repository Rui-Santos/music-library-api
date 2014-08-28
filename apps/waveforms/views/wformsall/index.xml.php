<?php if(isset($flash)): ?>
<div class="error">
<?php echo $flash; ?>
</div>
<?php endif;
	$doc = new DOMDocument();
	$doc->formatOutput = true;
	$root_element = $doc->createElement("query");
	$root_element->setAttribute("count",count($wformsallSet));
	$doc->appendChild($root_element);
	
	foreach($wformsallSet as $wformsall):
	
		$itemElement = $doc->createElement("item");
		$root_element->appendChild($itemElement);
	
		$wformsallElement = $doc->createElement("id");
		$wformsallElement->appendChild($doc->createTextNode(utf8_encode($wformsall->RecID)));
		$itemElement->appendChild($wformsallElement);
	
	
	endforeach;
	print $doc->saveXML();

?>