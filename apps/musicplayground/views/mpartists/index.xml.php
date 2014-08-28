<?php if(isset($flash)): ?>
<div class="error">
<?php echo $flash; ?>
</div>
<?php endif; 
	$doc = new DOMDocument();
	$doc->formatOutput = true;
	$root_element = $doc->createElement("query");
	$root_element->setAttribute("count",count($mpartistsSet));
	$doc->appendChild($root_element);
	
	foreach($mpartistsSet as $mpartist):
	
		$itemElement = $doc->createElement("item");
		$root_element->appendChild($itemElement);
	
		$artistElement = $doc->createElement("artist");
		$artistElement->appendChild($doc->createTextNode(utf8_encode($mpartist->Library)));
		$itemElement->appendChild($artistElement);
	
		$artworkURIElement = $doc->createElement("artworkURI");
	$artworkURIElement->appendChild($doc->createTextNode(utf8_encode("http://208.65.156.27/THE_MUSIC_PLAYGROUND/ART/" . $mpartist->Library . ".jpg")));
		$itemElement->appendChild($artworkURIElement);

		$sourceElement = $doc->createElement("source");
		$sourceElement->appendChild($doc->createTextNode(utf8_encode($mpartist->Source)));
		$itemElement->appendChild($sourceElement);
				
	endforeach;
	print $doc->saveXML();

?>
