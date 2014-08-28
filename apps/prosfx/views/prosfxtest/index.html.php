<?php 
Layout::extend('layouts/prosfxtest');
$title = 'Index';
?>

<h3><?php echo Html::anchor(Url::action('prosfxtestController::newForm'), 'Create New prosfxtest') ?></h3>

<?php if(isset($flash)): ?>
	<div class="error">
	<?php echo $flash; ?>
	</div>
<?php endif; ?>

<?php foreach($prosfxtestSet as $prosfxtest): ?>
	<?php Part::draw('prosfxtest/details', $prosfxtest) ?>
	<hr />
<?php endforeach; ?>