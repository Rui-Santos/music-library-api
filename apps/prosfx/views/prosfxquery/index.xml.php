<?php if(isset($flash)): ?>
<div class="error">
<?php echo $flash; ?>
</div>
<?php endif;

$doc = new DOMDocument();
$doc->formatOutput = true;
$root_element = $doc->createElement("query");
$doc->appendChild($root_element);

foreach($prosfxquerySet as $prosfxquery):

	$itemElement = $doc->createElement("item");
	$root_element->appendChild($itemElement);

	$recIDElement = $doc->createElement("RecID");
	$recIDElement->appendChild($doc->createTextNode(utf8_encode("di".$prosfxquery->RecID)));
	$itemElement->appendChild($recIDElement);

	$trackNameElement = $doc->createElement("trackName");
	$trackNameElement->appendChild($doc->createTextNode(utf8_encode($prosfxquery->TrackTitle)));
	$itemElement->appendChild($trackNameElement);

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
	$artworkURIElement->appendChild($doc->createTextNode(utf8_encode("http://208.65.156.27/api/sfx/art/" . $prosfxquery->_PictureLink . "/100")));
	$itemElement->appendChild($artworkURIElement);

	$dineralbumArtElement = $doc->createElement("artID");
	$dineralbumArtElement->appendChild($doc->createTextNode(utf8_encode($prosfxquery->_PictureLink)));
	$itemElement->appendChild($dineralbumArtElement);

	$waveformElement = $doc->createElement("waveformID");
	$waveformElement->appendChild($doc->createTextNode(utf8_encode($prosfxquery->_WaveformLink)));
	$itemElement->appendChild($waveformElement);

	$assets = $allFXAssets->equal('RecID', $prosfxquery->RecID);
	$assetID = 0;
	
	foreach($assets as $asset):
	
		if ($asset->db_id == "25") {
			$assetID = $asset->id;
		}
	
	endforeach;
	
	if ($assetID == 0) {
		$assetID = addTrackToAssets($prosfxquery);	
	}

	$assetElement = $doc->createElement("asset_id");
	$assetElement->appendChild($doc->createTextNode(utf8_encode($assetID)));
	$itemElement->appendChild($assetElement);

endforeach;

function addTrackToAssets($trackData) {

	$newAsset = new assets();
	$newAsset->db_id = 25;
	$newAsset->track_id = $trackData->RecID;
	$newAsset->asset_key = MD5(RAND());

	$newAsset->Filename = $trackData->Filename;
	$newAsset->Pathname = $trackData->Pathname;
	$newAsset->FilePath = $trackData->FilePath;
	$newAsset->Duration = $trackData->Duration;
	$newAsset->FileType = $trackData->FileType;
	$newAsset->CreationDate = $trackData->CreationDate;
	$newAsset->ModificationDate = $trackData->ModificationDate;
	$newAsset->TrackTitle = $trackData->TrackTitle;
	$newAsset->Composer = $trackData->Composer;
	$newAsset->Publisher = $trackData->Publisher;
	$newAsset->RecID = $trackData->RecID;
	$newAsset->TotalFrames = $trackData->TotalFrames;
	$newAsset->EntryDate = $trackData->EntryDate;
	$newAsset->Popularity = $trackData->Popularity;
	$newAsset->Split = $trackData->Split;
	$newAsset->Rating = $trackData->Rating;
	$newAsset->SampleRate = $trackData->SampleRate;
	$newAsset->Channels = $trackData->Channels;
	$newAsset->BitDepth = $trackData->BitDepth;
	$newAsset->_WaveformLink = $trackData->_WaveformLink;
	$newAsset->_PictureLink = $trackData->_PictureLink;
	$newAsset->_UMID = $trackData->_UMID;
	$newAsset->Track = $trackData->Track;
	$newAsset->Lyrics = $trackData->Lyrics;
	$newAsset->Description = $trackData->Description;
	$newAsset->Source = $trackData->Source;
	$newAsset->Category = $trackData->Category;
	$newAsset->SubCategory = $trackData->SubCategory;
	$newAsset->Notes = $trackData->Notes;
	$newAsset->Library = $trackData->Library;
	$newAsset->Conductor = $trackData->Conductor;
	$newAsset->Performer = $trackData->Performer;
	$newAsset->BPM = $trackData->BPM;
	$newAsset->Key = $trackData->Key;
	$newAsset->CDTitle = $trackData->CDTitle;
	$newAsset->FeaturedInstrument = $trackData->FeaturedInstrument;
	$newAsset->Mood = $trackData->Mood;
	$newAsset->Version = $trackData->Version;
	$newAsset->BWDescription = $trackData->BWDescription;
	$newAsset->BWTimeStamp = $trackData->BWTimeStamp;
	$newAsset->BWTime = $trackData->BWTime;
	$newAsset->BWDate = $trackData->BWDate;
	
	$newAsset->save();
	
	return $newAsset->id;
}

print $doc->saveXML();

?>