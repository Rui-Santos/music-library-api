<?php if(isset($flash)): ?>
<div class="error">
<?php echo $flash; ?>
</div>
<?php endif;
	$doc = new DOMDocument();
	$doc->formatOutput = true;
	$root_element = $doc->createElement("query");
	$root_element->setAttribute("count",count($mpcategoriesSet));
	$doc->appendChild($root_element);
	
	foreach($mpcategoriesSet as $mpcategories):
	
		$itemElement = $doc->createElement("item");
		$root_element->appendChild($itemElement);
	
		$mpcategoriesElement = $doc->createElement("category");
		$mpcategoriesElement->appendChild($doc->createTextNode(utf8_encode($mpcategories->Category)));
		$itemElement->appendChild($mpcategoriesElement);
	
	endforeach;
	print $doc->saveXML();

?>