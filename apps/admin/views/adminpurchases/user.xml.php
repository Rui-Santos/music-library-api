<?php if(isset($flash)): ?>
<div class="error">
<?php echo $flash; ?>
</div>
<?php endif;

$doc = new DOMDocument();
$doc->formatOutput = true;
$root_element = $doc->createElement("query");
$root_element->setAttribute("count",count($purchaseSet));
$doc->appendChild($root_element);

foreach($purchaseSet as $p) {

	$itemElement = $doc->createElement("item");
	$root_element->appendChild($itemElement);
	

	$idElement = $doc->createElement("id");
	$idElement->appendChild($doc->createTextNode(utf8_encode($p->id)));
	$itemElement->appendChild($idElement);
	
	$hashElement = $doc->createElement("hash");
	$hashElement->appendChild($doc->createTextNode(utf8_encode($p->hash)));
	$itemElement->appendChild($hashElement);
	
	$stripeIDElement = $doc->createElement("stripe_id");
	$stripeIDElement->appendChild($doc->createTextNode(utf8_encode($p->stripe_id)));
	$itemElement->appendChild($stripeIDElement);
	
	$amountElement = $doc->createElement("amount");
	$amountElement->appendChild($doc->createTextNode(utf8_encode($p->amount)));
	$itemElement->appendChild($amountElement);
	
	$dateElement = $doc->createElement("date");
	$dateElement->appendChild($doc->createTextNode(utf8_encode($p->date)));
	$itemElement->appendChild($dateElement);
	
	$typeElement = $doc->createElement("type");
	$typeElement->appendChild($doc->createTextNode(utf8_encode($p->type)));
	$itemElement->appendChild($typeElement);
	
	$statusElement = $doc->createElement("status");
	$statusElement->appendChild($doc->createTextNode(utf8_encode($p->status)));
	$itemElement->appendChild($statusElement);
	
	$dlsElement = $doc->createElement("dls_remaining");
	$dlsElement->appendChild($doc->createTextNode(utf8_encode($p->dls_remaining)));
	$itemElement->appendChild($dlsElement);

}

print $doc->saveXML();

?>