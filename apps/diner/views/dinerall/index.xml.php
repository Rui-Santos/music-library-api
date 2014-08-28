<?php if(isset($flash)): ?>
<div class="error">
<?php echo $flash; ?>
</div>
<?php endif;

$doc = new DOMDocument();
$doc->formatOutput = true;
$root_element = $doc->createElement("query");
$root_element->setAttribute("count",count($dinerallSet));
$doc->appendChild($root_element);

foreach($dinerallSet as $dinerall):

	$itemElement = $doc->createElement("item");
	$root_element->appendChild($itemElement);

	$recIDElement = $doc->createElement("RecID");
	$recIDElement->appendChild($doc->createTextNode(utf8_encode("di".$dinerall->RecID)));
	$itemElement->appendChild($recIDElement);

	$trackNameElement = $doc->createElement("trackName");
	$trackNameElement->appendChild($doc->createTextNode(utf8_encode($dinerall->TrackTitle)));
	$itemElement->appendChild($trackNameElement);

	$durationElement = $doc->createElement("duration");
	$durationElement->appendChild($doc->createTextNode(utf8_encode($dinerall->Duration)));
	$itemElement->appendChild($durationElement);

	$CDTitleElement = $doc->createElement("CDTitle");
	$CDTitleElement->appendChild($doc->createTextNode(utf8_encode($dinerall->CDTitle)));
	$itemElement->appendChild($CDTitleElement);

	$descriptionElement = $doc->createElement("description");
	$descriptionElement->appendChild($doc->createTextNode(utf8_encode($dinerall->Description)));
	$itemElement->appendChild($descriptionElement);

	$mp3URIElement = $doc->createElement("mp3URI");
	$mp3URIElement->appendChild($doc->createTextNode(utf8_encode(str_replace("/Users/thestation/Music","http://208.65.156.27",$dinerall->Pathname) . "/" . $dinerall->Filename)));
	$itemElement->appendChild($mp3URIElement);

	$wavURIElement = $doc->createElement("wavURI");
	$wavURIElement->appendChild($doc->createTextNode(utf8_encode(str_replace("/Users/thestation/Music/THE_DINER/MP3s","http://208.65.156.27/THE_DINER/AIFFs",$dinerall->Pathname) . "/" . str_replace(".mp3", ".aif", $dinerall->Filename))));
	$itemElement->appendChild($wavURIElement);

	$httpElement = $doc->createElement("http");
	$httpElement->appendChild($doc->createTextNode(utf8_encode($dinerall->cloudPrefixes()->{$dinerall->Manufacturer}['http'] . $dinerall->Filename)));
	$itemElement->appendChild($httpElement);

	$httpsElement = $doc->createElement("https");
	$httpsElement->appendChild($doc->createTextNode(utf8_encode($dinerall->cloudPrefixes()->{$dinerall->Manufacturer}['https'] . $dinerall->Filename)));
	$itemElement->appendChild($httpsElement);

	$httpWavElement = $doc->createElement("httpWav");
	$httpWavElement->appendChild($doc->createTextNode(utf8_encode($dinerall->cloudPrefixes()->{$dinerall->Manufacturer}['http'] . str_replace(".mp3", ".aif", $dinerall->Filename))));
	$itemElement->appendChild($httpWavElement);

	$httpsWavElement = $doc->createElement("httpsWav");
	$httpsWavElement->appendChild($doc->createTextNode(utf8_encode($dinerall->cloudPrefixes()->{$dinerall->Manufacturer}['https'] . str_replace(".mp3", ".aif", $dinerall->Filename))));
	$itemElement->appendChild($httpsWavElement);

	$artworkURIElement = $doc->createElement("artworkURI");
	$artworkURIElement->appendChild($doc->createTextNode(utf8_encode("http://208.65.156.27/THE_DINER/ART_small/" . $dinerall->CDTitle . ".jpg")));
	$itemElement->appendChild($artworkURIElement);

	$dineralbumArtElement = $doc->createElement("artID");
	$dineralbumArtElement->appendChild($doc->createTextNode(utf8_encode($dinerall->_PictureLink)));
	$itemElement->appendChild($dineralbumArtElement);

	$waveformElement = $doc->createElement("waveformID");
	$waveformElement->appendChild($doc->createTextNode(utf8_encode($dinerall->_WaveformLink)));
	$itemElement->appendChild($waveformElement);

	$shortIDElement = $doc->createElement("ShortID");
	$shortIDElement->appendChild($doc->createTextNode(utf8_encode($dinerall->ShortID)));
	$itemElement->appendChild($shortIDElement);

	$longIDElement = $doc->createElement("LongID");
	$longIDElement->appendChild($doc->createTextNode(utf8_encode($dinerall->LongID)));
	$itemElement->appendChild($longIDElement);


endforeach;
print $doc->saveXML();

?>