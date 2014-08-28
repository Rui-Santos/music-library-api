<?php 
Layout::extend('layouts/prosfxquery');
$title = 'Details of prosfxquery #' . $prosfxquery->RecID ;
?>

<?php Part::draw('prosfxquery/details', $prosfxquery) ?>

<?php echo Html::anchor(Url::action('prosfxqueryController::index'), 'Back to list of prosfxquerys') ?>
<hr />