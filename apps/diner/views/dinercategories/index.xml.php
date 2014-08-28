<?php if(isset($flash)): ?>
<div class="error">
<?php echo $flash; ?>
</div>
<?php endif;
	$doc = new DOMDocument();
	$doc->formatOutput = true;
	$root_element = $doc->createElement("query");
	$root_element->setAttribute("count",count($dinercategoriesSet));
	$doc->appendChild($root_element);
	
	foreach($dinercategoriesSet as $dinercategories):
	
		$itemElement = $doc->createElement("item");
		$root_element->appendChild($itemElement);
	
		$dinercategoriesElement = $doc->createElement("category");
		$dinercategoriesElement->appendChild($doc->createTextNode(utf8_encode($dinercategories->Category)));
		$itemElement->appendChild($dinercategoriesElement);
	
		$artworkURIElement = $doc->createElement("artworkURI");
		$artworkURIElement->appendChild($doc->createTextNode(utf8_encode("http://208.65.156.27/THE_DINER/ART_small/" . $dinercategories->CDTitle . ".jpg")));
		$itemElement->appendChild($artworkURIElement);

		$artIDElement = $doc->createElement("artID");
		$artIDElement->appendChild($doc->createTextNode(utf8_encode($dinercategories->_PictureLink)));
		$itemElement->appendChild($artIDElement);

		$dinersubcategoriesElement = $doc->createElement("subcategory");
		$dinersubcategoriesElement->appendChild($doc->createTextNode(utf8_encode($dinercategories->SubCategory)));
		$itemElement->appendChild($dinersubcategoriesElement);	
	
	endforeach;
	print $doc->saveXML();

?>