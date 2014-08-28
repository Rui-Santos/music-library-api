<?php 
Layout::extend('layouts/queries');
if(isset($queries->id)) {
	$title = 'Edit queries #' . $queries->id;
} else {
	$title = 'Create New queries';
}
$title = $title;
?>

<?php Part::draw('queries/form', $_form, $title) ?>

<?php echo Html::anchor(Url::action('queriesController::index'), 'queries List') ?>