<?php 
Layout::extend('layouts/prosfxtest');
$title = 'Details of prosfxtest #' . $prosfxtest->RecID ;
?>

<?php Part::draw('prosfxtest/details', $prosfxtest) ?>

<?php echo Html::anchor(Url::action('prosfxtestController::index'), 'Back to list of prosfxtests') ?>
<hr />