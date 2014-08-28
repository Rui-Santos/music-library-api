<?php if(isset($flash)): ?>
<div class="error">
<?php echo $flash; ?>
</div>
<?php endif; 
	$doc = new DOMDocument();
	$doc->formatOutput = true;
	$root_element = $doc->createElement("query");
	$root_element->setAttribute("count",count($mpartistinfoSet));
	$doc->appendChild($root_element);
	
	foreach($mpartistinfoSet as $mpartist):
	
		$itemElement = $doc->createElement("item");
		$root_element->appendChild($itemElement);
	
		$artistIDElement = $doc->createElement("id");
		$artistIDElement->appendChild($doc->createTextNode(utf8_encode($mpartist->id)));
		$itemElement->appendChild($artistIDElement);
	
		$artistElement = $doc->createElement("artist");
		$artistElement->appendChild($doc->createTextNode(utf8_encode($mpartist->artist)));
		$itemElement->appendChild($artistElement);
	
		$sourceElement = $doc->createElement("filename");
		$sourceElement->appendChild($doc->createTextNode(utf8_encode($mpartist->filename)));
		$itemElement->appendChild($sourceElement);
				
		$bioElement = $doc->createElement("bio");
		$bioElement->appendChild($doc->createTextNode(utf8_encode(urlencode($mpartist->bio))));
		$itemElement->appendChild($bioElement);
				
		$artIDElement = $doc->createElement("photo");
		$artIDElement->appendChild($doc->createTextNode(utf8_encode($mpartist->photo)));
		$itemElement->appendChild($artIDElement);
				
	endforeach;
	print $doc->saveXML();

?>
