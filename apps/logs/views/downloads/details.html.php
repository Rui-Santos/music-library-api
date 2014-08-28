<?php 
Layout::extend('layouts/downloads');
$title = 'Details of downloads #' . $downloads->log_id ;
?>

<?php Part::draw('downloads/details', $downloads) ?>

<?php echo Html::anchor(Url::action('downloadsController::index'), 'Back to list of downloadss') ?>
<hr />