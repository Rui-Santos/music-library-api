<?php 
Layout::extend('layouts/base');
$title = 'Index';
?>

<h3><?php echo Html::anchor(Url::action('baseController::newForm'), 'Create New base') ?></h3>

<?php if(isset($flash)): ?>
	<div class="error">
	<?php echo $flash; ?>
	</div>
<?php endif; ?>

<?php foreach($baseSet as $base): ?>
	<?php Part::draw('base/details', $base) ?>
	<hr />
<?php endforeach; ?>