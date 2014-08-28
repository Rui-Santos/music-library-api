<?php 
Layout::extend('layouts/dinertest');
$title = 'Details of dinertest #' . $dinertest->RecID ;
?>

<?php Part::draw('dinertest/details', $dinertest) ?>

<?php echo Html::anchor(Url::action('dinertestController::index'), 'Back to list of dinertests') ?>
<hr />