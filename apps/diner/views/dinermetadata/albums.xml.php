<?php if(isset($flash)): ?>
<div class="error">
<?php echo $flash; ?>
</div>
<?php endif;
	$doc = new DOMDocument();
	$doc->formatOutput = true;
	$root_element = $doc->createElement("query");
	$root_element->setAttribute("count",count($dinermetadataSet));
	$doc->appendChild($root_element);
	
	$title_array = array();

	foreach($dinermetadataSet as $dinermetadata) {
		
		if (!in_array($dinermetadata->CDTitle, $title_array)) {
			array_push($title_array, $dinermetadata->CDTitle);
			$itemElement = $doc->createElement("item");
			$root_element->appendChild($itemElement);
		
			$dinermetadataElement = $doc->createElement("CDTitle");
			$dinermetadataElement->appendChild($doc->createTextNode(utf8_encode($dinermetadata->CDTitle)));
			$itemElement->appendChild($dinermetadataElement);
		
			$dinersubcategoriesElement = $doc->createElement("SubCategory");
			$dinersubcategoriesElement->appendChild($doc->createTextNode(utf8_encode($dinermetadata->SubCategory)));
			$itemElement->appendChild($dinersubcategoriesElement);	
		
			$dinercategoryElement = $doc->createElement("Category");
			$dinercategoryElement->appendChild($doc->createTextNode(utf8_encode($dinermetadata->Category)));
			$itemElement->appendChild($dinercategoryElement);
		
			$dineralbumArtElement = $doc->createElement("_PictureLink");
			$dineralbumArtElement->appendChild($doc->createTextNode(utf8_encode($dinermetadata->_PictureLink)));
			$itemElement->appendChild($dineralbumArtElement);
		}
		
	}
	print $doc->saveXML();

?>