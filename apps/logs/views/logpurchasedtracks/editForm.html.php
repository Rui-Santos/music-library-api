<?php 
Layout::extend('layouts/logpurchasedtracks');
if(isset($logpurchasedtracks->id)) {
	$title = 'Edit logpurchasedtracks #' . $logpurchasedtracks->id;
} else {
	$title = 'Create New logpurchasedtracks';
}
$title = $title;
?>

<?php Part::draw('logpurchasedtracks/form', $_form, $title) ?>

<?php echo Html::anchor(Url::action('logpurchasedtracksController::index'), 'logpurchasedtracks List') ?>