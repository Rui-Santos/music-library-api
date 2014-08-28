<?php if(isset($flash)): ?>
<div class="error">
<?php echo $flash; ?>
</div>
<?php endif;
	$doc = new DOMDocument();
	$doc->formatOutput = true;
	$root_element = $doc->createElement("query");
	$doc->appendChild($root_element);
	
	$count = count($prosfxcategoriesSet);
	
	$title_array = array();
	
	$lastElement;

	foreach($prosfxcategoriesSet as $prosfxcategories):
	
		if (!in_array($prosfxcategories->CDTitle, $title_array) && $prosfxcategories->CDTitle != 'Sound Design') {
			array_push($title_array, $prosfxcategories->CDTitle);
			$itemElement = $doc->createElement("item");
			$root_element->appendChild($itemElement);
		
			$prosfxcdTitleElement = $doc->createElement("CDTitle");
			$prosfxcdTitleElement->appendChild($doc->createTextNode(utf8_encode($prosfxcategories->CDTitle)));
			$itemElement->appendChild($prosfxcdTitleElement);
		
			$artworkURIElement = $doc->createElement("artworkURI");
			$artworkURIElement->appendChild($doc->createTextNode(utf8_encode("http://208.65.156.27/api/prosfx/art/".$prosfxcategories->_PictureLink."/100")));
			$itemElement->appendChild($artworkURIElement);
		
			if ($prosfxcategories->Category) {
				$prosfxcategoriesElement = $doc->createElement("Category");
				$prosfxcategoriesElement->appendChild($doc->createTextNode(utf8_encode($prosfxcategories->Category)));
				$itemElement->appendChild($prosfxcategoriesElement);
			}
			
			$lastElement = $itemElement;
		} else {
			$count--;

			if ($prosfxcategories->Category) {
				$prosfxcategoriesElement = $doc->createElement("Category");
				$prosfxcategoriesElement->appendChild($doc->createTextNode(utf8_encode($prosfxcategories->Category)));
				$lastElement->appendChild($prosfxcategoriesElement);
			}
			
		}
	endforeach;
	$root_element->setAttribute("count",$count);
	print $doc->saveXML();

?>