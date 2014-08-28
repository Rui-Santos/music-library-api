<?php 
Layout::extend('layouts/prosfxassets');
if(isset($prosfxassets->id)) {
	$title = 'Edit prosfxassets #' . $prosfxassets->id;
} else {
	$title = 'Create New prosfxassets';
}
$title = $title;
?>

<?php Part::draw('prosfxassets/form', $_form, $title) ?>

<?php echo Html::anchor(Url::action('prosfxassetsController::index'), 'prosfxassets List') ?>