<?php 
Layout::extend('layouts/searches');
$title = 'Index';
?>

<h3><?php echo Html::anchor(Url::action('searchesController::newForm'), 'Create New searches') ?></h3>

<?php if(isset($flash)): ?>
	<div class="error">
	<?php echo $flash; ?>
	</div>
<?php endif; ?>

<?php foreach($searchesSet as $searches): ?>
	<?php Part::draw('searches/details', $searches) ?>
	<hr />
<?php endforeach; ?>