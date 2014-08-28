<?php 
Layout::extend('layouts/mplyrics');
$title = 'Details of mplyrics #' . $mplyrics->RecID ;
?>

<?php Part::draw('mplyrics/details', $mplyrics) ?>

<?php echo Html::anchor(Url::action('mplyricsController::index'), 'Back to list of mplyricss') ?>
<hr />