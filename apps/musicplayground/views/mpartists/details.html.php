<?php 
Layout::extend('layouts/mpartists');
$title = 'Details of mpartists #' . $mpartists->RecID ;
?>

<?php Part::draw('mpartists/details', $mpartists) ?>

<?php echo Html::anchor(Url::action('mpartistsController::index'), 'Back to list of mpartistss') ?>
<hr />