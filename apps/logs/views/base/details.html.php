<?php 
Layout::extend('layouts/base');
$title = 'Details of base #' . $base->id ;
?>

<?php Part::draw('base/details', $base) ?>

<?php echo Html::anchor(Url::action('baseController::index'), 'Back to list of bases') ?>
<hr />