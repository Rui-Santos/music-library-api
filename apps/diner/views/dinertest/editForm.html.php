<?php 
Layout::extend('layouts/dinertest');
if(isset($dinertest->RecID)) {
	$title = 'Edit dinertest #' . $dinertest->RecID;
} else {
	$title = 'Create New dinertest';
}
$title = $title;
?>

<?php Part::draw('dinertest/form', $_form, $title) ?>

<?php echo Html::anchor(Url::action('dinertestController::index'), 'dinertest List') ?>