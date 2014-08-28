<?php 
Layout::extend('layouts/searches');
if(isset($searches->log_id)) {
	$title = 'Edit searches #' . $searches->log_id;
} else {
	$title = 'Create New searches';
}
$title = $title;
?>

<?php Part::draw('searches/form', $_form, $title) ?>

<?php echo Html::anchor(Url::action('searchesController::index'), 'searches List') ?>