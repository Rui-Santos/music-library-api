<?php if(isset($flash)): ?>
<div class="error">
<?php echo $flash; ?>
</div>
<?php endif;

$doc = new DOMDocument();
$doc->formatOutput = true;
$root_element = $doc->createElement("query");
$root_element->setAttribute("term",$dinermetadata->searchTerm);
$root_element->setAttribute("count",count($dinermetadataSet));
$doc->appendChild($root_element);

$length = count($dinermetadataSet);
$startpage = $dinermetadata->pageNumber;
$limit = $dinermetadata->pageLimit;

$startNum = (($startpage-1)*$limit)+1;

if ($limit == 0) {
	$limit = $length;
} else {
	$limit = $startpage * $limit;
	if($limit > $length) {
		$limit = $length;
	}
}

for ($i=$startNum; $i <= $limit; $i++) {
//foreach($dinermetadataSet as $dinermetadata):

	$dinermetadata = $dinermetadataSet[$i-1];

	$itemElement = $doc->createElement("item");
	$root_element->appendChild($itemElement);

	$recIDElement = $doc->createElement("RecID");
	$recIDElement->appendChild($doc->createTextNode(utf8_encode("di".$dinermetadata->RecID)));
	$itemElement->appendChild($recIDElement);

	$trackNameElement = $doc->createElement("TrackTitle");
	$trackNameElement->appendChild($doc->createTextNode(utf8_encode($dinermetadata->TrackTitle)));
	$itemElement->appendChild($trackNameElement);

	$durationElement = $doc->createElement("Duration");
	$durationElement->appendChild($doc->createTextNode(utf8_encode($dinermetadata->Duration)));
	$itemElement->appendChild($durationElement);

	$CDTitleElement = $doc->createElement("CDTitle");
	$CDTitleElement->appendChild($doc->createTextNode(utf8_encode($dinermetadata->CDTitle)));
	$itemElement->appendChild($CDTitleElement);

	$descriptionElement = $doc->createElement("Description");
	$descriptionElement->appendChild($doc->createTextNode(utf8_encode($dinermetadata->Description)));
	$itemElement->appendChild($descriptionElement);

	$dineralbumArtElement = $doc->createElement("_PictureLink");
	$dineralbumArtElement->appendChild($doc->createTextNode(utf8_encode($dinermetadata->_PictureLink)));
	$itemElement->appendChild($dineralbumArtElement);

	$waveformElement = $doc->createElement("_WaveformLink");
	$waveformElement->appendChild($doc->createTextNode(utf8_encode($dinermetadata->_WaveformLink)));
	$itemElement->appendChild($waveformElement);
	
	$httpElement = $doc->createElement("http");
	$httpElement->appendChild($doc->createTextNode(utf8_encode($dinermetadata->cloudPrefixes()->{$dinermetadata->Manufacturer}['http'] . $dinermetadata->Filename)));
	$itemElement->appendChild($httpElement);

	$httpsElement = $doc->createElement("https");
	$httpsElement->appendChild($doc->createTextNode(utf8_encode($dinermetadata->cloudPrefixes()->{$dinermetadata->Manufacturer}['https'] . $dinermetadata->Filename)));
	$itemElement->appendChild($httpsElement);

	$httpWavElement = $doc->createElement("httpWav");
	$httpWavElement->appendChild($doc->createTextNode(utf8_encode($dinermetadata->cloudPrefixes()->{$dinermetadata->Manufacturer}['http'] . str_replace(".mp3", ".aif", $dinermetadata->Filename))));
	$itemElement->appendChild($httpWavElement);

	$httpsWavElement = $doc->createElement("httpsWav");
	$httpsWavElement->appendChild($doc->createTextNode(utf8_encode($dinermetadata->cloudPrefixes()->{$dinermetadata->Manufacturer}['https'] . str_replace(".mp3", ".aif", $dinermetadata->Filename))));
	$itemElement->appendChild($httpsWavElement);

	$shortIDElement = $doc->createElement("ShortID");
	$shortIDElement->appendChild($doc->createTextNode(utf8_encode($dinermetadata->ShortID)));
	$itemElement->appendChild($shortIDElement);

	$longIDElement = $doc->createElement("LongID");
	$longIDElement->appendChild($doc->createTextNode(utf8_encode($dinermetadata->LongID)));
	$itemElement->appendChild($longIDElement);

	$composerElement = $doc->createElement("Composer");
	$composerElement->appendChild($doc->createTextNode(utf8_encode($dinermetadata->Composer)));
	$itemElement->appendChild($composerElement);

	$publisherElement = $doc->createElement("Publisher");
	$publisherElement->appendChild($doc->createTextNode(utf8_encode($dinermetadata->Publisher)));
	$itemElement->appendChild($publisherElement);

	if (isset($dinermetadata->Relevance)) {
		$relevanceElement = $doc->createElement("Relevance");
		$relevanceElement->appendChild($doc->createTextNode(utf8_encode(floor($dinermetadata->Relevance))));
		$itemElement->appendChild($relevanceElement);
	}

	if (count($dinermetadata->assets()) > 0) {
		$assetkeyElement = $doc->createElement("asset_key");
		$assetkeyElement->appendChild($doc->createTextNode(utf8_encode($dinermetadata->assets()->orderBy('id DESC')->first()->asset_key)));
		$itemElement->appendChild($assetkeyElement);
	}	
}

//endforeach;
print $doc->saveXML();

?>