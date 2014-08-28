<?php 
Layout::extend('layouts/downloadassets');
$title = 'Details of downloadassets #' . $downloadassets->id ;
?>

<?php Part::draw('downloadassets/details', $downloadassets) ?>

<?php echo Html::anchor(Url::action('downloadassetsController::index'), 'Back to list of downloadassetss') ?>
<hr />