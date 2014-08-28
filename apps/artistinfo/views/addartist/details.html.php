<?php 
Layout::extend('layouts/addartist');
$title = 'Details of addartist #' . $addartist->id ;
?>

<?php Part::draw('addartist/details', $addartist) ?>

<?php echo Html::anchor(Url::action('addartistController::index'), 'Back to list of addartists') ?>
<hr />