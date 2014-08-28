<?php 
Layout::extend('layouts/prosfxall');
if(isset($prosfxall->RecID)) {
	$title = 'Edit prosfxall #' . $prosfxall->RecID;
} else {
	$title = 'Create New prosfxall';
}
$title = $title;
?>

<?php Part::draw('prosfxall/form', $_form, $title) ?>

<?php echo Html::anchor(Url::action('prosfxallController::index'), 'prosfxall List') ?>