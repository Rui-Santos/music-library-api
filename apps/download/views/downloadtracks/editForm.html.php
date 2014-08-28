<?php 
Layout::extend('layouts/downloadtracks');
if(isset($downloadtracks->id)) {
	$title = 'Edit downloadtracks #' . $downloadtracks->id;
} else {
	$title = 'Create New downloadtracks';
}
$title = $title;
?>

<?php Part::draw('downloadtracks/form', $_form, $title) ?>

<?php echo Html::anchor(Url::action('downloadtracksController::index'), 'downloadtracks List') ?>