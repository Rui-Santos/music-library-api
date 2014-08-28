<?php 
Layout::extend('layouts/assets');
$title = 'Index';
?>

<h3><?php echo Html::anchor(Url::action('assetsController::newForm'), 'Create New assets') ?></h3>

<?php if(isset($flash)): ?>
	<div class="error">
	<?php echo $flash; ?>
	</div>
<?php endif; ?>

<?php foreach($assetsSet as $assets): ?>
	<?php Part::draw('assets/details', $assets) ?>
	<hr />
<?php endforeach; ?>