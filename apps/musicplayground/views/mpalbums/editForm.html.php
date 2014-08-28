<?php 
Layout::extend('layouts/mpalbums');
if(isset($mpalbums->RecID)) {
	$title = 'Edit mpalbums #' . $mpalbums->RecID;
} else {
	$title = 'Create New mpalbums';
}
$title = $title;
?>

<?php Part::draw('mpalbums/form', $_form, $title) ?>

<?php echo Html::anchor(Url::action('mpalbumsController::index'), 'mpalbums List') ?>