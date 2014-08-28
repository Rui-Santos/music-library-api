<?php 
Layout::extend('layouts/dinerall');
if(isset($dinerall->RecID)) {
	$title = 'Edit dinerall #' . $dinerall->RecID;
} else {
	$title = 'Create New dinerall';
}
$title = $title;
?>

<?php Part::draw('dinerall/form', $_form, $title) ?>

<?php echo Html::anchor(Url::action('dinerallController::index'), 'dinerall List') ?>