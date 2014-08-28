<?php 
Layout::extend('layouts/mpquery');
if(isset($mpquery->RecID)) {
	$title = 'Edit mpquery #' . $mpquery->RecID;
} else {
	$title = 'Create New mpquery';
}
$title = $title;
?>

<?php Part::draw('mpquery/form', $_form, $title) ?>

<?php echo Html::anchor(Url::action('mpqueryController::index'), 'mpquery List') ?>