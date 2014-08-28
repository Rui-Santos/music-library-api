<?php 
Layout::extend('layouts/assets');
$title = 'Details of assets #' . $assets->id ;
?>

<?php Part::draw('assets/details', $assets) ?>

<?php echo Html::anchor(Url::action('assetsController::index'), 'Back to list of assetss') ?>
<hr />