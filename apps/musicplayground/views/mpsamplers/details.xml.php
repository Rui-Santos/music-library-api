<?php if(isset($flash)): ?>
<div class="error">
<?php echo $flash; ?>
</div>
<?php endif;

$doc = new DOMDocument();
$doc->formatOutput = true;
$root_element = $doc->createElement("query");
$root_element->setAttribute("name",$mpsamplers->name);
if(isset($mpsamplers->duplicate)) {
	$root_element->setAttribute("duplicate",$mpsamplers->duplicate);
}
$doc->appendChild($root_element);

$mpsamplersIDElement = $doc->createElement("id");
$mpsamplersIDElement->appendChild($doc->createTextNode(utf8_encode($mpsamplers->id)));
$root_element->appendChild($mpsamplersIDElement);

$mpsamplersNameElement = $doc->createElement("name");
$mpsamplersNameElement->appendChild($doc->createTextNode(utf8_encode($mpsamplers->name)));
$root_element->appendChild($mpsamplersNameElement);

$mpsamplersSlugElement = $doc->createElement("slug");
$mpsamplersSlugElement->appendChild($doc->createTextNode(utf8_encode($mpsamplers->slug)));
$root_element->appendChild($mpsamplersSlugElement);

$mpsamplersCreatedElement = $doc->createElement("date_created");
$mpsamplersCreatedElement->appendChild($doc->createTextNode(utf8_encode($mpsamplers->date_created)));
$root_element->appendChild($mpsamplersCreatedElement);

$mpsamplersModifiedElement = $doc->createElement("date_modified");
$mpsamplersModifiedElement->appendChild($doc->createTextNode(utf8_encode($mpsamplers->date_modified)));
$root_element->appendChild($mpsamplersModifiedElement);

$mpsamplersMainMarkdownElement = $doc->createElement("main_markdown");
$mpsamplersMainMarkdownElement->appendChild($doc->createTextNode(utf8_encode($mpsamplers->main_markdown)));
$root_element->appendChild($mpsamplersMainMarkdownElement);

$mpsamplersIntroMarkdownElement = $doc->createElement("intro_markdown");
$mpsamplersIntroMarkdownElement->appendChild($doc->createTextNode(utf8_encode($mpsamplers->intro_markdown)));
$root_element->appendChild($mpsamplersIntroMarkdownElement);

$mpsamplersTypeElement = $doc->createElement("type");
$mpsamplersTypeElement->appendChild($doc->createTextNode(utf8_encode($mpsamplers->type)));
$root_element->appendChild($mpsamplersTypeElement);

$mpsamplersStateElement = $doc->createElement("state");
$mpsamplersStateElement->appendChild($doc->createTextNode(utf8_encode($mpsamplers->state)));
$root_element->appendChild($mpsamplersStateElement);

$mpsamplersDescriptionElement = $doc->createElement("description");
$mpsamplersDescriptionElement->appendChild($doc->createTextNode(utf8_encode($mpsamplers->description)));
$root_element->appendChild($mpsamplersDescriptionElement);
		
$mpsamplersNotesElement = $doc->createElement("notes");
$mpsamplersNotesElement->appendChild($doc->createTextNode(utf8_encode($mpsamplers->notes)));
$root_element->appendChild($mpsamplersNotesElement);
		
$mpsamplersArtworkElement = $doc->createElement("artwork");
$mpsamplersArtworkElement->appendChild($doc->createTextNode(utf8_encode($mpsamplers->artwork)));
$root_element->appendChild($mpsamplersArtworkElement);
		

