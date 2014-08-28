<?php if(isset($flash)): ?>
<div class="error">
<?php echo $flash; ?>
</div>
<?php endif;

$doc = new DOMDocument();
$doc->formatOutput = true;
$root_element = $doc->createElement("query");
$root_element->setAttribute("count",count($purchSet));
$doc->appendChild($root_element);


$length = count($purchSet);
$startpage = $pageNum;
$limit = $pageLim;

$startNum = (($startpage-1)*$limit)+1;

if ($limit == 0) {
	$limit = $length;
} else {
	$limit = $startpage * $limit;
	if($limit > $length) {
		$limit = $length;
	}
}

for ($i=$startNum; $i <= $limit; $i++) {

	$track = $purchSet[$i-1];
	
	$a = $track->assets();

	$itemElement = $doc->createElement("item");
	$root_element->appendChild($itemElement);

	$recIDElement = $doc->createElement("RecID");
	$recIDElement->appendChild($doc->createTextNode(utf8_encode($a->RecID)));
	$itemElement->appendChild($recIDElement);

	$trackNameElement = $doc->createElement("TrackTitle");
	$trackNameElement->appendChild($doc->createTextNode(utf8_encode($a->TrackTitle)));
	$itemElement->appendChild($trackNameElement);

	$durationElement = $doc->createElement("Duration");
	$durationElement->appendChild($doc->createTextNode(utf8_encode($a->Duration)));
	$itemElement->appendChild($durationElement);

	$CDTitleElement = $doc->createElement("CDTitle");
	if(is_null($a->CDTitle)) {
		$CDTitleElement->appendChild($doc->createTextNode(utf8_encode("Null")));
	} else {
		$CDTitleElement->appendChild($doc->createTextNode(utf8_encode($a->CDTitle)));
	}
	$itemElement->appendChild($CDTitleElement);

	$descriptionElement = $doc->createElement("Description");
	$descriptionElement->appendChild($doc->createTextNode(utf8_encode($a->Description)));
	$itemElement->appendChild($descriptionElement);

	$dineralbumArtElement = $doc->createElement("_PictureLink");
	$dineralbumArtElement->appendChild($doc->createTextNode(utf8_encode($a->_PictureLink)));
	$itemElement->appendChild($dineralbumArtElement);

	$waveformElement = $doc->createElement("_WaveformLink");
	$waveformElement->appendChild($doc->createTextNode(utf8_encode($a->_WaveformLink)));
	$itemElement->appendChild($waveformElement);

	$assetElement = $doc->createElement("asset_id");
	$assetElement->appendChild($doc->createTextNode(utf8_encode($a->asset_id)));
	$itemElement->appendChild($assetElement);

	$dbElement = $doc->createElement("db_id");
	$dbElement->appendChild($doc->createTextNode(utf8_encode($a->db_id)));
	$itemElement->appendChild($dbElement);

	$assetKeyElement = $doc->createElement("asset_key");
	$assetKeyElement->appendChild($doc->createTextNode(utf8_encode($a->asset_key)));
	$itemElement->appendChild($assetKeyElement);

	$dateElement = $doc->createElement("date");
	$dateElement->appendChild($doc->createTextNode(utf8_encode($track->created)));
	$itemElement->appendChild($dateElement);

}
print $doc->saveXML();

?>