<?php 
Layout::extend('layouts/searches');
$title = 'Details of searches #' . $searches->log_id ;
?>

<?php Part::draw('searches/details', $searches) ?>

<?php echo Html::anchor(Url::action('searchesController::index'), 'Back to list of searchess') ?>
<hr />