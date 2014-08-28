<?php 
Layout::extend('layouts/addartist');
if(isset($addartist->id)) {
	$title = 'Edit addartist #' . $addartist->id;
} else {
	$title = 'Create New addartist';
}
$title = $title;
?>

<?php Part::draw('addartist/form', $_form, $title) ?>

<?php echo Html::anchor(Url::action('addartistController::index'), 'addartist List') ?>