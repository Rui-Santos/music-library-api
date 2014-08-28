<?php 
Layout::extend('layouts/base');
if(isset($base->id)) {
	$title = 'Edit base #' . $base->id;
} else {
	$title = 'Create New base';
}
$title = $title;
?>

<?php Part::draw('base/form', $_form, $title) ?>

<?php echo Html::anchor(Url::action('baseController::index'), 'base List') ?>