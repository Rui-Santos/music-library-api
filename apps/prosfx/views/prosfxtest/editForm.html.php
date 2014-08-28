<?php 
Layout::extend('layouts/prosfxtest');
if(isset($prosfxtest->RecID)) {
	$title = 'Edit prosfxtest #' . $prosfxtest->RecID;
} else {
	$title = 'Create New prosfxtest';
}
$title = $title;
?>

<?php Part::draw('prosfxtest/form', $_form, $title) ?>

<?php echo Html::anchor(Url::action('prosfxtestController::index'), 'prosfxtest List') ?>