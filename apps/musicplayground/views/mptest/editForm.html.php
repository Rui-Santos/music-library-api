<?php 
Layout::extend('layouts/mptest');
if(isset($mptest->RecID)) {
	$title = 'Edit mptest #' . $mptest->RecID;
} else {
	$title = 'Create New mptest';
}
$title = $title;
?>

<?php Part::draw('mptest/form', $_form, $title) ?>

<?php echo Html::anchor(Url::action('mptestController::index'), 'mptest List') ?>