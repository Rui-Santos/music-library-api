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

$createdElement = $doc->createElement("created");
$createdElement->appendChild($doc->createTextNode(utf8_encode($playlists->created)));
$root_element->appendChild($createdElement);

foreach ($playlists->playlistTracks as $track) {

    	$itemElement = $doc->createElement("item");
    	$root_element->appendChild($itemElement);
    	
		$ndxElement = $doc->createElement("ndx");
		$ndxElement->appendChild($doc->createTextNode(utf8_encode($track->ndx)));
		$itemElement->appendChild($ndxElement);
	
    	$recIDElement = $doc->createElement("RecID");
    	$recIDElement->appendChild($doc->createTextNode(utf8_encode("mp".$track->RecID)));
    	$itemElement->appendChild($recIDElement);
    
    	$trackNameElement = $doc->createElement("trackName");
    	$trackNameElement->appendChild($doc->createTextNode(utf8_encode($track->TrackTitle)));
    	$itemElement->appendChild($trackNameElement);
    
    	$artistElement = $doc->createElement("artist");
    	$artistElement->appendChild($doc->createTextNode(utf8_encode($track->Library)));
    	$itemElement->appendChild($artistElement);
    
		$sourceElement = $doc->createElement("source");
		$sourceElement->appendChild($doc->createTextNode(utf8_encode($track->Source)));
		$itemElement->appendChild($sourceElement);

    	$durationElement = $doc->createElement("duration");
    	$durationElement->appendChild($doc->createTextNode(utf8_encode($track->Duration)));
    	$itemElement->appendChild($durationElement);
    
    	$CDTitleElement = $doc->createElement("CDTitle");
    	$CDTitleElement->appendChild($doc->createTextNode(utf8_encode($track->CDTitle)));
    	$itemElement->appendChild($CDTitleElement);
    
       	$CDDescriptionElement = $doc->createElement("CDDescription");
    	$CDDescriptionElement->appendChild($doc->createTextNode(utf8_encode($track->CDDescription)));
    	$itemElement->appendChild($CDDescriptionElement);
    
    	$CategoryElement = $doc->createElement("Category");
    	$CategoryElement->appendChild($doc->createTextNode(utf8_encode($track->Category)));
    	$itemElement->appendChild($CategoryElement);
    
    	$descriptionElement = $doc->createElement("description");
    	$descriptionElement->appendChild($doc->createTextNode(utf8_encode($track->Description)));
    	$itemElement->appendChild($descriptionElement);
    
    	$httpMP3Element = $doc->createElement("http");
    	$httpMP3Element->appendChild($doc->createTextNode(utf8_encode('http://46df4df5f004e00d1369-03bc13b1e76a5a9c9ac4fb771e9b7a23.r27.cf1.rackcdn.com/'.$track->Filename)));
    	$itemElement->appendChild($httpMP3Element);
    
    	$httpsMP3Element = $doc->createElement("https");
    	$httpsMP3Element->appendChild($doc->createTextNode(utf8_encode('https://288763349e1d9895c284-03bc13b1e76a5a9c9ac4fb771e9b7a23.ssl.cf1.rackcdn.com/'.$track->Filename)));
    	$itemElement->appendChild($httpsMP3Element);
    
    	$streamingMP3Element = $doc->createElement("streaming");
    	$streamingMP3Element->appendChild($doc->createTextNode(utf8_encode('http://3fe53bbd7b947c5383b3-03bc13b1e76a5a9c9ac4fb771e9b7a23.r27.stream.cf1.rackcdn.com/'.$track->Filename)));
    	$itemElement->appendChild($streamingMP3Element);
    
    	$iosMP3Element = $doc->createElement("ios");
    	$iosMP3Element->appendChild($doc->createTextNode(utf8_encode('http://eb24d662ea3d83e9147e-03bc13b1e76a5a9c9ac4fb771e9b7a23.iosr.cf1.rackcdn.com/'.$track->Filename)));
    	$itemElement->appendChild($iosMP3Element);
    
    	$mpalbumArtElement = $doc->createElement("artID");
    	$mpalbumArtElement->appendChild($doc->createTextNode(utf8_encode($track->_PictureLink)));
    	$itemElement->appendChild($mpalbumArtElement);
    
    	$waveformElement = $doc->createElement("waveformID");
    	$waveformElement->appendChild($doc->createTextNode(utf8_encode($track->_WaveformLink)));
    	$itemElement->appendChild($waveformElement);
    
    	$lyricsElement = $doc->createElement("lyrics");
    	$lyricsElement->appendChild($doc->createTextNode(urlencode(utf8_encode($track->Lyrics))));
    	$itemElement->appendChild($lyricsElement);
    
    	$ratingElement = $doc->createElement("Rating");
    	$ratingElement->appendChild($doc->createTextNode(utf8_encode($track->Rating)));
    	$itemElement->appendChild($ratingElement);
    
    	if(isset($track->Relevance)) {
    		$relevanceElement = $doc->createElement("relevance");
    		$relevanceElement->appendChild($doc->createTextNode(utf8_encode(floor($track->Relevance))));
    		$itemElement->appendChild($relevanceElement);
    	}

		$shortIDElement = $doc->createElement("ShortID");
		$shortIDElement->appendChild($doc->createTextNode(utf8_encode($track->ShortID)));
		$itemElement->appendChild($shortIDElement);

		$longIDElement = $doc->createElement("LongID");
		$longIDElement->appendChild($doc->createTextNode(utf8_encode($track->LongID)));
		$itemElement->appendChild($longIDElement);

		$filehashElement = $doc->createElement("file_hash");
		$filehashElement->appendChild($doc->createTextNode(utf8_encode($track->file_hash)));
		$itemElement->appendChild($filehashElement);

		$assetkeyElement = $doc->createElement("asset_key");
		$assetkeyElement->appendChild($doc->createTextNode(utf8_encode($track->asset_key)));
		$itemElement->appendChild($assetkeyElement);


}
print $doc->saveXML();

?>