<?php 
Layout::extend('layouts/logpurchasedtracks');
$title = 'Details of logpurchasedtracks #' . $logpurchasedtracks->id ;
?>

<?php Part::draw('logpurchasedtracks/details', $logpurchasedtracks) ?>

<?php echo Html::anchor(Url::action('logpurchasedtracksController::index'), 'Back to list of logpurchasedtrackss') ?>
<hr />