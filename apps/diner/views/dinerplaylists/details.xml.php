<?php if(isset($flash)): ?>
<div class="error">
<?php echo $flash; ?>
</div>
<?php endif;

$doc = new DOMDocument();
$doc->formatOutput = true;
$root_element = $doc->createElement("query");
$root_element->setAttribute("count",count($dinerplaylists->playlistTracks));
$doc->appendChild($root_element);

$dinerplaylistsIDElement = $doc->createElement("id");
$dinerplaylistsIDElement->appendChild($doc->createTextNode(utf8_encode($dinerplaylists->id)));
$root_element->appendChild($dinerplaylistsIDElement);

$dinerplaylistsElement = $doc->createElement("name");
$dinerplaylistsElement->appendChild($doc->createTextNode(utf8_encode($dinerplaylists->name)));
$root_element->appendChild($dinerplaylistsElement);

foreach ($dinerplaylists->playlistTracks as $track):

	$itemElement = $doc->createElement("item");
	$root_element->appendChild($itemElement);

	$ndxElement = $doc->createElement("index");
	$ndxElement->appendChild($doc->createTextNode(utf8_encode($track->ndx)));
	$itemElement->appendChild($ndxElement);

	$tid = 0;
	foreach ($dinerplaylists->playlistAssets as $asset):
		if ( ($asset->playlist_id == $dinerplaylists->id) && ($asset->ndx == $track->ndx) ) {
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

/*
	$assets = $allAssets->equal('RecID', $dinerplaylists->RecID);
	$assetID = 0;
*/
	
/*
	foreach($assets as $asset):
	
		if ($asset->db_id == "12") {
			$assetID = $asset->id;
		}
	
	endforeach;
	
*/

endforeach;
print $doc->saveXML();

?>