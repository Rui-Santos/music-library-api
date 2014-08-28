<?php if(isset($flash)): ?>
<div class="error">
<?php echo $flash; ?>
</div>
<?php endif;

	$doc = new DOMDocument();
	$doc->formatOutput = true;
	$root_element = $doc->createElement("query");
	$root_element->setAttribute("count",count($dinerplaylistsSet));
	$doc->appendChild($root_element);
	
	foreach($dinerplaylistsSet as $dinerplaylists):
	
		$itemElement = $doc->createElement("item");
		$root_element->appendChild($itemElement);
	
		$dinerplaylistsElement = $doc->createElement("playlist");
		$dinerplaylistsElement->appendChild($doc->createTextNode(utf8_encode($dinerplaylists->name)));
		$itemElement->appendChild($dinerplaylistsElement);
		
		$dinerplaylistsIDElement = $doc->createElement("id");
		$dinerplaylistsIDElement->appendChild($doc->createTextNode(utf8_encode($dinerplaylists->id)));
		$itemElement->appendChild($dinerplaylistsIDElement);
		
		$tracks = $dinerplaylists->getTrackAssets();
		$trackAssets = $playlistassets->equal('playlist_id', $dinerplaylists->id);
		foreach($tracks as $key => $track):
		
			$dinerPlTrackElement = $doc->createElement("track");
			$itemElement->appendChild($dinerPlTrackElement);

			$ndxElement = $doc->createElement("index");
			$ndxElement->appendChild($doc->createTextNode(utf8_encode($track->ndx)));
			$dinerPlTrackElement->appendChild($ndxElement);
		
			$tid = 0;
			foreach ($trackAssets as $asset):
				if ( ($asset->playlist_id == $dinerplaylists->id) && ($asset->ndx == $track->ndx) ) {
					$tid = $asset->id;
					break;
				}
			endforeach;
	
			$tridElement = $doc->createElement("trID");
			$tridElement->appendChild($doc->createTextNode(utf8_encode($tid)));
			$dinerPlTrackElement->appendChild($tridElement);
			
			$dinerPlRecIDElement = $doc->createElement("RecID");
			$dinerPlRecIDElement->appendChild($doc->createTextNode(utf8_encode($track->RecID)));
			$dinerPlTrackElement->appendChild($dinerPlRecIDElement);
			
			$dinerPlTrackTitleElement = $doc->createElement("TrackTitle");
			$dinerPlTrackTitleElement->appendChild($doc->createTextNode(utf8_encode($track->TrackTitle)));
			$dinerPlTrackElement->appendChild($dinerPlTrackTitleElement);
			
			$dinerPlDurationElement = $doc->createElement("Duration");
			$dinerPlDurationElement->appendChild($doc->createTextNode(utf8_encode($track->Duration)));
			$dinerPlTrackElement->appendChild($dinerPlDurationElement);
			
			$dinerPlCDTitleElement = $doc->createElement("CDTitle");
			$dinerPlCDTitleElement->appendChild($doc->createTextNode(utf8_encode($track->CDTitle)));
			$dinerPlTrackElement->appendChild($dinerPlCDTitleElement);
			
			$dinerPlDescriptionElement = $doc->createElement("Description");
			$dinerPlDescriptionElement->appendChild($doc->createTextNode(utf8_encode($track->Description)));
			$dinerPlTrackElement->appendChild($dinerPlDescriptionElement);
			
			$mp3URIElement = $doc->createElement("mp3URI");
			$mp3URIElement->appendChild($doc->createTextNode(utf8_encode("http://208.65.156.27/THE_DINER/MP3s" . strrchr($track->Pathname, "/") . "/" . $track->Filename)));
			$itemElement->appendChild($mp3URIElement);
		
			$wavURIElement = $doc->createElement("wavURI");
			$wavURIElement->appendChild($doc->createTextNode(utf8_encode("http://208.65.156.27/THE_DINER/AIFFs" . strrchr($track->Pathname, "/") . "/" . str_replace(".mp3",".aif",$track->Filename))));
			$itemElement->appendChild($wavURIElement);
		
			$artworkURIElement = $doc->createElement("artworkURI");
			$artworkURIElement->appendChild($doc->createTextNode(utf8_encode("http://208.65.156.27/THE_DINER/ART_small/" . $track->CDTitle . ".jpg")));
			$dinerPlTrackElement->appendChild($artworkURIElement);
		
			$dineralbumArtElement = $doc->createElement("artID");
			$dineralbumArtElement->appendChild($doc->createTextNode(utf8_encode($track->_PictureLink)));
			$dinerPlTrackElement->appendChild($dineralbumArtElement);
		
			$waveformElement = $doc->createElement("waveformID");
			$waveformElement->appendChild($doc->createTextNode(utf8_encode($track->_WaveformLink)));
			$dinerPlTrackElement->appendChild($waveformElement);

			$assetElement = $doc->createElement("asset_id");
			$assetElement->appendChild($doc->createTextNode(utf8_encode($track->asset_id)));
			$itemElement->appendChild($assetElement);
		
		endforeach;
		
	endforeach;
	print $doc->saveXML();

?>