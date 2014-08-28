<?php 
Layout::extend('layouts/tracks');
$title = 'Details of tracks #' . $tracks->id ;
?>

<?php Part::draw('tracks/details', $tracks) ?>

<?php echo Html::anchor(Url::action('tracksController::index'), 'Back to list of trackss') ?>
<hr />