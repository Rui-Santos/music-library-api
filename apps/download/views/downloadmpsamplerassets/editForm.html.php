<?php 
Layout::extend('layouts/downloadmpsamplerassets');
if(isset($downloadmpsamplerassets->id)) {
	$title = 'Edit downloadmpsamplerassets #' . $downloadmpsamplerassets->id;
} else {
	$title = 'Create New downloadmpsamplerassets';
}
$title = $title;
?>

<?php Part::draw('downloadmpsamplerassets/form', $_form, $title) ?>

<?php echo Html::anchor(Url::action('downloadmpsamplerassetsController::index'), 'downloadmpsamplerassets List') ?>