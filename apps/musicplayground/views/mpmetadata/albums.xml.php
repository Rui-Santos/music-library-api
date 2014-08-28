<?php if(isset($flash)): ?>
<div class="error">
<?php echo $flash; ?>
</div>
<?php endif;
	$doc = new DOMDocument();
	$doc->formatOutput = true;
	$root_element = $doc->createElement("query");
	$root_element->setAttribute("count",count($mpmetadataSet));
	$doc->appendChild($root_element);
	
	$albumArray = array();

    $length = count($mpmetadataSet);
    $startpage = $mpmetadata->pageNumber;
    $limit = $mpmetadata->pageLimit;
    
    $startNum = (($startpage-1)*$limit)+1;
	$x = $startNum;
    
    if ($limit == 0) {
    	$limit = $length;
    	$root_element->setAttribute("more",false);
    } else {
    	$limit = $startpage * $limit;
    	if($limit >= $length) {
    		$limit = $length;
    		$root_element->setAttribute("more",false);
    	} else {
    		$root_element->setAttribute("more",true);
    	}
    }
	$set = $mpmetadataSet->limit($mpmetadata->pageLimit)->offset($startNum-1);
	foreach($set as $mpmetadata){
/* 	while ($x <= $limit) { */
		
/* 	    $mpmetadata = $mpmetadataSet[$x-1]; */
		$inArray = false;
	
		for ( $i=0; $i < count($albumArray); $i++ ) {
			if( ($albumArray[$i]['CDTitle'] == $mpmetadata->CDTitle && $albumArray[$i]['_PictureLink'] == $mpmetadata->_PictureLink) ) {
				$inArray = true;

				$mpcompElement = $doc->createElement("artist");
				$mpcompElement->appendChild($doc->createTextNode(utf8_encode('Various Artists')));
				
				$oldElement = $doc->getElementsByTagName('item')->item($i)->childNodes->item(1);
				$doc->getElementsByTagName('item')->item($i)->replaceChild($mpcompElement, $oldElement);
				break;
			} else if ( ($albumArray[$i]['CDTitle'] == $mpmetadata->CDTitle && $albumArray[$i]['Library'] == $mpmetadata->Library) ) {
				$inArray = true;
				break;
			}
		}
		if (!$inArray) {
		
			$albumData = array( 'CDTitle' => $mpmetadata->CDTitle, 'Library' => $mpmetadata->Library, '_PictureLink' => $mpmetadata->_PictureLink);
		
			array_push($albumArray, $albumData);
			
			$itemElement = $doc->createElement("item");
			$root_element->appendChild($itemElement);
		
			$mpmetadataElement = $doc->createElement("album");
			$mpmetadataElement->appendChild($doc->createTextNode(utf8_encode($mpmetadata->CDTitle)));
			$itemElement->appendChild($mpmetadataElement);
		
			$mpslugElement = $doc->createElement("slug");
			$mpslugElement->appendChild($doc->createTextNode(utf8_encode($mpmetadata->CDDescription)));
			$itemElement->appendChild($mpslugElement);
		
			$mpartistElement = $doc->createElement("artist");
			$mpartistElement->appendChild($doc->createTextNode(utf8_encode($mpmetadata->Library)));
			$itemElement->appendChild($mpartistElement);
		
			$mpalbumArtElement = $doc->createElement("artID");
			$mpalbumArtElement->appendChild($doc->createTextNode(utf8_encode($mpmetadata->_PictureLink)));
			$itemElement->appendChild($mpalbumArtElement);
			
			$sourceElement = $doc->createElement("source");
			$sourceElement->appendChild($doc->createTextNode(utf8_encode($mpmetadata->Source)));
			$itemElement->appendChild($sourceElement);
	
			//$x++
		}


	
	}
	print $doc->saveXML();

?>