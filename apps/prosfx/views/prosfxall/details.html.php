<?php 
Layout::extend('layouts/prosfxall');
$title = 'Details of prosfxall #' . $prosfxall->RecID ;
?>

<?php Part::draw('prosfxall/details', $prosfxall) ?>

<?php echo Html::anchor(Url::action('prosfxallController::index'), 'Back to list of prosfxalls') ?>
<hr />