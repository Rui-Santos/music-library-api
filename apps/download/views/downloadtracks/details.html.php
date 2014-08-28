<?php 
Layout::extend('layouts/downloadtracks');
$title = 'Details of downloadtracks #' . $downloadtracks->id ;
?>

<?php Part::draw('downloadtracks/details', $downloadtracks) ?>

<?php echo Html::anchor(Url::action('downloadtracksController::index'), 'Back to list of downloadtrackss') ?>
<hr />