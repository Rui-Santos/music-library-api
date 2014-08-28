<?php 
Layout::extend('layouts/prosfxall');
$title = 'Index';
?>

<h3><?php echo Html::anchor(Url::action('prosfxallController::newForm'), 'Create New prosfxall') ?></h3>

<?php if(isset($flash)): ?>
	<div class="error">
	<?php echo $flash; ?>
	</div>
<?php endif; ?>

<?php foreach($prosfxallSet as $prosfxall): ?>
	<?php Part::draw('prosfxall/details', $prosfxall) ?>
	<hr />
<?php endforeach; ?>