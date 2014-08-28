<?php 
Layout::extend('layouts/mpart');
if(isset($mpart->RecID)) {
	$title = 'Edit mpart #' . $mpart->RecID;
} else {
	$title = 'Create New mpart';
}
$title = $title;
?>

<?php Part::draw('mpart/form', $_form, $title) ?>

<?php echo Html::anchor(Url::action('mpartController::index'), 'mpart List') ?>