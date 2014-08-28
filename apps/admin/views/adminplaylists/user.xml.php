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
	
		if ($playlists->type != "cart" && $playlists->type != "purchased") {
	
			$itemElement = $doc->createElement("item");
			$root_element->appendChild($itemElement);
		
			$playlistsElement = $doc->createElement("playlist");
			$playlistsElement->appendChild($doc->createTextNode(utf8_encode($playlists->name)));
			$itemElement->appendChild($playlistsElement);
			
			$createdElement = $doc->createElement("created");
			$createdElement->appendChild($doc->createTextNode(utf8_encode($playlists->created)));
			$itemElement->appendChild($createdElement);
			
			if ($d=='apitester') {
				$playlistsIDElement = $doc->createElement("id");
				$playlistsIDElement->appendChild($doc->createTextNode(utf8_encode($playlists->id)));
				$itemElement->appendChild($playlistsIDElement);
			}
				
			if (is_null($playlists->hash)) {
				$playlists->hash = substr(sha1($playlists->id . ":" . $playlists->folder_id), 0, 8);
				$playlists->save();
			}
			
			$hashElement = $doc->createElement("hash");
			$hashElement->appendChild($doc->createTextNode(utf8_encode($playlists->hash)));
			$itemElement->appendChild($hashElement);
			
			$countElement = $doc->createElement("length");
			$countElement->appendChild($doc->createTextNode(utf8_encode(count($playlists->tracks()))));
			$itemElement->appendChild($countElement);
			
		}
		
	endforeach;
	print $doc->saveXML();

?>