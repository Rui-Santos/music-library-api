<?php if(isset($flash)): ?>
<div class="error">
<?php echo $flash; ?>
</div>
<?php endif;

$doc = new DOMDocument();
$doc->formatOutput = true;
$root_element = $doc->createElement("query");
$root_element->setAttribute("term",$dineralbums->CDTitle);
$root_element->setAttribute("count",count($dineralbumsSet));

if(stripos($dineralbumsSet[0]->SubCategory, 'Album') === false) {
	$root_element->setAttribute("specialty",'false');
} else {
	$root_element->setAttribute("specialty",'true');
}

$doc->appendChild($root_element);

$length = count($dineralbumsSet);
$startpage = $dineralbums->pageNumber;
$limit = $dineralbums->pageLimit;

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

	$dineralbums = $dineralbumsSet[$i-1];

	$itemElement = $doc->createElement("item");
	$root_element->appendChild($itemElement);

	$recIDElement = $doc->createElement("RecID");
	$recIDElement->appendChild($doc->createTextNode(utf8_encode("di".$dineralbums->RecID)));
	$itemElement->appendChild($recIDElement);

	$trackNameElement = $doc->createElement("trackName");
	$trackNameElement->appendChild($doc->createTextNode(utf8_encode($dineralbums->TrackTitle)));
	$itemElement->appendChild($trackNameElement);

	$durationElement = $doc->createElement("duration");
	$durationElement->appendChild($doc->createTextNode(utf8_encode($dineralbums->Duration)));
	$itemElement->appendChild($durationElement);

	$CDTitleElement = $doc->createElement("CDTitle");
	$CDTitleElement->appendChild($doc->createTextNode(utf8_encode($dineralbums->CDTitle)));
	$itemElement->appendChild($CDTitleElement);

	$descriptionElement = $doc->createElement("description");
	$descriptionElement->appendChild($doc->createTextNode(utf8_encode($dineralbums->Description)));
	$itemElement->appendChild($descriptionElement);

	$mp3URIElement = $doc->createElement("mp3URI");
	$mp3URIElement->appendChild($doc->createTextNode(utf8_encode(str_replace("/Users/thestation/Music","http://208.65.156.27",$dineralbums->Pathname) . "/" . $dineralbums->Filename)));
	$itemElement->appendChild($mp3URIElement);

	$wavURIElement = $doc->createElement("wavURI");
	$wavURIElement->appendChild($doc->createTextNode(utf8_encode(str_replace("/Users/thestation/Music/THE_DINER/MP3s","http://208.65.156.27/THE_DINER/AIFFs",$dineralbums->Pathname) . "/" . str_replace(".mp3", ".aif", $dineralbums->Filename))));
	$itemElement->appendChild($wavURIElement);

	$httpElement = $doc->createElement("http");
	$httpElement->appendChild($doc->createTextNode(utf8_encode($dineralbums->cloudPrefixes()->{$dineralbums->Manufacturer}['http'] . $dineralbums->Filename)));
	$itemElement->appendChild($httpElement);

	$httpsElement = $doc->createElement("https");
	$httpsElement->appendChild($doc->createTextNode(utf8_encode($dineralbums->cloudPrefixes()->{$dineralbums->Manufacturer}['https'] . $dineralbums->Filename)));
	$itemElement->appendChild($httpsElement);

	$httpWavElement = $doc->createElement("httpWav");
	$httpWavElement->appendChild($doc->createTextNode(utf8_encode($dineralbums->cloudPrefixes()->{$dineralbums->Manufacturer}['http'] . str_replace(".mp3", ".aif", $dineralbums->Filename))));
	$itemElement->appendChild($httpWavElement);

	$httpsWavElement = $doc->createElement("httpsWav");
	$httpsWavElement->appendChild($doc->createTextNode(utf8_encode($dineralbums->cloudPrefixes()->{$dineralbums->Manufacturer}['https'] . str_replace(".mp3", ".aif", $dineralbums->Filename))));
	$itemElement->appendChild($httpsWavElement);

	$artworkURIElement = $doc->createElement("artworkURI");
	$artworkURIElement->appendChild($doc->createTextNode(utf8_encode("http://208.65.156.27/THE_DINER/ART_small/" . $dineralbums->CDTitle . ".jpg")));
	$itemElement->appendChild($artworkURIElement);

	$categoryElement = $doc->createElement("category");
	$categoryElement->appendChild($doc->createTextNode(utf8_encode($dineralbums->Category)));
	$itemElement->appendChild($categoryElement);

	$dineralbumArtElement = $doc->createElement("artID");
	$dineralbumArtElement->appendChild($doc->createTextNode(utf8_encode($dineralbums->_PictureLink)));
	$itemElement->appendChild($dineralbumArtElement);

	$waveformElement = $doc->createElement("waveformID");
	$waveformElement->appendChild($doc->createTextNode(utf8_encode($dineralbums->_WaveformLink)));
	$itemElement->appendChild($waveformElement);

	$shortIDElement = $doc->createElement("ShortID");
	$shortIDElement->appendChild($doc->createTextNode(utf8_encode($dineralbums->ShortID)));
	$itemElement->appendChild($shortIDElement);

	$longIDElement = $doc->createElement("LongID");
	$longIDElement->appendChild($doc->createTextNode(utf8_encode($dineralbums->LongID)));
	$itemElement->appendChild($longIDElement);

	if (count($dineralbums->assets()) > 0) {
		$assetkeyElement = $doc->createElement("asset_key");
		$assetkeyElement->appendChild($doc->createTextNode(utf8_encode($dineralbums->assets()->orderBy('id DESC')->first()->asset_key)));
		$itemElement->appendChild($assetkeyElement);
	}	
}

print $doc->saveXML();

?>