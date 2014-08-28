<?php 
Layout::extend('layouts/downloadmpsampler');
if(isset($downloadmpsampler->id)) {
	$title = 'Edit downloadmpsampler #' . $downloadmpsampler->id;
} else {
	$title = 'Create New downloadmpsampler';
}
$title = $title;
?>

<?php Part::draw('downloadmpsampler/form', $_form, $title) ?>

<?php echo Html::anchor(Url::action('downloadmpsamplerController::index'), 'downloadmpsampler List') ?>