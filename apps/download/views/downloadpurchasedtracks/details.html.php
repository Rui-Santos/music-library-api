<?php 
Layout::extend('layouts/downloadpurchasedtracks');
$title = 'Details of downloadpurchasedtracks #' . $downloadpurchasedtracks->id ;
?>

<?php Part::draw('downloadpurchasedtracks/details', $downloadpurchasedtracks) ?>

<?php echo Html::anchor(Url::action('downloadpurchasedtracksController::index'), 'Back to list of downloadpurchasedtrackss') ?>
<hr />