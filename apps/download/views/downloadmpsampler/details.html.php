<?php 
Layout::extend('layouts/downloadmpsampler');
$title = 'Details of downloadmpsampler #' . $downloadmpsampler->id ;
?>

<?php Part::draw('downloadmpsampler/details', $downloadmpsampler) ?>

<?php echo Html::anchor(Url::action('downloadmpsamplerController::index'), 'Back to list of downloadmpsamplers') ?>
<hr />