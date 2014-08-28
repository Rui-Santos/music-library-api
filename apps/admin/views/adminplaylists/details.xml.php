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

if($d == 'apitester') {
	$playlistsIDElement = $doc->createElement("id");
	$playlistsIDElement->appendChild($doc->createTextNode(utf8_encode($playlists->id)));
	$root_element->appendChild($playlistsIDElement);
	
	$folderIDElement = $doc->createElement("folderID");
	$folderIDElement->appendChild($doc->createTextNode(utf8_encode($playlists->folder_id)));
	$root_element->appendChild($folderIDElement);
}
	
$playlistsElement = $doc->createElement("name");
$playlistsElement->appendChild($doc->createTextNode(utf8_encode($playlists->name)));
$root_element->appendChild($playlistsElement);

$hashElement = $doc->createElement("hash");
$hashElement->appendChild($doc->createTextNode(utf8_encode($playlists->hash)));
$root_element->appendChild($hashElement);

foreach ($playlists->playlistTracks as $track):

	$itemElement = $doc->createElement("item");
	$root_element->appendChild($itemElement);

	$ndxElement = $doc->createElement("ndx");
	$ndxElement->appendChild($doc->createTextNode(utf8_encode($track->ndx)));
	$itemElement->appendChild($ndxElement);

	$recIDElement = $doc->createElement("RecID");
	$recIDElement->appendChild($doc->createTextNode(utf8_encode("di".$track->RecID)));
	$itemElement->appendChild($recIDElement);

	if($d == 'themusicplayground') {
		$artistNameElement = $doc->createElement("artist");
		$artistNameElement->appendChild($doc->createTextNode(utf8_encode($track->Library)));
		$itemElement->appendChild($artistNameElement);
	}

	$trackNameElement = $doc->createElement("TrackTitle");
	$trackNameElement->appendChild($doc->createTextNode(utf8_encode($track->TrackTitle)));
	$itemElement->appendChild($trackNameElement);

	$durationElement = $doc->createElement("Duration");
	$durationElement->appendChild($doc->createTextNode(utf8_encode($track->Duration)));
	$itemElement->appendChild($durationElement);

	$CDTitleElement = $doc->createElement("CDTitle");
	$CDTitleElement->appendChild($doc->createTextNode(utf8_encode($track->CDTitle)));
	$itemElement->appendChild($CDTitleElement);

	if($d == 'themusicplayground') {
		$descriptionElement = $doc->createElement("description");
	} else {
		$descriptionElement = $doc->createElement("Description");
	}
	$descriptionElement->appendChild($doc->createTextNode(utf8_encode($track->Description)));
	$itemElement->appendChild($descriptionElement);

	if($d == 'themusicplayground') {
		$dineralbumArtElement = $doc->createElement("artID");
	} else {
		$dineralbumArtElement = $doc->createElement("_PictureLink");
	}
	$dineralbumArtElement->appendChild($doc->createTextNode(utf8_encode($track->_PictureLink)));
	$itemElement->appendChild($dineralbumArtElement);

	if($d == 'themusicplayground') {
		$waveformElement = $doc->createElement("waveformID");
	} else {
		$waveformElement = $doc->createElement("_WaveformLink");
	}
	$waveformElement->appendChild($doc->createTextNode(utf8_encode($track->_WaveformLink)));
	$itemElement->appendChild($waveformElement);

	$assetElement = $doc->createElement("asset_id");
	$assetElement->appendChild($doc->createTextNode(utf8_encode($track->asset_id)));
	$itemElement->appendChild($assetElement);

	$dbElement = $doc->createElement("db_id");
	$dbElement->appendChild($doc->createTextNode(utf8_encode($track->db_id)));
	$itemElement->appendChild($dbElement);

	if ($track->db_id == 26) {
		$priceElement = $doc->createElement("price");
		$priceElement->appendChild($doc->createTextNode(utf8_encode($track->Notes)));
		$itemElement->appendChild($priceElement);

		$purchasedElement = $doc->createElement("purchased");
		if (in_array($track->asset_key, $purchased)) {
			$purchasedElement->appendChild($doc->createTextNode(utf8_encode('true')));
		} else {
			$purchasedElement->appendChild($doc->createTextNode(utf8_encode('false')));
		}
		$itemElement->appendChild($purchasedElement);
	}
	
	$assetKeyElement = $doc->createElement("asset_key");
	$assetKeyElement->appendChild($doc->createTextNode(utf8_encode($track->asset_key)));
	$itemElement->appendChild($assetKeyElement);

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

	$shortIDElement = $doc->createElement("ShortID");
	$shortIDElement->appendChild($doc->createTextNode(utf8_encode($track->ShortID)));
	$itemElement->appendChild($shortIDElement);

	$longIDElement = $doc->createElement("LongID");
	$longIDElement->appendChild($doc->createTextNode(utf8_encode($track->LongID)));
	$itemElement->appendChild($longIDElement);



endforeach;
print $doc->saveXML();

?>