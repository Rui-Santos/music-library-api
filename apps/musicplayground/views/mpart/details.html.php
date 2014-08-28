<?php 
Layout::extend('layouts/mpart');
$title = 'Details of mpart #' . $mpart->RecID ;
?>

<?php Part::draw('mpart/details', $mpart) ?>

<?php echo Html::anchor(Url::action('mpartController::index'), 'Back to list of mparts') ?>
<hr />