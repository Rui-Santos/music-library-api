<?php 
Layout::extend('layouts/logpurchases');
$title = 'Details of logpurchases #' . $logpurchases->id ;
?>

<?php Part::draw('logpurchases/details', $logpurchases) ?>

<?php echo Html::anchor(Url::action('logpurchasesController::index'), 'Back to list of logpurchasess') ?>
<hr />