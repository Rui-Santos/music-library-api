<?php if(isset($flash)): ?>
<div class="error">
<?php echo $flash; ?>
</div>
<?php endif;

$doc = new DOMDocument();
$doc->formatOutput = true;
$root_element = $doc->createElement("query");
$root_element->setAttribute("term",$mpartists->artist);
$root_element->setAttribute("count",count($mpartistsSet));
$root_element->setAttribute("slug",$mpartists->slug);
$root_element->setAttribute("bio",$mpartists->infoz);
$doc->appendChild($root_element);

foreach($mpartistsSet as $mpartists):

	$itemElement = $doc->createElement("item");
	$root_element->appendChild($itemElement);

	$recIDElement = $doc->createElement("RecID");
	$recIDElement->appendChild($doc->createTextNode(utf8_encode("mp".$mpartists->RecID)));
	$itemElement->appendChild($recIDElement);

	$trackNameElement = $doc->createElement("trackName");
	$trackNameElement->appendChild($doc->createTextNode(utf8_encode($mpartists->TrackTitle)));
	$itemElement->appendChild($trackNameElement);

	$artistElement = $doc->createElement("artist");
	$artistElement->appendChild($doc->createTextNode(utf8_encode($mpartists->Library)));
	$itemElement->appendChild($artistElement);

	$durationElement = $doc->createElement("duration");
	$durationElement->appendChild($doc->createTextNode(utf8_encode($mpartists->Duration)));
	$itemElement->appendChild($durationElement);

	$CDTitleElement = $doc->createElement("CDTitle");
	$CDTitleElement->appendChild($doc->createTextNode(utf8_encode($mpartists->CDTitle)));
	$itemElement->appendChild($CDTitleElement);

	$descriptionElement = $doc->createElement("description");
	$descriptionElement->appendChild($doc->createTextNode(utf8_encode($mpartists->Description)));
	$itemElement->appendChild($descriptionElement);

	$mp3URIElement = $doc->createElement("mp3URI");
	$mp3URIElement->appendChild($doc->createTextNode(utf8_encode(str_replace("/Users/thestation/Music","http://208.65.156.27",$mpartists->Pathname) . "/" . $mpartists->Filename)));
	$itemElement->appendChild($mp3URIElement);

	$wavURIElement = $doc->createElement("wavURI");
	$wavURIElement->appendChild($doc->createTextNode(utf8_encode(str_replace("/Users/thestation/Music/THE_MUSIC_PLAYGROUND/mp3","http://208.65.156.27/THE_MUSIC_PLAYGROUND/wav",$mpartists->Pathname) . "/" . str_replace("mp3","wav",$mpartists->Filename))));
	$itemElement->appendChild($wavURIElement);

	$artworkURIElement = $doc->createElement("artworkURI");
	$artworkURIElement->appendChild($doc->createTextNode(utf8_encode("http://208.65.156.27/THE_MUSIC_PLAYGROUND/ART/" . $mpartists->Library . ".jpg")));
	$itemElement->appendChild($artworkURIElement);

	$mpalbumArtElement = $doc->createElement("artID");
	$mpalbumArtElement->appendChild($doc->createTextNode(utf8_encode($mpartists->_PictureLink)));
	$itemElement->appendChild($mpalbumArtElement);

	$waveformElement = $doc->createElement("waveformID");
	$waveformElement->appendChild($doc->createTextNode(utf8_encode($mpartists->_WaveformLink)));
	$itemElement->appendChild($waveformElement);

	$lyricsElement = $doc->createElement("lyrics");
	$lyricsElement->appendChild($doc->createCDATASection(utf8_encode($mpartists->Lyrics)));
	$itemElement->appendChild($lyricsElement);

	if ($mpartists->all_assets()) {
		$assetkeyElement = $doc->createElement("asset_key");
		$assetkeyElement->appendChild($doc->createTextNode(utf8_encode($mpartists->all_assets()->asset_key)));
		$itemElement->appendChild($assetkeyElement);
	}	
				
endforeach;
print $doc->saveXML();

?>