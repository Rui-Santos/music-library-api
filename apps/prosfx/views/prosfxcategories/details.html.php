<?php 
Layout::extend('layouts/prosfxcategories');
$title = 'Details of prosfxcategories #' . $prosfxcategories->RecID ;
?>

<?php Part::draw('prosfxcategories/details', $prosfxcategories) ?>

<?php echo Html::anchor(Url::action('prosfxcategoriesController::index'), 'Back to list of prosfxcategoriess') ?>
<hr />