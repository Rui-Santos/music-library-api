<?php 
Layout::extend('layouts/shares');
$title = 'Details of shares #' . $shares->id ;
?>

<?php Part::draw('shares/details', $shares) ?>

<?php echo Html::anchor(Url::action('sharesController::index'), 'Back to list of sharess') ?>
<hr />