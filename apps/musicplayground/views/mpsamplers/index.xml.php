<?php if(isset($flash)): ?>
<div class="error">
<?php echo $flash; ?>
</div>
<?php endif;
	$doc = new DOMDocument();
	$doc->formatOutput = true;
	$root_element = $doc->createElement("query");
	$root_element->setAttribute("count",count($mpsamplersSet));
	$doc->appendChild($root_element);
	
	foreach($mpsamplersSet as $mpsamplers):
	
		$itemElement = $doc->createElement("item");
		$root_element->appendChild($itemElement);
	
		$mpsamplersIDElement = $doc->createElement("id");
		$mpsamplersIDElement->appendChild($doc->createTextNode(utf8_encode($mpsamplers->id)));
		$itemElement->appendChild($mpsamplersIDElement);
	
		$mpsamplersNameElement = $doc->createElement("name");
		$mpsamplersNameElement->appendChild($doc->createTextNode(utf8_encode($mpsamplers->name)));
		$itemElement->appendChild($mpsamplersNameElement);
	
		$mpsamplersSlugElement = $doc->createElement("slug");
		$mpsamplersSlugElement->appendChild($doc->createTextNode(utf8_encode($mpsamplers->slug)));
		$itemElement->appendChild($mpsamplersSlugElement);
	
		$mpsamplersTypeElement = $doc->createElement("type");
		$mpsamplersTypeElement->appendChild($doc->createTextNode(utf8_encode($mpsamplers->type)));
		$itemElement->appendChild($mpsamplersTypeElement);
	
		$mpsamplersStateElement = $doc->createElement("state");
		$mpsamplersStateElement->appendChild($doc->createTextNode(utf8_encode($mpsamplers->state)));
		$itemElement->appendChild($mpsamplersStateElement);
	
		$mpsamplersDescriptionElement = $doc->createElement("description");
		$mpsamplersDescriptionElement->appendChild($doc->createTextNode(utf8_encode($mpsamplers->description)));
		$itemElement->appendChild($mpsamplersDescriptionElement);
		
		$mpsamplersArtworkElement = $doc->createElement("artwork");
		$mpsamplersArtworkElement->appendChild($doc->createTextNode(utf8_encode($mpsamplers->artwork)));
		$itemElement->appendChild($mpsamplersArtworkElement);
		
/*
		$samplerAssets = $mpsamplers->getAssets();
		$c = $doc->createElement("count");
		$c->appendChild($doc->createTextNode(utf8_encode(count($samplerAssets))));
		$itemElement->appendChild($c);
*/
	
	endforeach;
	print $doc->saveXML();

?>