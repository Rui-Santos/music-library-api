<?php 
Layout::extend('layouts/downloadpurchase');
$title = 'Details of downloadpurchase #' . $downloadpurchase->id ;
?>

<?php Part::draw('downloadpurchase/details', $downloadpurchase) ?>

<?php echo Html::anchor(Url::action('downloadpurchaseController::index'), 'Back to list of downloadpurchases') ?>
<hr />