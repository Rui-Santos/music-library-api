<?php 
Layout::extend('layouts/mpartists');
if(isset($mpartists->RecID)) {
	$title = 'Edit mpartists #' . $mpartists->RecID;
} else {
	$title = 'Create New mpartists';
}
$title = $title;
?>

<?php Part::draw('mpartists/form', $_form, $title) ?>

<?php echo Html::anchor(Url::action('mpartistsController::index'), 'mpartists List') ?>