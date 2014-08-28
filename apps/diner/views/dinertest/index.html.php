<?php 
Layout::extend('layouts/dinertest');
$title = 'Index';
?>

<h3><?php echo Html::anchor(Url::action('dinertestController::newForm'), 'Create New dinertest') ?></h3>

<?php if(isset($flash)): ?>
	<div class="error">
	<?php echo $flash; ?>
	</div>
<?php endif; ?>

<?php foreach($dinertestSet as $dinertest): ?>
	<?php Part::draw('dinertest/details', $dinertest) ?>
	<hr />
<?php endforeach; ?>