<?php 
Layout::extend('layouts/downloadmpsamplerassets');
$title = 'Index';
?>

<h3><?php echo Html::anchor(Url::action('downloadmpsamplerassetsController::newForm'), 'Create New downloadmpsamplerassets') ?></h3>

<?php if(isset($flash)): ?>
	<div class="error">
	<?php echo $flash; ?>
	</div>
<?php endif; ?>

<?php foreach($downloadmpsamplerassetsSet as $downloadmpsamplerassets): ?>
	<?php Part::draw('downloadmpsamplerassets/details', $downloadmpsamplerassets) ?>
	<hr />
<?php endforeach; ?>