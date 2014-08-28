<?php 
Layout::extend('layouts/queries');
$title = 'Index';
?>

<h3><?php echo Html::anchor(Url::action('queriesController::newForm'), 'Create New queries') ?></h3>

<?php if(isset($flash)): ?>
	<div class="error">
	<?php echo $flash; ?>
	</div>
<?php endif; ?>

<?php foreach($queriesSet as $queries): ?>
	<?php Part::draw('queries/details', $queries) ?>
	<hr />
<?php endforeach; ?>