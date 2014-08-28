<?php if(isset($flash)): ?>
<div class="error">
<?php echo $flash; ?>
</div>
<?php endif;

$doc = new DOMDocument();
$doc->formatOutput = true;
$root_element = $doc->createElement("query");
$root_element->setAttribute("term",$mpmetadata->artist);
$root_element->setAttribute("count",count($mpmetadataSet));
$root_element->setAttribute("slug",$mpmetadata->slug);
$root_element->setAttribute("bio",$mpmetadata->infoz);
$root_element->setAttribute("photo",$mpmetadata->photo);
$doc->appendChild($root_element);

foreach($mpmetadataSet as $mpmetadata):

	$a = $mpmetadata->all_assets();
	if ($a && $a->status=="active") {
    	$itemElement = $doc->createElement("item");
    	$root_element->appendChild($itemElement);
    
    	$recIDElement = $doc->createElement("RecID");
    	$recIDElement->appendChild($doc->createTextNode(utf8_encode("mp".$mpmetadata->RecID)));
    	$itemElement->appendChild($recIDElement);
    
    	$trackNameElement = $doc->createElement("trackName");
    	$trackNameElement->appendChild($doc->createTextNode(utf8_encode($mpmetadata->TrackTitle)));
    	$itemElement->appendChild($trackNameElement);
    
    	$artistElement = $doc->createElement("artist");
    	$artistElement->appendChild($doc->createTextNode(utf8_encode($mpmetadata->Library)));
    	$itemElement->appendChild($artistElement);
    
		$sourceElement = $doc->createElement("source");
		$sourceElement->appendChild($doc->createTextNode(utf8_encode($mpmetadata->Source)));
		$itemElement->appendChild($sourceElement);

    	$durationElement = $doc->createElement("duration");
    	$durationElement->appendChild($doc->createTextNode(utf8_encode($mpmetadata->Duration)));
    	$itemElement->appendChild($durationElement);
    
    	$CDTitleElement = $doc->createElement("CDTitle");
    	$CDTitleElement->appendChild($doc->createTextNode(utf8_encode($mpmetadata->CDTitle)));
    	$itemElement->appendChild($CDTitleElement);
    
    	$CDDescriptionElement = $doc->createElement("CDDescription");
    	$CDDescriptionElement->appendChild($doc->createTextNode(utf8_encode($mpmetadata->CDDescription)));
    	$itemElement->appendChild($CDDescriptionElement);
    
    	$descriptionElement = $doc->createElement("description");
    	$descriptionElement->appendChild($doc->createTextNode(utf8_encode($mpmetadata->Description)));
    	$itemElement->appendChild($descriptionElement);
    
    	$httpMP3Element = $doc->createElement("http");
    	$httpMP3Element->appendChild($doc->createTextNode(utf8_encode('http://46df4df5f004e00d1369-03bc13b1e76a5a9c9ac4fb771e9b7a23.r27.cf1.rackcdn.com/'.$mpmetadata->Filename)));
    	$itemElement->appendChild($httpMP3Element);
    
    	$httpsMP3Element = $doc->createElement("https");
    	$httpsMP3Element->appendChild($doc->createTextNode(utf8_encode('https://288763349e1d9895c284-03bc13b1e76a5a9c9ac4fb771e9b7a23.ssl.cf1.rackcdn.com/'.$mpmetadata->Filename)));
    	$itemElement->appendChild($httpsMP3Element);
    
    	$streamingMP3Element = $doc->createElement("streaming");
    	$streamingMP3Element->appendChild($doc->createTextNode(utf8_encode('http://3fe53bbd7b947c5383b3-03bc13b1e76a5a9c9ac4fb771e9b7a23.r27.stream.cf1.rackcdn.com/'.$mpmetadata->Filename)));
    	$itemElement->appendChild($streamingMP3Element);
    
    	$iosMP3Element = $doc->createElement("ios");
    	$iosMP3Element->appendChild($doc->createTextNode(utf8_encode('http://eb24d662ea3d83e9147e-03bc13b1e76a5a9c9ac4fb771e9b7a23.iosr.cf1.rackcdn.com/'.$mpmetadata->Filename)));
    	$itemElement->appendChild($iosMP3Element);
    
    	$mpalbumArtElement = $doc->createElement("artID");
    	$mpalbumArtElement->appendChild($doc->createTextNode(utf8_encode($mpmetadata->_PictureLink)));
    	$itemElement->appendChild($mpalbumArtElement);
    
    	$waveformElement = $doc->createElement("waveformID");
    	$waveformElement->appendChild($doc->createTextNode(utf8_encode($mpmetadata->_WaveformLink)));
    	$itemElement->appendChild($waveformElement);
    
    	$lyricsElement = $doc->createElement("lyrics");
    	$lyricsElement->appendChild($doc->createTextNode(urlencode(utf8_encode($mpmetadata->Lyrics))));
    	$itemElement->appendChild($lyricsElement);
    
		$filehashElement = $doc->createElement("file_hash");
		$filehashElement->appendChild($doc->createTextNode(utf8_encode($a->file_hash)));
		$itemElement->appendChild($filehashElement);

    	$assetkeyElement = $doc->createElement("asset_key");
    	$assetkeyElement->appendChild($doc->createTextNode(utf8_encode($a->asset_key)));
    	$itemElement->appendChild($assetkeyElement);

    	$ratingElement = $doc->createElement("Rating");
    	$ratingElement->appendChild($doc->createTextNode(utf8_encode($mpmetadata->Rating)));
    	$itemElement->appendChild($ratingElement);
    
		$shortIDElement = $doc->createElement("ShortID");
		$shortIDElement->appendChild($doc->createTextNode(utf8_encode($mpmetadata->ShortID)));
		$itemElement->appendChild($shortIDElement);

		$longIDElement = $doc->createElement("LongID");
		$longIDElement->appendChild($doc->createTextNode(utf8_encode($mpmetadata->LongID)));
		$itemElement->appendChild($longIDElement);

		$assetidElement = $doc->createElement("asset_id");
		$assetidElement->appendChild($doc->createTextNode(utf8_encode($a->asset_id)));
		$itemElement->appendChild($assetidElement);

		$alternatesElement = $doc->createElement("alternates");
		$alternatesElement->appendChild($doc->createTextNode(utf8_encode($a->alt_data)));
		$itemElement->appendChild($alternatesElement);
    }	
				
endforeach;
print $doc->saveXML();

?>