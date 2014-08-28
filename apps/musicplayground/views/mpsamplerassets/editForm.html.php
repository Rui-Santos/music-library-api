<?php 
Layout::extend('layouts/mpsamplerassets');
if(isset($mpsamplerassets->id)) {
	$title = 'Edit mpsamplerassets #' . $mpsamplerassets->id;
} else {
	$title = 'Create New mpsamplerassets';
}
$title = $title;
?>

<?php Part::draw('mpsamplerassets/form', $_form, $title) ?>

<?php echo Html::anchor(Url::action('mpsamplerassetsController::index'), 'mpsamplerassets List') ?>