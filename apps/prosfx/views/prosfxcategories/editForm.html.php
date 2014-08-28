<?php 
Layout::extend('layouts/prosfxcategories');
if(isset($prosfxcategories->RecID)) {
	$title = 'Edit prosfxcategories #' . $prosfxcategories->RecID;
} else {
	$title = 'Create New prosfxcategories';
}
$title = $title;
?>

<?php Part::draw('prosfxcategories/form', $_form, $title) ?>

<?php echo Html::anchor(Url::action('prosfxcategoriesController::index'), 'prosfxcategories List') ?>