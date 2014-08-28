<?php if(isset($flash)): ?>
<div class="error">
<?php echo $flash; ?>
</div>
<?php endif;
	$doc = new DOMDocument();
	$doc->formatOutput = true;
	$root_element = $doc->createElement("query");
	$doc->appendChild($root_element);
	
	$count = count($prosfxmetadataSet);
	
	$title_array = array();
	
	$lastElement;

	foreach($prosfxmetadataSet as $prosfxmetadata):
	
		if (!in_array($prosfxmetadata->CDTitle, $title_array)) {
			array_push($title_array, $prosfxmetadata->CDTitle);
			$itemElement = $doc->createElement("item");
			$root_element->appendChild($itemElement);
		
			$prosfxcdTitleElement = $doc->createElement("CDTitle");
			$prosfxcdTitleElement->appendChild($doc->createTextNode(utf8_encode($prosfxmetadata->CDTitle)));
			$itemElement->appendChild($prosfxcdTitleElement);
		
			$artworkURIElement = $doc->createElement("artworkURI");
			$artworkURIElement->appendChild($doc->createTextNode(utf8_encode("http://208.65.156.27/api2/art/prosfx/".$prosfxmetadata->_PictureLink."/100")));
			$itemElement->appendChild($artworkURIElement);
		
			if ($prosfxmetadata->Category) {
				$prosfxmetadataElement = $doc->createElement("Category");
				$prosfxmetadataElement->appendChild($doc->createTextNode(utf8_encode($prosfxmetadata->Category)));
				$itemElement->appendChild($prosfxmetadataElement);
			}
			
			$lastElement = $itemElement;
		} else {
			$count--;

			if ($prosfxmetadata->Category) {
				$prosfxmetadataElement = $doc->createElement("Category");
				$prosfxmetadataElement->appendChild($doc->createTextNode(utf8_encode($prosfxmetadata->Category)));
				$lastElement->appendChild($prosfxmetadataElement);
			}
			
		}
	endforeach;
	$root_element->setAttribute("count",$count);
	print $doc->saveXML();

?>