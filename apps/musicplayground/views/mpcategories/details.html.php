<?php 
Layout::extend('layouts/mpcategories');
$title = 'Details of mpcategories #' . $mpcategories->RecID ;
?>

<?php Part::draw('mpcategories/details', $mpcategories) ?>

<?php echo Html::anchor(Url::action('mpcategoriesController::index'), 'Back to list of mpcategoriess') ?>
<hr />