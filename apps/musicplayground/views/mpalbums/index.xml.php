<?php if(isset($flash)): ?>
<div class="error">
<?php echo $flash; ?>
</div>
<?php endif;
	$doc = new DOMDocument();
	$doc->formatOutput = true;
	$root_element = $doc->createElement("query");
	$root_element->setAttribute("count",count($mpalbumsSet));
	$doc->appendChild($root_element);
	
	$albumArray = array();
	
	foreach($mpalbumsSet as $mpalbums):
		
		$inArray = false;
	
		for ( $i=0; $i < count($albumArray); $i++ ) {
			if( ($albumArray[$i]['CDTitle'] == $mpalbums->CDTitle && $albumArray[$i]['_PictureLink'] == $mpalbums->_PictureLink) ) {
				$inArray = true;

				$mpcompElement = $doc->createElement("artist");
				$mpcompElement->appendChild($doc->createTextNode(utf8_encode('Various Artists')));
/* 				$itemElement->appendChild($mpcompElement); */
				
				$oldElement = $doc->getElementsByTagName('item')->item($i)->childNodes->item(1);
				$doc->getElementsByTagName('item')->item($i)->replaceChild($mpcompElement, $oldElement);
				break;
			} else if ( ($albumArray[$i]['CDTitle'] == $mpalbums->CDTitle && $albumArray[$i]['Library'] == $mpalbums->Library) ) {
				$inArray = true;
				break;
			}
		}
		if (!$inArray) {
		
			$albumData = array( 'CDTitle' => $mpalbums->CDTitle, 'Library' => $mpalbums->Library, '_PictureLink' => $mpalbums->_PictureLink);
		
			array_push($albumArray, $albumData);
			
			$itemElement = $doc->createElement("item");
			$root_element->appendChild($itemElement);
		
			$mpalbumsElement = $doc->createElement("album");
			$mpalbumsElement->appendChild($doc->createTextNode(utf8_encode($mpalbums->CDTitle)));
			$itemElement->appendChild($mpalbumsElement);
		
			$mpartistElement = $doc->createElement("artist");
			$mpartistElement->appendChild($doc->createTextNode(utf8_encode($mpalbums->Library)));
			$itemElement->appendChild($mpartistElement);
		
			$mpalbumArtElement = $doc->createElement("artID");
			$mpalbumArtElement->appendChild($doc->createTextNode(utf8_encode($mpalbums->_PictureLink)));
			$itemElement->appendChild($mpalbumArtElement);
		}


	
	endforeach;
	print $doc->saveXML();

?>