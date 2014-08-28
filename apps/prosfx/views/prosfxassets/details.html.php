<?php 
Layout::extend('layouts/prosfxassets');
$title = 'Details of prosfxassets #' . $prosfxassets->id ;
?>

<?php Part::draw('prosfxassets/details', $prosfxassets) ?>

<?php echo Html::anchor(Url::action('prosfxassetsController::index'), 'Back to list of prosfxassetss') ?>
<hr />