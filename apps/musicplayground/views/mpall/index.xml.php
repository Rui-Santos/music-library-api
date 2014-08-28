<?php if(isset($flash)): ?>
<div class="error">
<?php echo $flash; ?>
</div>
<?php endif;

$doc = new DOMDocument();
$doc->formatOutput = true;
$root_element = $doc->createElement("query");
$root_element->setAttribute("count",count($mpallSet));
$doc->appendChild($root_element);

foreach($mpallSet as $mpall):

	$itemElement = $doc->createElement("item");
	$root_element->appendChild($itemElement);

	$recIDElement = $doc->createElement("RecID");
	$recIDElement->appendChild($doc->createTextNode(utf8_encode("mp".$mpall->RecID)));
	$itemElement->appendChild($recIDElement);

	$trackNameElement = $doc->createElement("trackName");
	$trackNameElement->appendChild($doc->createTextNode(utf8_encode($mpall->TrackTitle)));
	$itemElement->appendChild($trackNameElement);

	$artistElement = $doc->createElement("artist");
	$artistElement->appendChild($doc->createTextNode(utf8_encode($mpall->Library)));
	$itemElement->appendChild($artistElement);

	$durationElement = $doc->createElement("duration");
	$durationElement->appendChild($doc->createTextNode(utf8_encode($mpall->Duration)));
	$itemElement->appendChild($durationElement);

	$CDTitleElement = $doc->createElement("CDTitle");
	$CDTitleElement->appendChild($doc->createTextNode(utf8_encode($mpall->CDTitle)));
	$itemElement->appendChild($CDTitleElement);

	$descriptionElement = $doc->createElement("description");
	$descriptionElement->appendChild($doc->createTextNode($mpall->Description));
	$itemElement->appendChild($descriptionElement);

	$mp3URIElement = $doc->createElement("mp3URI");
	$mp3URIElement->appendChild($doc->createTextNode(utf8_encode(str_replace("/Users/thestation/Music","http://208.65.156.27",$mpall->Pathname) . "/" . $mpall->Filename)));
	$itemElement->appendChild($mp3URIElement);

	$wavURIElement = $doc->createElement("wavURI");
	$wavURIElement->appendChild($doc->createTextNode(utf8_encode(str_replace("/Users/thestation/Music/THE_MUSIC_PLAYGROUND/mp3","http://208.65.156.27/THE_MUSIC_PLAYGROUND/wav",$mpall->Pathname) . "/" . str_replace("mp3","wav",$mpall->Filename))));
	$itemElement->appendChild($wavURIElement);

	$artworkURIElement = $doc->createElement("artworkURI");
	$artworkURIElement->appendChild($doc->createTextNode(utf8_encode("http://208.65.156.27/THE_MUSIC_PLAYGROUND/ART/" . $mpall->Library . ".jpg")));
	$itemElement->appendChild($artworkURIElement);

	$mpalbumArtElement = $doc->createElement("artID");
	$mpalbumArtElement->appendChild($doc->createTextNode(utf8_encode($mpall->_PictureLink)));
	$itemElement->appendChild($mpalbumArtElement);

	$waveformElement = $doc->createElement("waveformID");
	$waveformElement->appendChild($doc->createTextNode(utf8_encode($mpall->_WaveformLink)));
	$itemElement->appendChild($waveformElement);

	$lyricsElement = $doc->createElement("lyrics");
	$lyricsElement->appendChild($doc->createCDATASection(utf8_encode($mpall->Lyrics)));
	$itemElement->appendChild($lyricsElement);

endforeach;
print $doc->saveXML();

?>