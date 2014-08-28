<?php 
Layout::extend('layouts/downloadpurchasedtracks');
if(isset($downloadpurchasedtracks->id)) {
	$title = 'Edit downloadpurchasedtracks #' . $downloadpurchasedtracks->id;
} else {
	$title = 'Create New downloadpurchasedtracks';
}
$title = $title;
?>

<?php Part::draw('downloadpurchasedtracks/form', $_form, $title) ?>

<?php echo Html::anchor(Url::action('downloadpurchasedtracksController::index'), 'downloadpurchasedtracks List') ?>