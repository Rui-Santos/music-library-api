<?php if(isset($flash)): ?>
<div class="error">
<?php echo $flash; ?>
</div>
<?php endif;

	$doc = new DOMDocument();
	$doc->formatOutput = true;
	$root_element = $doc->createElement("query");
	$root_element->setAttribute("count",count($playlistsSet));
	$doc->appendChild($root_element);
	
	foreach($playlistsSet as $playlists):
	
/* 		if ($playlists->type != "cart" && $playlists->type != "purchased") { */
	
			$itemElement = $doc->createElement("item");
			$root_element->appendChild($itemElement);
		
			$playlistsElement = $doc->createElement("playlist");
			$playlistsElement->appendChild($doc->createTextNode(utf8_encode($playlists->name)));
			$itemElement->appendChild($playlistsElement);
			
			$playlistsIDElement = $doc->createElement("id");
			$playlistsIDElement->appendChild($doc->createTextNode(utf8_encode($playlists->id)));
			$itemElement->appendChild($playlistsIDElement);
			
			if (is_null($playlists->hash)) {
				$playlists->hash = substr(sha1($playlists->id . ":" . $playlists->folder_id), 0, 8);
				$playlists->save();
			}
			
			$hashElement = $doc->createElement("hash");
			$hashElement->appendChild($doc->createTextNode(utf8_encode($playlists->hash)));
			$itemElement->appendChild($hashElement);
			
			$tracks = $playlists->getTrackAssets();
			$trackAssets = $playlistassets->equal('playlist_id', $playlists->id);
			foreach($tracks as $key => $track):
			
				$dinerPlTrackElement = $doc->createElement("track");
				$itemElement->appendChild($dinerPlTrackElement);
	
				$ndxElement = $doc->createElement("index");
				$ndxElement->appendChild($doc->createTextNode(utf8_encode($track->ndx)));
				$dinerPlTrackElement->appendChild($ndxElement);
			
				$tid = 0;
				foreach ($trackAssets as $asset):
					if ( ($asset->playlist_id == $playlists->id) && ($asset->ndx == $track->ndx) ) {
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
				$mp3URIElement->appendChild($doc->createTextNode(utf8_encode(str_replace("/Users/thestation/Music/", "http://208.65.156.27/", $track->Pathname) . "/" . $track->Filename)));
				$dinerPlTrackElement->appendChild($mp3URIElement);
			
				$wavURIElement = $doc->createElement("wavURI");
				$artworkURIElement = $doc->createElement("artworkURI");
			
				if ($track->db_id == 12) {
			
					$wavURIElement->appendChild($doc->createTextNode(utf8_encode("http://208.65.156.27/THE_DINER/AIFFs" . strrchr($track->Pathname, "/") . "/" . str_replace(".mp3",".aif",$track->Filename))));
					$artworkURIElement->appendChild($doc->createTextNode(utf8_encode("http://208.65.156.27/THE_DINER/ART_small/" . $track->CDTitle . ".jpg")));
			
				} else if ($track->db_id == 25) {
				
					$wavURIElement->appendChild($doc->createTextNode(utf8_encode("http://208.65.156.27/SFX/WAV" . "/" . str_replace(".mp3",".wav",$track->Filename))));
					$artworkURIElement->appendChild($doc->createTextNode(utf8_encode("http://208.65.156.27/api2/sfx/art/" . $track->_PictureLink . "/100")));
			
				}
			
				$dinerPlTrackElement->appendChild($wavURIElement);
				$dinerPlTrackElement->appendChild($artworkURIElement);
	
			
				if($track->db_id == 26) {
					$httpElement = $doc->createElement("http");
					$httpElement->appendChild($doc->createTextNode(utf8_encode($track->cloudPrefixes()->ProSFX['mp3_http'] . $track->Filename)));
					$dinerPlTrackElement->appendChild($httpElement);
					
					$httpsElement = $doc->createElement("https");
					$httpsElement->appendChild($doc->createTextNode(utf8_encode($track->cloudPrefixes()->ProSFX['mp3_https'] . $track->Filename)));
					$dinerPlTrackElement->appendChild($httpsElement);
					
					$httpWavElement = $doc->createElement("httpWav");
					$httpWavElement->appendChild($doc->createTextNode(utf8_encode($track->cloudPrefixes()->ProSFX['wav_http'] . str_replace(".mp3", ".wav", $track->Filename))));
					$dinerPlTrackElement->appendChild($httpWavElement);
					
					$httpsWavElement = $doc->createElement("httpsWav");
					$httpsWavElement->appendChild($doc->createTextNode(utf8_encode($track->cloudPrefixes()->ProSFX['wav_https'] . str_replace(".mp3", ".wav", $track->Filename))));
					$dinerPlTrackElement->appendChild($httpsWavElement);
				
				} else if ($track->Manufacturer) {
					$httpElement = $doc->createElement("http");
					$httpElement->appendChild($doc->createTextNode(utf8_encode($track->cloudPrefixes()->{$track->Manufacturer}['http'] . $track->Filename)));
					$dinerPlTrackElement->appendChild($httpElement);
					
					$httpsElement = $doc->createElement("https");
					$httpsElement->appendChild($doc->createTextNode(utf8_encode($track->cloudPrefixes()->{$track->Manufacturer}['https'] . $track->Filename)));
					$dinerPlTrackElement->appendChild($httpsElement);
					
					$httpWavElement = $doc->createElement("httpWav");
					$httpWavElement->appendChild($doc->createTextNode(utf8_encode($track->cloudPrefixes()->{$track->Manufacturer}['http'] . str_replace(".mp3", ".aif", $track->Filename))));
					$dinerPlTrackElement->appendChild($httpWavElement);
					
					$httpsWavElement = $doc->createElement("httpsWav");
					$httpsWavElement->appendChild($doc->createTextNode(utf8_encode($track->cloudPrefixes()->{$track->Manufacturer}['https'] . str_replace(".mp3", ".aif", $track->Filename))));
					$dinerPlTrackElement->appendChild($httpsWavElement);
					
				}

				$shortIDElement = $doc->createElement("ShortID");
				$shortIDElement->appendChild($doc->createTextNode(utf8_encode($track->ShortID)));
				$itemElement->appendChild($shortIDElement);
			
				$longIDElement = $doc->createElement("LongID");
				$longIDElement->appendChild($doc->createTextNode(utf8_encode($track->LongID)));
				$itemElement->appendChild($longIDElement);
			
				$dineralbumArtElement = $doc->createElement("artID");
				$dineralbumArtElement->appendChild($doc->createTextNode(utf8_encode($track->_PictureLink)));
				$dinerPlTrackElement->appendChild($dineralbumArtElement);
			
				$waveformElement = $doc->createElement("waveformID");
				$waveformElement->appendChild($doc->createTextNode(utf8_encode($track->_WaveformLink)));
				$dinerPlTrackElement->appendChild($waveformElement);
	
				$assetElement = $doc->createElement("asset_id");
				$assetElement->appendChild($doc->createTextNode(utf8_encode($track->asset_id)));
				$dinerPlTrackElement->appendChild($assetElement);
						
				$assetKeyElement = $doc->createElement("asset_key");
				$assetKeyElement->appendChild($doc->createTextNode(utf8_encode($track->asset_key)));
				$itemElement->appendChild($assetKeyElement);
			
			endforeach;
/* 		} */
		
	endforeach;
	print $doc->saveXML();

?>