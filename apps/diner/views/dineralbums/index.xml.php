<?php if(isset($flash)): ?>
<div class="error">
<?php echo $flash; ?>
</div>
<?php endif;
	$doc = new DOMDocument();
	$doc->formatOutput = true;
	$root_element = $doc->createElement("query");
	$root_element->setAttribute("count",count($dineralbumsSet));
	$doc->appendChild($root_element);
	
	foreach($dineralbumsSet as $dineralbums) {
		
		$itemElement = $doc->createElement("item");
		$root_element->appendChild($itemElement);
	
		$dineralbumsElement = $doc->createElement("album");
		$dineralbumsElement->appendChild($doc->createTextNode(utf8_encode($dineralbums->CDTitle)));
		$itemElement->appendChild($dineralbumsElement);
	
		$artworkURIElement = $doc->createElement("artworkURI");
		$artworkURIElement->appendChild($doc->createTextNode(utf8_encode("http://208.65.156.27/THE_DINER/ART_small/" . $dineralbums->CDTitle . ".jpg")));
		$itemElement->appendChild($artworkURIElement);
	
		$dinersubcategoriesElement = $doc->createElement("subcategory");
		$dinersubcategoriesElement->appendChild($doc->createTextNode(utf8_encode($dineralbums->SubCategory)));
		$itemElement->appendChild($dinersubcategoriesElement);	
	
		$dinercategoryElement = $doc->createElement("category");
		$dinercategoryElement->appendChild($doc->createTextNode(utf8_encode($dineralbums->Category)));
		$itemElement->appendChild($dinercategoryElement);
	
		$dineralbumArtElement = $doc->createElement("artID");
		$dineralbumArtElement->appendChild($doc->createTextNode(utf8_encode($dineralbums->_PictureLink)));
		$itemElement->appendChild($dineralbumArtElement);
		
	}
	print $doc->saveXML();

?>