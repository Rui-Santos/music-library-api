<?php 
Layout::extend('layouts/prosfxquery');
if(isset($prosfxquery->RecID)) {
	$title = 'Edit prosfxquery #' . $prosfxquery->RecID;
} else {
	$title = 'Create New prosfxquery';
}
$title = $title;
?>

<?php Part::draw('prosfxquery/form', $_form, $title) ?>

<?php echo Html::anchor(Url::action('prosfxqueryController::index'), 'prosfxquery List') ?>