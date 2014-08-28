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
	
	foreach($dinermetadataSet as $dinermetadata):
	
		$itemElement = $doc->createElement("item");
		$root_element->appendChild($itemElement);
	
		$dinermetadataElement = $doc->createElement("Category");
		$dinermetadataElement->appendChild($doc->createTextNode(utf8_encode($dinermetadata->Category)));
		$itemElement->appendChild($dinermetadataElement);
	
		$artIDElement = $doc->createElement("_PictureLink");
		$artIDElement->appendChild($doc->createTextNode(utf8_encode($dinermetadata->_PictureLink)));
		$itemElement->appendChild($artIDElement);

		$dinersubcategoriesElement = $doc->createElement("SubCategory");
		$dinersubcategoriesElement->appendChild($doc->createTextNode(utf8_encode($dinermetadata->SubCategory)));
		$itemElement->appendChild($dinersubcategoriesElement);	
	
	endforeach;
	print $doc->saveXML();

?>