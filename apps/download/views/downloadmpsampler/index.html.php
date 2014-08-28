<?php 
Layout::extend('layouts/downloadmpsampler');
$title = 'Index';
?>

<h3><?php echo Html::anchor(Url::action('downloadmpsamplerController::newForm'), 'Create New downloadmpsampler') ?></h3>

<?php if(isset($flash)): ?>
	<div class="error">
	<?php echo $flash; ?>
	</div>
<?php endif; ?>

<?php foreach($downloadmpsamplerSet as $downloadmpsampler): ?>
	<?php Part::draw('downloadmpsampler/details', $downloadmpsampler) ?>
	<hr />
<?php endforeach; ?>