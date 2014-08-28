<?php 
Layout::extend('layouts/tracks');
if(isset($tracks->id)) {
	$title = 'Edit tracks #' . $tracks->id;
} else {
	$title = 'Create New tracks';
}
$title = $title;
?>

<?php Part::draw('tracks/form', $_form, $title) ?>

<?php echo Html::anchor(Url::action('tracksController::index'), 'tracks List') ?>