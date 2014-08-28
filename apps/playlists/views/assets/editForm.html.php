<?php 
Layout::extend('layouts/assets');
if(isset($assets->id)) {
	$title = 'Edit assets #' . $assets->id;
} else {
	$title = 'Create New assets';
}
$title = $title;
?>

<?php Part::draw('assets/form', $_form, $title) ?>

<?php echo Html::anchor(Url::action('assetsController::index'), 'assets List') ?>