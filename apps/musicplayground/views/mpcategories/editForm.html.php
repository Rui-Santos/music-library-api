<?php 
Layout::extend('layouts/mpcategories');
if(isset($mpcategories->RecID)) {
	$title = 'Edit mpcategories #' . $mpcategories->RecID;
} else {
	$title = 'Create New mpcategories';
}
$title = $title;
?>

<?php Part::draw('mpcategories/form', $_form, $title) ?>

<?php echo Html::anchor(Url::action('mpcategoriesController::index'), 'mpcategories List') ?>