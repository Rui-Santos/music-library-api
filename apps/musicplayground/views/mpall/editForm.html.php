<?php 
Layout::extend('layouts/mpall');
if(isset($mpall->RecID)) {
	$title = 'Edit mpall #' . $mpall->RecID;
} else {
	$title = 'Create New mpall';
}
$title = $title;
?>

<?php Part::draw('mpall/form', $_form, $title) ?>

<?php echo Html::anchor(Url::action('mpallController::index'), 'mpall List') ?>