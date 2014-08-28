<?php 
Layout::extend('layouts/queries');
$title = 'Details of queries #' . $queries->id ;
?>

<?php Part::draw('queries/details', $queries) ?>

<?php echo Html::anchor(Url::action('queriesController::index'), 'Back to list of queriess') ?>
<hr />