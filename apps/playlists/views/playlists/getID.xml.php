<?php if(isset($flash)): ?>
<div class="error">
<?php echo $flash; ?>
</div>
<?php endif;

$doc = new DOMDocument();
$doc->formatOutput = true;
$root_element = $doc->createElement("query");
$root_element->setAttribute("count",count($playlists->playlistTracks));
$doc->appendChild($root_element);

$playlistsIDElement = $doc->createElement("id");
$playlistsIDElement->appendChild($doc->createTextNode(utf8_encode($playlists->id)));
$root_element->appendChild($playlistsIDElement);

$playlistsElement = $doc->createElement("name");
$playlistsElement->appendChild($doc->createTextNode(utf8_encode($playlists->name)));
$root_element->appendChild($playlistsElement);

$hashElement = $doc->createElement("hash");
$hashElement->appendChild($doc->createTextNode(utf8_encode($playlists->hash)));
$root_element->appendChild($hashElement);

foreach ($playlists->playlistTracks as $track):

	$itemElement = $doc->createElement("item");
	$root_element->appendChild($itemElement);

	$ndxElement = $doc->createElement("index");
	$ndxElement->appendChild($doc->createTextNode(utf8_encode($track->ndx)));
	$itemElement->appendChild($ndxElement);

	$tid = 0;
	foreach ($playlists->playlistAssets as $asset):
		if ( ($asset->playlist_id == $playlists->id) && ($asset->ndx == $track->ndx) ) {
			$tid = $asset->id;
			break;
		}
	endforeach;
	
	$tridElement = $doc->createElement("trID");
	$tridElement->appendChild($doc->createTextNode(utf8_encode($tid)));
	$itemElement->appendChild($tridElement);
		
	$recIDElement = $doc->createElement("RecID");
	$recIDElement->appendChild($doc->createTextNode(utf8_encode("di".$track->RecID)));
	$itemElement->appendChild($recIDElement);

	$trackNameElement = $doc->createElement("trackName");
	$trackNameElement->appendChild($doc->createTextNode(utf8_encode($track->TrackTitle)));
	$itemElement->appendChild($trackNameElement);

	$durationElement = $doc->createElement("duration");
	$durationElement->appendChild($doc->createTextNode(utf8_encode($track->Duration)));
	$itemElement->appendChild($durationElement);

	$CDTitleElement = $doc->createElement("CDTitle");
	$CDTitleElement->appendChild($doc->createTextNode(utf8_encode($track->CDTitle)));
	$itemElement->appendChild($CDTitleElement);

	$descriptionElement = $doc->createElement("description");
	$descriptionElement->appendChild($doc->createTextNode(utf8_encode($track->Description)));
	$itemElement->appendChild($descriptionElement);

	$mp3URIElement = $doc->createElement("mp3URI");
	$mp3URIElement->appendChild($doc->createTextNode(utf8_encode("http://208.65.156.27/THE_DINER/MP3s" . strrchr($track->Pathname, "/") . "/" . $track->Filename)));
	$itemElement->appendChild($mp3URIElement);

	$wavURIElement = $doc->createElement("wavURI");
	$wavURIElement->appendChild($doc->createTextNode(utf8_encode("http://208.65.156.27/THE_DINER/AIFFs" . strrchr($track->Pathname, "/") . "/" . str_replace(".mp3",".aif",$track->Filename))));
	$itemElement->appendChild($wavURIElement);

	$shortIDElement = $doc->createElement("ShortID");
	$shortIDElement->appendChild($doc->createTextNode(utf8_encode($track->ShortID)));
	$itemElement->appendChild($shortIDElement);

	$longIDElement = $doc->createElement("LongID");
	$longIDElement->appendChild($doc->createTextNode(utf8_encode($track->LongID)));
	$itemElement->appendChild($longIDElement);

				if($track->db_id == 26) {
					$httpElement = $doc->createElement("http");
					$httpElement->appendChild($doc->createTextNode(utf8_encode($track->cloudPrefixes()->ProSFX['mp3_http'] . $track->Filename)));
					$itemElement->appendChild($httpElement);
					
					$httpsElement = $doc->createElement("https");
					$httpsElement->appendChild($doc->createTextNode(utf8_encode($track->cloudPrefixes()->ProSFX['mp3_https'] . $track->Filename)));
					$itemElement->appendChild($httpsElement);
					
					$httpWavElement = $doc->createElement("httpWav");
					$httpWavElement->appendChild($doc->createTextNode(utf8_encode($track->cloudPrefixes()->ProSFX['wav_http'] . str_replace(".mp3", ".wav", $track->Filename))));
					$itemElement->appendChild($httpWavElement);
					
					$httpsWavElement = $doc->createElement("httpsWav");
					$httpsWavElement->appendChild($doc->createTextNode(utf8_encode($track->cloudPrefixes()->ProSFX['wav_https'] . str_replace(".mp3", ".wav", $track->Filename))));
					$itemElement->appendChild($httpsWavElement);
				
				} else if ($track->Manufacturer) {
					$httpElement = $doc->createElement("http");
					$httpElement->appendChild($doc->createTextNode(utf8_encode($track->cloudPrefixes()->{$track->Manufacturer}['http'] . $track->Filename)));
					$itemElement->appendChild($httpElement);
					
					$httpsElement = $doc->createElement("https");
					$httpsElement->appendChild($doc->createTextNode(utf8_encode($track->cloudPrefixes()->{$track->Manufacturer}['https'] . $track->Filename)));
					$itemElement->appendChild($httpsElement);
					
					$httpWavElement = $doc->createElement("httpWav");
					$httpWavElement->appendChild($doc->createTextNode(utf8_encode($track->cloudPrefixes()->{$track->Manufacturer}['http'] . str_replace(".mp3", ".aif", $track->Filename))));
					$itemElement->appendChild($httpWavElement);
					
					$httpsWavElement = $doc->createElement("httpsWav");
					$httpsWavElement->appendChild($doc->createTextNode(utf8_encode($track->cloudPrefixes()->{$track->Manufacturer}['https'] . str_replace(".mp3", ".aif", $track->Filename))));
					$itemElement->appendChild($httpsWavElement);
					
				}
	$artworkURIElement = $doc->createElement("artworkURI");
	$artworkURIElement->appendChild($doc->createTextNode(utf8_encode("http://208.65.156.27/THE_DINER/ART_small/" . $track->CDTitle . ".jpg")));
	$itemElement->appendChild($artworkURIElement);

	$dineralbumArtElement = $doc->createElement("artID");
	$dineralbumArtElement->appendChild($doc->createTextNode(utf8_encode($track->_PictureLink)));
	$itemElement->appendChild($dineralbumArtElement);

	$waveformElement = $doc->createElement("waveformID");
	$waveformElement->appendChild($doc->createTextNode(utf8_encode($track->_WaveformLink)));
	$itemElement->appendChild($waveformElement);

	$assetElement = $doc->createElement("asset_id");
	$assetElement->appendChild($doc->createTextNode(utf8_encode($track->asset_id)));
	$itemElement->appendChild($assetElement);

	$dbElement = $doc->createElement("db");
	$dbElement->appendChild($doc->createTextNode(utf8_encode($track->db_id)));
	$itemElement->appendChild($dbElement);

endforeach;
print $doc->saveXML();

?>