<?php 
Layout::extend('layouts/mpart');
$title = 'Index';
?>

<h3><?php echo Html::anchor(Url::action('mpartController::newForm'), 'Create New mpart') ?></h3>

<?php if(isset($flash)): ?>
	<div class="error">
	<?php echo $flash; ?>
	</div>
<?php endif; ?>

<?php foreach($mpartSet as $mpart): ?>
	<?php Part::draw('mpart/details', $mpart) ?>
	<hr />
<?php endforeach; ?>