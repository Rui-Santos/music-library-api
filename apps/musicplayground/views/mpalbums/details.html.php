<?php 
Layout::extend('layouts/mpalbums');
$title = 'Details of mpalbums #' . $mpalbums->RecID ;
?>

<?php Part::draw('mpalbums/details', $mpalbums) ?>

<?php echo Html::anchor(Url::action('mpalbumsController::index'), 'Back to list of mpalbumss') ?>
<hr />