foreach ($mpsamplers->samplerAssets as $asset):

	$itemElement = $doc->createElement("item");

	if($asset->getMetaData()) {
		$m = $asset->getMetaData();

		$recIDElement = $doc->createElement("RecID");
		$recIDElement->appendChild($doc->createTextNode(utf8_encode("mp".$m->RecID)));
		$itemElement->appendChild($recIDElement);

		$trackNameElement = $doc->createElement("trackName");
		$trackNameElement->appendChild($doc->createTextNode(utf8_encode($m->TrackTitle)));
		$itemElement->appendChild($trackNameElement);
	
		$artistElement = $doc->createElement("artist");
		$artistElement->appendChild($doc->createTextNode(utf8_encode($m->Library)));
		$itemElement->appendChild($artistElement);
	
		$sourceElement = $doc->createElement("source");
		$sourceElement->appendChild($doc->createTextNode(utf8_encode($m->Source)));
		$itemElement->appendChild($sourceElement);

		$durationElement = $doc->createElement("duration");
		$durationElement->appendChild($doc->createTextNode(utf8_encode($m->Duration)));
		$itemElement->appendChild($durationElement);
	
		$CDTitleElement = $doc->createElement("CDTitle");
		$CDTitleElement->appendChild($doc->createTextNode(utf8_encode($m->CDTitle)));
		$itemElement->appendChild($CDTitleElement);
	
		$CDDescriptionElement = $doc->createElement("CDDescription");
		$CDDescriptionElement->appendChild($doc->createTextNode(utf8_encode($m->CDDescription)));
		$itemElement->appendChild($CDDescriptionElement);
	
		$descriptionElement = $doc->createElement("description");
		$descriptionElement->appendChild($doc->createTextNode($m->Description));
		$itemElement->appendChild($descriptionElement);
	
    	$httpMP3Element = $doc->createElement("http");
    	$httpMP3Element->appendChild($doc->createTextNode(utf8_encode('http://46df4df5f004e00d1369-03bc13b1e76a5a9c9ac4fb771e9b7a23.r27.cf1.rackcdn.com/'.$m->Filename)));
    	$itemElement->appendChild($httpMP3Element);
    
    	$httpsMP3Element = $doc->createElement("https");
    	$httpsMP3Element->appendChild($doc->createTextNode(utf8_encode('https://288763349e1d9895c284-03bc13b1e76a5a9c9ac4fb771e9b7a23.ssl.cf1.rackcdn.com/'.$m->Filename)));
    	$itemElement->appendChild($httpsMP3Element);
    
    	$streamingMP3Element = $doc->createElement("streaming");
    	$streamingMP3Element->appendChild($doc->createTextNode(utf8_encode('http://3fe53bbd7b947c5383b3-03bc13b1e76a5a9c9ac4fb771e9b7a23.r27.stream.cf1.rackcdn.com/'.$m->Filename)));
    	$itemElement->appendChild($streamingMP3Element);
    
    	$iosMP3Element = $doc->createElement("ios");
    	$iosMP3Element->appendChild($doc->createTextNode(utf8_encode('http://eb24d662ea3d83e9147e-03bc13b1e76a5a9c9ac4fb771e9b7a23.iosr.cf1.rackcdn.com/'.$m->Filename)));
    	$itemElement->appendChild($iosMP3Element);
	
		$mpalbumArtElement = $doc->createElement("artID");
		$mpalbumArtElement->appendChild($doc->createTextNode(utf8_encode($m->_PictureLink)));
		$itemElement->appendChild($mpalbumArtElement);
	
		$waveformElement = $doc->createElement("waveformID");
		$waveformElement->appendChild($doc->createTextNode(utf8_encode($m->_WaveformLink)));
		$itemElement->appendChild($waveformElement);
	
		$lyricsElement = $doc->createElement("lyrics");
		$lyricsElement->appendChild($doc->createCDATASection(utf8_encode($m->Lyrics)));
		$itemElement->appendChild($lyricsElement);
	
    	$fileHashElement = $doc->createElement("file_hash");
    	$fileHashElement->appendChild($doc->createTextNode(utf8_encode($asset->file_hash)));
    	$itemElement->appendChild($fileHashElement);
    
		$assetkeyElement = $doc->createElement("asset_key");
		$assetkeyElement->appendChild($doc->createTextNode(utf8_encode($asset->asset_key)));
		$itemElement->appendChild($assetkeyElement);

		$root_element->appendChild($itemElement);

	} else if($asset->filepath){

		$trackNameElement = $doc->createElement("trackName");
		$trackNameElement->appendChild($doc->createTextNode(utf8_encode($asset->title)));
		$itemElement->appendChild($trackNameElement);
	
		$artistElement = $doc->createElement("artist");
		$artistElement->appendChild($doc->createTextNode(utf8_encode($asset->artist)));
		$itemElement->appendChild($artistElement);
	
		$httpMP3Element = $doc->createElement("http");
		$httpMP3Element->appendChild($doc->createTextNode(utf8_encode("https://www.thedinermusic.com/api/".$asset->filepath)));
		$itemElement->appendChild($httpMP3Element);
	
		$httpsMP3Element = $doc->createElement("https");
		$httpsMP3Element->appendChild($doc->createTextNode(utf8_encode("https://www.thedinermusic.com/api/".$asset->filepath)));
		$itemElement->appendChild($httpsMP3Element);
	
		$assetkeyElement = $doc->createElement("asset_key");
		$assetkeyElement->appendChild($doc->createTextNode(utf8_encode($asset->asset_key)));
		$itemElement->appendChild($assetkeyElement);

		$root_element->appendChild($itemElement);

	}

/*
	$recIDElement = $doc->createElement("RecID");
	$recIDElement->appendChild($doc->createTextNode(utf8_encode("mp".$asset->RecID)));
	$itemElement->appendChild($recIDElement);

*/

endforeach;

print $doc->saveXML();

?>