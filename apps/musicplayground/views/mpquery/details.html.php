<?php 
Layout::extend('layouts/mpquery');
$title = 'Details of mpquery #' . $mpquery->RecID ;
?>

<?php Part::draw('mpquery/details', $mpquery) ?>

<?php echo Html::anchor(Url::action('mpqueryController::index'), 'Back to list of mpquerys') ?>
<hr />