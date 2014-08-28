<?php 
Layout::extend('layouts/prosfxart');
$title = 'Index';
?>

<h3><?php echo Html::anchor(Url::action('prosfxartController::newForm'), 'Create New prosfxart') ?></h3>

<?php if(isset($flash)): ?>
	<div class="error">
	<?php echo $flash; ?>
	</div>
<?php endif; ?>

<?php foreach($prosfxartSet as $prosfxart): ?>
	<?php Part::draw('prosfxart/details', $prosfxart) ?>
	<hr />
<?php endforeach; ?>