<?php 
Layout::extend('layouts/prosfxart');
if(isset($prosfxart->RecID)) {
	$title = 'Edit prosfxart #' . $prosfxart->RecID;
} else {
	$title = 'Create New prosfxart';
}
$title = $title;
?>

<?php Part::draw('prosfxart/form', $_form, $title) ?>

<?php echo Html::anchor(Url::action('prosfxartController::index'), 'prosfxart List') ?>