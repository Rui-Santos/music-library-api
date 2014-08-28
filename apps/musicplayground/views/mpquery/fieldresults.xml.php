<?php if(isset($flash)): ?>
<div class="error">
<?php echo $flash; ?>
</div>
<?php endif;

$doc = new DOMDocument();
$doc->formatOutput = true;
$root_element = $doc->createElement("query");
$root_element->setAttribute("term",$mpquery->searchTerm);
$root_element->setAttribute("count",count($mpquerySet));
$doc->appendChild($root_element);


$length = count($mpquerySet);
$startpage = $mpquery->pageNumber;
$limit = $mpquery->pageLimit;

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

	$mpquery = $mpquerySet[$i-1];


	$itemElement = $doc->createElement("item");
	$root_element->appendChild($itemElement);

	$recIDElement = $doc->createElement("RecID");
	$recIDElement->appendChild($doc->createTextNode(utf8_encode("mp".$mpquery->RecID)));
	$itemElement->appendChild($recIDElement);

	$trackNameElement = $doc->createElement("trackName");
	$trackNameElement->appendChild($doc->createTextNode(utf8_encode($mpquery->TrackTitle)));
	$itemElement->appendChild($trackNameElement);

	$artistElement = $doc->createElement("artist");
	$artistElement->appendChild($doc->createTextNode(utf8_encode($mpquery->Library)));
	$itemElement->appendChild($artistElement);

	$durationElement = $doc->createElement("duration");
	$durationElement->appendChild($doc->createTextNode(utf8_encode($mpquery->Duration)));
	$itemElement->appendChild($durationElement);

	$CDTitleElement = $doc->createElement("CDTitle");
	$CDTitleElement->appendChild($doc->createTextNode(utf8_encode($mpquery->CDTitle)));
	$itemElement->appendChild($CDTitleElement);

	$descriptionElement = $doc->createElement("description");
	$descriptionElement->appendChild($doc->createTextNode(utf8_encode($mpquery->Description)));
	$itemElement->appendChild($descriptionElement);

	$mp3URIElement = $doc->createElement("mp3URI");
	$mp3URIElement->appendChild($doc->createTextNode(utf8_encode(str_replace("/Users/thestation/Music","http://208.65.156.27",$mpquery->Pathname) . "/" . $mpquery->Filename)));
	$itemElement->appendChild($mp3URIElement);

	$wavURIElement = $doc->createElement("wavURI");
	$wavURIElement->appendChild($doc->createTextNode(utf8_encode(str_replace("/Users/thestation/Music/THE_MUSIC_PLAYGROUND/mp3","http://208.65.156.27/THE_MUSIC_PLAYGROUND/wav",$mpquery->Pathname) . "/" . str_replace("mp3","wav",$mpquery->Filename))));
	$itemElement->appendChild($wavURIElement);

	$artworkURIElement = $doc->createElement("artworkURI");
	$artworkURIElement->appendChild($doc->createTextNode(utf8_encode("http://208.65.156.27/THE_MUSIC_PLAYGROUND/ART/" . $mpquery->Library . ".jpg")));
	$itemElement->appendChild($artworkURIElement);

	$mpalbumArtElement = $doc->createElement("artID");
	$mpalbumArtElement->appendChild($doc->createTextNode(utf8_encode($mpquery->_PictureLink)));
	$itemElement->appendChild($mpalbumArtElement);

	$waveformElement = $doc->createElement("waveformID");
	$waveformElement->appendChild($doc->createTextNode(utf8_encode($mpquery->_WaveformLink)));
	$itemElement->appendChild($waveformElement);

	$lyricsElement = $doc->createElement("lyrics");
	$lyricsElement->appendChild($doc->createCDATASection(utf8_encode($mpquery->Lyrics)));
	$itemElement->appendChild($lyricsElement);

	if (count($mpquery->assets()) > 0) {
		$assetkeyElement = $doc->createElement("asset_key");
		$assetkeyElement->appendChild($doc->createTextNode(utf8_encode($mpquery->assets()->first()->asset_key)));
		$itemElement->appendChild($assetkeyElement);
	}	
}
print $doc->saveXML();

?>