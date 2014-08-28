<?php if(isset($flash)): ?>
<div class="error">
<?php echo $flash; ?>
</div>
<?php endif;

/* $artistTracksSet = $mpartistinfo->metadata(); */

$doc = new DOMDocument();
$doc->formatOutput = true;
$root_element = $doc->createElement("query");
$doc->appendChild($root_element);

$artistIDElement = $doc->createElement("id");
$artistIDElement->appendChild($doc->createTextNode(utf8_encode($mpartistinfo->id)));
$root_element->appendChild($artistIDElement);

$artistElement = $doc->createElement("artist");
$artistElement->appendChild($doc->createTextNode(utf8_encode($mpartistinfo->artist)));
$root_element->appendChild($artistElement);

$sourceElement = $doc->createElement("filename");
$sourceElement->appendChild($doc->createTextNode(utf8_encode($mpartistinfo->filename)));
$root_element->appendChild($sourceElement);
		
$bioElement = $doc->createElement("bio");
$bioElement->appendChild($doc->createTextNode(utf8_encode(urlencode($mpartistinfo->bio))));
$root_element->appendChild($bioElement);
	
$artIDElement = $doc->createElement("photo");
$artIDElement->appendChild($doc->createTextNode(utf8_encode($mpartistinfo->photo)));
$root_element->appendChild($artIDElement);
	
print $doc->saveXML();

?>