<?php 
Layout::extend('layouts/prosfxart');
$title = 'Details of prosfxart #' . $prosfxart->RecID ;
?>

<?php Part::draw('prosfxart/details', $prosfxart) ?>

<?php echo Html::anchor(Url::action('prosfxartController::index'), 'Back to list of prosfxarts') ?>
<hr />