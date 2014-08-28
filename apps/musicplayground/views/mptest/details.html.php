<?php 
Layout::extend('layouts/mptest');
$title = 'Details of mptest #' . $mptest->RecID ;
?>

<?php Part::draw('mptest/details', $mptest) ?>

<?php echo Html::anchor(Url::action('mptestController::index'), 'Back to list of mptests') ?>
<hr />