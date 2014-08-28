<?php 
Layout::extend('layouts/downloadmpsamplerassets');
$title = 'Details of downloadmpsamplerassets #' . $downloadmpsamplerassets->id ;
?>

<?php Part::draw('downloadmpsamplerassets/details', $downloadmpsamplerassets) ?>

<?php echo Html::anchor(Url::action('downloadmpsamplerassetsController::index'), 'Back to list of downloadmpsamplerassetss') ?>
<hr />