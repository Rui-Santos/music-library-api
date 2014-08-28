<?php if(isset($flash)): ?>
<div class="error">
<?php echo $flash; ?>
</div>
<?php endif;

$doc = new DOMDocument();
$doc->formatOutput = true;
$root_element = $doc->createElement("query");
$root_element->setAttribute("count",count($cartSet));
$doc->appendChild($root_element);

$cartStatus = '';

$length = count($cartSet);
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

	$track = $cartSet[$i-1];

	if($i == $startNum) {
		$cartStatus = $track->type;
	} else {
		if($cartStatus != $track->type) {
			$cartStatus = 'mixed';
		}
	}

	$itemElement = $doc->createElement("item");
	$root_element->appendChild($itemElement);

	$recIDElement = $doc->createElement("id");
	$recIDElement->appendChild($doc->createTextNode(utf8_encode($track->id)));
	$itemElement->appendChild($recIDElement);

	$trackNameElement = $doc->createElement("type");
	$trackNameElement->appendChild($doc->createTextNode(utf8_encode($track->type)));
	$itemElement->appendChild($trackNameElement);

	$durationElement = $doc->createElement("item_id");
	$durationElement->appendChild($doc->createTextNode(utf8_encode($track->item_id)));
	$itemElement->appendChild($durationElement);

	$assetIDElement = $doc->createElement("asset_id");
	$assetIDElement->appendChild($doc->createTextNode(utf8_encode($track->asset_id)));
	$itemElement->appendChild($assetIDElement);

	$priceElement = $doc->createElement("price");
	$priceElement->appendChild($doc->createTextNode(utf8_encode($track->price)));
	$itemElement->appendChild($priceElement);

	if ($track->type == 'asset') {
		$assetKeyElement = $doc->createElement("asset_key");
		$assetKeyElement->appendChild($doc->createTextNode(utf8_encode($track->assets()->asset_key)));
		$itemElement->appendChild($assetKeyElement);

		$recIDElement = $doc->createElement("RecID");
		$recIDElement->appendChild($doc->createTextNode(utf8_encode("di".$track->assets()->RecID)));
		$itemElement->appendChild($recIDElement);
	
		$trackNameElement = $doc->createElement("TrackTitle");
		$trackNameElement->appendChild($doc->createTextNode(utf8_encode($track->assets()->TrackTitle)));
		$itemElement->appendChild($trackNameElement);
	
		$durationElement = $doc->createElement("Duration");
		$durationElement->appendChild($doc->createTextNode(utf8_encode($track->assets()->Duration)));
		$itemElement->appendChild($durationElement);
	
		$CDTitleElement = $doc->createElement("Category");
		$CDTitleElement->appendChild($doc->createTextNode(utf8_encode($track->assets()->Category)));
		$itemElement->appendChild($CDTitleElement);
	
		$descriptionElement = $doc->createElement("Description");
		$descriptionElement->appendChild($doc->createTextNode(utf8_encode($track->assets()->Description)));
		$itemElement->appendChild($descriptionElement);
	
		$dineralbumArtElement = $doc->createElement("_PictureLink");
		$dineralbumArtElement->appendChild($doc->createTextNode(utf8_encode($track->assets()->_PictureLink)));
		$itemElement->appendChild($dineralbumArtElement);
	
		$waveformElement = $doc->createElement("_WaveformLink");
		$waveformElement->appendChild($doc->createTextNode(utf8_encode($track->assets()->_WaveformLink)));
		$itemElement->appendChild($waveformElement);
	
		$dbElement = $doc->createElement("db_id");
		$dbElement->appendChild($doc->createTextNode(utf8_encode($track->assets()->db_id)));
		$itemElement->appendChild($dbElement);
	
	}
	
}

$root_element->setAttribute("status",$cartStatus);

print $doc->saveXML();

?>