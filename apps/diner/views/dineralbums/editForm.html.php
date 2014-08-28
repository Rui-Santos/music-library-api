<?php 
Layout::extend('layouts/dineralbums');
if(isset($dineralbums->RecID)) {
	$title = 'Edit dineralbums #' . $dineralbums->RecID;
} else {
	$title = 'Create New dineralbums';
}
$title = $title;
?>

<?php Part::draw('dineralbums/form', $_form, $title) ?>

<?php echo Html::anchor(Url::action('dineralbumsController::index'), 'dineralbums List') ?>