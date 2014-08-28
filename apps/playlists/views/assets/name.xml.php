<?php if(isset($flash)): ?>
<div class="error">
<?php echo $flash; ?>
</div>
<?php endif;

$doc = new DOMDocument();
$doc->formatOutput = true;
$root_element = $doc->createElement("query");
$root_element->setAttribute("id",$asset->id);
$doc->appendChild($root_element);

$itemElement = $doc->createElement("item");
$root_element->appendChild($itemElement);

$recIDElement = $doc->createElement("RecID");
$recIDElement->appendChild($doc->createTextNode(utf8_encode($asset->RecID)));
$itemElement->appendChild($recIDElement);

$trackNameElement = $doc->createElement("trackName");
$trackNameElement->appendChild($doc->createTextNode(utf8_encode($asset->TrackTitle)));
$itemElement->appendChild($trackNameElement);

$durationElement = $doc->createElement("duration");
$durationElement->appendChild($doc->createTextNode(utf8_encode($asset->Duration)));
$itemElement->appendChild($durationElement);

$CDTitleElement = $doc->createElement("CDTitle");
$CDTitleElement->appendChild($doc->createTextNode(utf8_encode($asset->CDTitle)));
$itemElement->appendChild($CDTitleElement);

$descriptionElement = $doc->createElement("description");
$descriptionElement->appendChild($doc->createTextNode(utf8_encode($asset->Description)));
$itemElement->appendChild($descriptionElement);

$mp3URIElement = $doc->createElement("mp3URI");
$mp3URIElement->appendChild($doc->createTextNode(utf8_encode(str_replace("/Users/thestation/Music","http://208.65.156.27",$asset->Pathname) . "/" . $asset->Filename)));
$itemElement->appendChild($mp3URIElement);

$wavURIElement = $doc->createElement("wavURI");
$wavURIElement->appendChild($doc->createTextNode(utf8_encode(str_replace("/Users/thestation/Music/THE_DINER/MP3s","http://208.65.156.27/THE_DINER/AIFFs",$asset->Pathname) . "/" . $asset->TrackTitle . ".aif")));
$itemElement->appendChild($wavURIElement);

$httpElement = $doc->createElement("http");
$httpElement->appendChild($doc->createTextNode(utf8_encode($asset->cloudPrefixes()->{$asset->Manufacturer}['http'] . $asset->Filename)));
$itemElement->appendChild($httpElement);

$httpsElement = $doc->createElement("https");
$httpsElement->appendChild($doc->createTextNode(utf8_encode($asset->cloudPrefixes()->{$asset->Manufacturer}['https'] . $asset->Filename)));
$itemElement->appendChild($httpsElement);

$httpWavElement = $doc->createElement("httpWav");
$httpWavElement->appendChild($doc->createTextNode(utf8_encode($asset->cloudPrefixes()->{$asset->Manufacturer}['http'] . str_replace(".mp3", ".aif", $asset->Filename))));
$itemElement->appendChild($httpWavElement);

$httpsWavElement = $doc->createElement("httpsWav");
$httpsWavElement->appendChild($doc->createTextNode(utf8_encode($asset->cloudPrefixes()->{$asset->Manufacturer}['https'] . str_replace(".mp3", ".aif", $asset->Filename))));
$itemElement->appendChild($httpsWavElement);

$artworkURIElement = $doc->createElement("artworkURI");
$artworkURIElement->appendChild($doc->createTextNode(utf8_encode("http://208.65.156.27/THE_DINER/ART_small/" . $asset->CDTitle . ".jpg")));
$itemElement->appendChild($artworkURIElement);

$dineralbumArtElement = $doc->createElement("artID");
$dineralbumArtElement->appendChild($doc->createTextNode(utf8_encode($asset->_PictureLink)));
$itemElement->appendChild($dineralbumArtElement);

$waveformElement = $doc->createElement("waveformID");
$waveformElement->appendChild($doc->createTextNode(utf8_encode($asset->_WaveformLink)));
$itemElement->appendChild($waveformElement);

$assetElement = $doc->createElement("asset_id");
$assetElement->appendChild($doc->createTextNode(utf8_encode($asset->id)));
$itemElement->appendChild($assetElement);

$dbElement = $doc->createElement("db");
$dbElement->appendChild($doc->createTextNode(utf8_encode($asset->db_id)));
$itemElement->appendChild($dbElement);

$keyElement = $doc->createElement("asset_key");
$keyElement->appendChild($doc->createTextNode(utf8_encode($asset->asset_key)));
$itemElement->appendChild($keyElement);

$shortIDElement = $doc->createElement("ShortID");
$shortIDElement->appendChild($doc->createTextNode(utf8_encode($asset->ShortID)));
$itemElement->appendChild($shortIDElement);

$longIDElement = $doc->createElement("LongID");
$longIDElement->appendChild($doc->createTextNode(utf8_encode($asset->LongID)));
$itemElement->appendChild($longIDElement);

print $doc->saveXML();

?>