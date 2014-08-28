<?php 
Layout::extend('layouts/mpsamplerassets');
$title = 'Details of mpsamplerassets #' . $mpsamplerassets->id ;
?>

<?php Part::draw('mpsamplerassets/details', $mpsamplerassets) ?>

<?php echo Html::anchor(Url::action('mpsamplerassetsController::index'), 'Back to list of mpsamplerassetss') ?>
<hr />