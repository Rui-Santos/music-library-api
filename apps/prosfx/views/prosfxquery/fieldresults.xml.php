<?php if(isset($flash)): ?>
<div class="error">
<?php echo $flash; ?>
</div>
<?php endif;

$doc = new DOMDocument();
$doc->formatOutput = true;
$root_element = $doc->createElement("query");
$root_element->setAttribute("count",count($prosfxquerySet));
$doc->appendChild($root_element);

$length = count($prosfxquerySet);
$startpage = $prosfxquery->pageNumber;
$limit = $prosfxquery->pageLimit;

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

	$prosfxquery = $prosfxquerySet[$i-1];

	$itemElement = $doc->createElement("item");
	$root_element->appendChild($itemElement);

	$recIDElement = $doc->createElement("RecID");
	$recIDElement->appendChild($doc->createTextNode(utf8_encode("px".$prosfxquery->RecID)));
	$itemElement->appendChild($recIDElement);

	$trackNameElement = $doc->createElement("trackName");
	$trackNameElement->appendChild($doc->createTextNode(utf8_encode($prosfxquery->TrackTitle)));
	$itemElement->appendChild($trackNameElement);

	$libraryNameElement = $doc->createElement("library");
	$libraryNameElement->appendChild($doc->createTextNode(utf8_encode($prosfxquery->Manufacturer)));
	$itemElement->appendChild($libraryNameElement);

	$durationElement = $doc->createElement("duration");
	$durationElement->appendChild($doc->createTextNode(utf8_encode($prosfxquery->Duration)));
	$itemElement->appendChild($durationElement);

	$CDTitleElement = $doc->createElement("CDTitle");
	$CDTitleElement->appendChild($doc->createTextNode(utf8_encode($prosfxquery->CDTitle)));
	$itemElement->appendChild($CDTitleElement);

	$descriptionElement = $doc->createElement("description");
	$descriptionElement->appendChild($doc->createTextNode(utf8_encode($prosfxquery->Description)));
	$itemElement->appendChild($descriptionElement);

	$mp3URIElement = $doc->createElement("mp3URI");
	$mp3URIElement->appendChild($doc->createTextNode(utf8_encode(str_replace("/Users/thestation/Music","http://208.65.156.27",$prosfxquery->Pathname) . "/" . $prosfxquery->Filename)));
	$itemElement->appendChild($mp3URIElement);

/*
	$wavURIElement = $doc->createElement("wavURI");
	$wavURIElement->appendChild($doc->createTextNode(utf8_encode("http://208.65.156.27/SFX/WAV" . "/" . str_replace(".mp3",".wav",$prosfxquery->Filename))));
	$itemElement->appendChild($wavURIElement);

*/
	$httpElement = $doc->createElement("http");
	$httpElement->appendChild($doc->createTextNode(utf8_encode($prosfxquery->cloudPrefixes()->ProSFX['mp3_http'] . $prosfxquery->Filename)));
	$itemElement->appendChild($httpElement);
	
	$httpsElement = $doc->createElement("https");
	$httpsElement->appendChild($doc->createTextNode(utf8_encode($prosfxquery->cloudPrefixes()->ProSFX['mp3_https'] . $prosfxquery->Filename)));
	$itemElement->appendChild($httpsElement);
	
	$httpWavElement = $doc->createElement("httpWav");
	$httpWavElement->appendChild($doc->createTextNode(utf8_encode($prosfxquery->cloudPrefixes()->ProSFX['wav_http'] . str_replace(".mp3", ".wav", $prosfxquery->Filename))));
	$itemElement->appendChild($httpWavElement);
	
	$httpsWavElement = $doc->createElement("httpsWav");
	$httpsWavElement->appendChild($doc->createTextNode(utf8_encode($prosfxquery->cloudPrefixes()->ProSFX['wav_https'] . str_replace(".mp3", ".wav", $prosfxquery->Filename))));
	$itemElement->appendChild($httpsWavElement);

	$artworkURIElement = $doc->createElement("artworkURI");
	$artworkURIElement->appendChild($doc->createTextNode(utf8_encode("http://208.65.156.27/api/prosfx/art/" . $prosfxquery->_PictureLink . "/100")));
	$itemElement->appendChild($artworkURIElement);

	$dineralbumArtElement = $doc->createElement("artID");
	$dineralbumArtElement->appendChild($doc->createTextNode(utf8_encode($prosfxquery->_PictureLink)));
	$itemElement->appendChild($dineralbumArtElement);

	$waveformElement = $doc->createElement("waveformID");
	$waveformElement->appendChild($doc->createTextNode(utf8_encode($prosfxquery->_WaveformLink)));
	$itemElement->appendChild($waveformElement);

	$priceElement = $doc->createElement("price");
	$priceElement->appendChild($doc->createTextNode(utf8_encode($prosfxquery->Notes)));
	$itemElement->appendChild($priceElement);

	$assetKey = '';

	if (count($prosfxquery->assets()) > 0) {
		$assetKey = $prosfxquery->assets()->orderBy('id DESC')->first()->asset_key;
		$assetkeyElement = $doc->createElement("asset_key");
		$assetkeyElement->appendChild($doc->createTextNode(utf8_encode($assetKey)));
		$itemElement->appendChild($assetkeyElement);
	}
	
	$purchasedElement = $doc->createElement("purchased");
	if (in_array($assetKey, $purchased)) {
		$purchasedElement->appendChild($doc->createTextNode(utf8_encode('true')));
	} else {
		$purchasedElement->appendChild($doc->createTextNode(utf8_encode('false')));
	}
	$itemElement->appendChild($purchasedElement);
}

print $doc->saveXML();

?>