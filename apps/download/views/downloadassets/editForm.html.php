<?php 
Layout::extend('layouts/downloadassets');
if(isset($downloadassets->id)) {
	$title = 'Edit downloadassets #' . $downloadassets->id;
} else {
	$title = 'Create New downloadassets';
}
$title = $title;
?>

<?php Part::draw('downloadassets/form', $_form, $title) ?>

<?php echo Html::anchor(Url::action('downloadassetsController::index'), 'downloadassets List') ?>