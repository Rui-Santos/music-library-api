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

$idElement = $doc->createElement("id");
$idElement->appendChild($doc->createTextNode(utf8_encode($adminpurchases->id)));
$root_element->appendChild($idElement);

$hashElement = $doc->createElement("hash");
$hashElement->appendChild($doc->createTextNode(utf8_encode($adminpurchases->hash)));
$root_element->appendChild($hashElement);

$stripeIDElement = $doc->createElement("stripe_id");
$stripeIDElement->appendChild($doc->createTextNode(utf8_encode($adminpurchases->stripe_id)));
$root_element->appendChild($stripeIDElement);

$amountElement = $doc->createElement("amount");
$amountElement->appendChild($doc->createTextNode(utf8_encode($adminpurchases->amount)));
$root_element->appendChild($amountElement);

$dateElement = $doc->createElement("date");
$dateElement->appendChild($doc->createTextNode(utf8_encode($adminpurchases->date)));
$root_element->appendChild($dateElement);

$typeElement = $doc->createElement("type");
$typeElement->appendChild($doc->createTextNode(utf8_encode($adminpurchases->type)));
$root_element->appendChild($typeElement);

$statusElement = $doc->createElement("status");
$statusElement->appendChild($doc->createTextNode(utf8_encode($adminpurchases->status)));
$root_element->appendChild($statusElement);

for ($i=$startNum; $i <= $limit; $i++) {

	$track = $purchSet[$i-1];

	$itemElement = $doc->createElement("item");
	$root_element->appendChild($itemElement);

	$recIDElement = $doc->createElement("RecID");
	$recIDElement->appendChild($doc->createTextNode(utf8_encode($track->RecID)));
	$itemElement->appendChild($recIDElement);

	$trackNameElement = $doc->createElement("TrackTitle");
	$trackNameElement->appendChild($doc->createTextNode(utf8_encode($track->TrackTitle)));
	$itemElement->appendChild($trackNameElement);

	$durationElement = $doc->createElement("Duration");
	$durationElement->appendChild($doc->createTextNode(utf8_encode($track->Duration)));
	$itemElement->appendChild($durationElement);

	$CDTitleElement = $doc->createElement("CDTitle");
	$CDTitleElement->appendChild($doc->createTextNode(utf8_encode($track->CDTitle)));
	$itemElement->appendChild($CDTitleElement);

	$descriptionElement = $doc->createElement("Description");
	$descriptionElement->appendChild($doc->createTextNode(utf8_encode($track->Description)));
	$itemElement->appendChild($descriptionElement);

	$dineralbumArtElement = $doc->createElement("_PictureLink");
	$dineralbumArtElement->appendChild($doc->createTextNode(utf8_encode($track->_PictureLink)));
	$itemElement->appendChild($dineralbumArtElement);

	$waveformElement = $doc->createElement("_WaveformLink");
	$waveformElement->appendChild($doc->createTextNode(utf8_encode($track->_WaveformLink)));
	$itemElement->appendChild($waveformElement);

	$assetElement = $doc->createElement("asset_id");
	$assetElement->appendChild($doc->createTextNode(utf8_encode($track->asset_id)));
	$itemElement->appendChild($assetElement);

	$dbElement = $doc->createElement("db_id");
	$dbElement->appendChild($doc->createTextNode(utf8_encode($track->db_id)));
	$itemElement->appendChild($dbElement);

	$assetKeyElement = $doc->createElement("asset_key");
	$assetKeyElement->appendChild($doc->createTextNode(utf8_encode($track->asset_key)));
	$itemElement->appendChild($assetKeyElement);


}
print $doc->saveXML();

?>