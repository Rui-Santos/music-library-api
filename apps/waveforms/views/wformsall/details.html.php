<?php 
Layout::extend('layouts/wformsall');
$title = 'Details of wformsall #' . $wformsall->RecID ;
?>

<?php Part::draw('wformsall/details', $wformsall) ?>

<?php echo Html::anchor(Url::action('wformsallController::index'), 'Back to list of wformsalls') ?>
<hr />